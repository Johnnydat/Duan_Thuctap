<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showRegisterForm(Request $request)
    {
        return view('client.home', [
            'showLoginModal' => true,
        ]);
    }
    
    public function register(Request $request)
    {
        $isAjax = $request->expectsJson() || $request->ajax();

        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:100'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
            'phone'     => ['required', 'regex:/^0[0-9]{9,10}$/'],
            'gender'    => ['nullable', Rule::in(['M', 'F', 'O'])],
            'agreeTerms' => ['accepted'],
        ], [
            'agreeTerms.accepted' => 'Bạn phải đồng ý với điều khoản sử dụng',
            'phone.regex' => 'Số điện thoại không hợp lệ'
        ]);

        if ($validator->fails()) {
            if ($isAjax) {
                return response()->json([
                    'message' => 'Registration failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect('/')->with('error', 'Đăng ký không thành công!');
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'phone'     => $request->phone,
            'gender'    => $request->gender,
            'role'      => 'user',
            'status'    => 'active', // Set default status to active
        ]);

        Auth::login($user);

        if ($isAjax) {
            return response()->json(['success' => true]);
        }

        return redirect('/')->with('success', 'Đăng ký thành công!');
    }

    public function showLoginForm(Request $request)
    {
        return view('client.home', [
            'showLoginModal' => true,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->filled('remember');

        // First find the user to check their status
        $user = User::where('email', $credentials['email'])->first();

        // Check if user exists and is banned
        if ($user && $user->status === 'banned') {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'message' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.'
                ], 403);
            }
            return redirect('/')->with('error', 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.');
        }

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Kiểm tra role admin
            if ($user && $user->role === 'admin') {
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json(['success' => true, 'redirect' => route('admin.admin.dashboard')]);
                }
                return redirect()->route('admin.admin.dashboard');
            }

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => true, 'redirect' => url('/')]);
            }
            return redirect()->intended('/');
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Email hoặc mật khẩu không đúng.'
            ], 401);
        }

        return redirect('/')->with('error', 'Email hoặc mật khẩu không đúng.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    
    // Add this method to check account status
    public function checkAccountStatus(Request $request)
    {
        if (!Auth::check()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['message' => 'Not authenticated'], 401);
            }
            return redirect('/login');
        }
        
        $user = Auth::user();
        
        if ($user->status === 'banned') {
            Auth::logout();
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'banned' => true,
                    'message' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.'
                ], 403);
            }
            return redirect('/')->with('error', 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.');
        }
        
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'banned' => false,
                'status' => $user->status
            ]);
        }
        
        return null;
    }
}