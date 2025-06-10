<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - VIP Exclusive Zone</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;600&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
  <style>
    :root {
      --gold: #D4AF37;
      --pink: #FF6B9E;
      --dark: #121212;
      --light: #F8F8F8;
      --neon-blue: #00F7FF;
      --neon-purple: #B026FF;
    }

    body {
      background: linear-gradient(135deg, #0F0C29, #1A1A2E);
      color: var(--light);
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    .luxury-404-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 60px 20px;
      position: relative;
      text-align: center;
    }

    .error-code {
      font-family: 'Playfair Display', serif;
      font-size: 180px;
      font-weight: 700;
      background: linear-gradient(45deg, var(--gold), var(--pink));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      text-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
      margin: 0;
      line-height: 1;
      position: relative;
      display: inline-block;
    }

    .error-code::after {
      content: '✨';
      position: absolute;
      top: -30px;
      right: -40px;
      font-size: 50px;
      animation: sparkle 2s infinite;
    }

    @keyframes sparkle {
      0%, 100% { opacity: 0.8; transform: scale(1); }
      50% { opacity: 1; transform: scale(1.2); }
    }

    .error-title {
      font-family: 'Playfair Display', serif;
      font-size: 42px;
      color: var(--gold);
      margin: 20px 0 10px;
      letter-spacing: 1px;
    }

    .error-subtitle {
      font-family: 'Poppins', sans-serif;
      font-size: 18px;
      color: var(--light);
      opacity: 0.9;
      max-width: 700px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .lottie-container {
      max-width: 400px;
      margin: 30px auto;
      position: relative;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 20px;
      padding: 20px;
      border: 2px solid var(--gold);
      box-shadow: 0 0 30px rgba(212, 175, 55, 0.2);
    }

    .lottie-label {
      position: absolute;
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
      background: var(--gold);
      color: var(--dark);
      font-weight: bold;
      padding: 8px 20px;
      font-family: 'Poppins', sans-serif;
      text-transform: uppercase;
      letter-spacing: 1px;
      border-radius: 30px;
      font-size: 14px;
      box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    }

    .error-message {
      max-width: 600px;
      margin: 40px auto;
      padding: 25px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      border: 1px solid rgba(212, 175, 55, 0.3);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .error-message p {
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 15px;
    }

    .error-message .highlight {
      color: var(--neon-blue);
      font-weight: bold;
    }

    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 40px;
    }

    .btn-vip {
      padding: 15px 30px;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      letter-spacing: 1px;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
    }

    .btn-primary {
      background: linear-gradient(45deg, var(--gold), var(--pink));
      color: var(--dark);
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
    }

    .btn-secondary {
      background: transparent;
      color: var(--gold);
      border: 2px solid var(--gold);
    }

    .btn-secondary:hover {
      background: rgba(212, 175, 55, 0.1);
      transform: translateY(-3px);
    }

    .btn-vip i {
      margin-right: 10px;
      font-size: 18px;
    }

    .funny-note {
      margin-top: 40px;
      font-style: italic;
      color: rgba(255, 255, 255, 0.6);
      font-size: 14px;
    }

    .floating-elements {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }

    .floating-element {
      position: absolute;
      opacity: 0.6;
      animation: float 6s infinite ease-in-out;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(5deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .error-code {
        font-size: 120px;
      }
      .error-title {
        font-size: 32px;
      }
      .action-buttons {
        flex-direction: column;
      }
      .btn-vip {
        width: 100%;
      }
      .lottie-container {
        max-width: 300px;
      }
    }
  </style>
</head>
<body>
  <div class="luxury-404-container">
    <!-- Floating decorative elements -->
    <div class="floating-elements">
      <div class="floating-element" style="top: 10%; left: 5%; font-size: 30px;">💎</div>
      <div class="floating-element" style="top: 70%; left: 10%; font-size: 40px;">✨</div>
      <div class="floating-element" style="top: 30%; right: 8%; font-size: 35px;">🦄</div>
      <div class="floating-element" style="top: 80%; right: 5%; font-size: 25px;">🚀</div>
    </div>

    <h1 class="error-code">404</h1>
    <h2 class="error-title">Bạn Đã Lạc Vào Khu VIP!</h2>
    <p class="error-subtitle">
      Trang bạn tìm kiếm không tồn tại, hoặc có thể nó quá <span style="color: var(--neon-blue);">sang chảnh</span> để hiển thị với bạn.
    </p>

    <div class="lottie-container">
      <dotlottie-player
        src="https://lottie.host/1ca22811-b40e-49a0-9d19-55af25c99b85/6nqVNZ1Cro.lottie"
        background="transparent"
        speed="1"
        style="width: 100%; height: auto;"
        loop
        autoplay>
      </dotlottie-player>
      <div class="lottie-label">EXCLUSIVE CONTENT</div>
    </div>

    <div class="error-message">
      <p>❌ <span class="highlight">Lỗi 404:</span> Trang bạn yêu cầu đang được bảo vệ bởi đội ngũ an ninh hạng sang.</p>
      <p>🛸 <span class="highlight">Nguyên nhân:</span> Có thể bạn chưa có thẻ thành viên Platinum, hoặc đơn giản là chúng tôi quá đẳng cấp.</p>
      <p>🔑 <span class="highlight">Giải pháp:</span> Thử lại sau khi mua gói Diamond Pro hoặc thử dỗ mèo bảo vệ bằng caviar.</p>
    </div>

    <div class="action-buttons">
      <a href="{{ url('/') }}" class="btn-vip btn-primary">
        <i class="fas fa-home"></i> Về Trang Chủ
      </a>
      <a href="#" class="btn-vip btn-secondary">
        <i class="fas fa-crown"></i> Nâng Cấp VIP
      </a>
    </div>

    <p class="funny-note">
      *Lưu ý: Tiếp tục truy cập trái phép có thể khiến bạn bị biến thành đèn chùm pha lê hoặc phải nghe nhạc J97 24/7.
    </p>
  </div>
</body>
</html>
