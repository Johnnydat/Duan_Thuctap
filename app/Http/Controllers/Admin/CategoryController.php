<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    private function buildCategoryOptions($categories, $parentId = null, $prefix = '')
    {
        $html = '';
        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $html .= '<option value="' . $category->id . '">' . $prefix . $category->name . '</option>';
                $html .= $this->buildCategoryOptions($categories, $category->id, $prefix . '-- ');
            }
        }
        return $html;
    }


    public function index()
    {
        $categories = Category::orderBy('name')->paginate(8);
        $categoryOptions = $this->buildCategoryOptions(Category::orderBy('name')->get());
        return view('admin.categories.index', compact('categories', 'categoryOptions'));
    }





    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Lấy lại toàn bộ danh mục để build lại select option
        $categories = Category::orderBy('name')->get();
        $optionsHtml = $this->buildCategoryOptions($categories);

        return response()->json([
            'success' => true,
            'message' => 'Thêm thành công',
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'parent_id' => $category->parent_id,
                'parent_name' => $category->parent?->name,
                'options_html' => $optionsHtml,
            ]
        ]);
    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id|not_in:' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
        ]);

        $categories = Category::orderBy('name')->get(); // lấy lại để build option
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật danh mục thành công!',
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'parent_id' => $category->parent_id,
                'parent_name' => optional($category->parent)->name,
                'options_html' => $this->buildCategoryOptions($categories), // Sửa ở đây
            ]
        ]);
    }


    public function destroy(Category $category)
    {
        $category->delete(); // soft delete
        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được xóa mềm.');
    }

    // Hiển thị danh sách danh mục đã bị xóa mềm
    public function trashed()
    {
        $categories = Category::onlyTrashed()->orderBy('name')->paginate(8);
        return view('admin.categories.trash', compact('categories'));
    }

    // Khôi phục danh mục
    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.index')->with('success', 'Khôi phục danh mục thành công!');
    }

    // Xóa vĩnh viễn
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('admin.categories.trash')->with('success', 'Danh mục đã bị xóa vĩnh viễn!');
    }
}
