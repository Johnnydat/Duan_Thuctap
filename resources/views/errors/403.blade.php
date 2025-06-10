<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Montserrat:400,700|Poppins:400,700"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>403 - VIP Access Required</title>
    <style>
        :root {
            --gold: #D4AF37;
            --dark: #121212;
            --red: #A91B0D;
            --light: #F8F8F8;
        }

        body {
            background-color: var(--dark);
            color: var(--light);
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .luxury-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 20px;
            position: relative;
        }

        .velvet-curtain {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(20, 20, 20, 0.9) 0%, rgba(40, 40, 40, 0.95) 100%);
            z-index: -1;
            border-radius: 8px;
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.5);
        }

        .error-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .error-code {
            font-family: 'Playfair Display', serif;
            font-size: 180px;
            font-weight: 700;
            color: var(--gold);
            text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.5);
            line-height: 1;
            margin: 0;
            position: relative;
            display: inline-block;
        }

        .error-code::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
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
            opacity: 0.8;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .security-theater {
            display: flex;
            justify-content: center;
            margin: 50px 0;
            position: relative;
        }

        .security-gif {
            width: 400px;
            height: 300px;
            background-image: url('https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExeDd5cWVtZjk0bXRqdjJpc29zOTJhZGszOTBmNDNzdWdsN29hczF1ZSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/3o6MbmTd7iUDK5AiHu/giphy.gif');
            background-size: cover;
            background-position: center;
            border: 3px solid var(--gold);
            border-radius: 5px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .security-gif::before {
            content: 'RESTRICTED AREA';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(169, 27, 13, 0.7);
            color: white;
            text-align: center;
            padding: 8px 0;
            font-weight: bold;
            letter-spacing: 2px;
            font-size: 14px;
        }

        .security-details {
            background: rgba(30, 30, 30, 0.8);
            border-left: 3px solid var(--red);
            padding: 30px;
            max-width: 500px;
            margin-left: 30px;
        }

        .security-details h3 {
            font-family: 'Playfair Display', serif;
            color: var(--gold);
            font-size: 24px;
            margin-top: 0;
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
            padding-bottom: 10px;
        }

        .security-list {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }

        .security-list li {
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            font-size: 16px;
        }

        .security-list li i {
            margin-right: 15px;
            color: var(--gold);
            font-size: 20px;
            min-width: 25px;
            text-align: center;
        }

        .humorous-note {
            font-style: italic;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 20px;
            font-size: 14px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }

        .btn-luxury {
            padding: 15px 30px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: var(--gold);
            color: var(--dark);
        }

        .btn-primary:hover {
            background: #E8C252;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
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

        .legal-warning {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.4);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
        }

        .flashing {
            animation: flash 2s infinite;
        }

        @keyframes flash {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        .threat-meter {
            height: 8px;
            background: linear-gradient(90deg, #00C853, #FFD600, #FF9100, #DD2C00);
            border-radius: 4px;
            margin: 15px 0;
            position: relative;
            overflow: hidden;
        }

        .threat-level {
            position: absolute;
            right: 0;
            top: -20px;
            font-weight: bold;
            color: var(--red);
        }

        .threat-indicator {
            height: 100%;
            width: 85%;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 4px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .error-code {
                font-size: 120px;
            }

            .error-title {
                font-size: 32px;
            }

            .security-theater {
                flex-direction: column;
                align-items: center;
            }

            .security-gif {
                width: 100%;
                max-width: 400px;
                margin-bottom: 30px;
            }

            .security-details {
                margin-left: 0;
                max-width: 100%;
            }

            .action-buttons {
                flex-direction: column;
                gap: 15px;
            }

            .btn-luxury {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="luxury-container">
        <div class="velvet-curtain"></div>

        <div class="error-header">
            <h1 class="error-code">403</h1>
            <h2 class="error-title">Cần Quyền Truy Cập Đặc Biệt</h2>
            <p class="error-subtitle">
                Bạn đã cố gắng truy cập vào khu vực bị hạn chế và hành động này đã được ghi lại, báo cáo đến đội an ninh
                mạng của chúng tôi.
                <span class="flashing">(Chỉ đùa thôi... hoặc cũng có thể là thật?)</span>
            </p>
        </div>

        <div class="security-theater">
            <div class="security-gif"></div>

            <div class="security-details">
                <h3>Vi Phạm Giao Thức Bảo Mật</h3>

                <div class="threat-meter">
                    <div class="threat-indicator"></div>
                    <div class="threat-level">MỨC ĐE DỌA CAO</div>
                </div>

                <ul class="security-list">
                    <li>
                        <i class="fas fa-user-secret"></i>
                        <span>Phát hiện truy cập trái phép từ địa chỉ IP của bạn</span>
                    </li>
                    <li>
                        <i class="fas fa-lock"></i>
                        <span>Khu vực này yêu cầu quyền Cấp 9 (bạn hiện có Cấp 0)</span>
                    </li>
                    <li>
                        <i class="fas fa-shield-alt"></i>
                        <span>Hệ thống bảo mật đã được cảnh báo về sự hiện diện của bạn</span>
                    </li>
                    <li>
                        <i class="fas fa-gavel"></i>
                        <span>Người vi phạm sẽ bị bắt gỡ lỗi mã IE6 cũ kỹ</span>
                    </li>
                </ul>

                <p class="humorous-note">
                    * Đừng lo, chúng tôi có thể sẽ không thả chó săn mạng ra đâu. Có thể thôi.
                </p>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ url('/') }}" class="btn-luxury btn-primary">
                <i class="fas fa-home"></i> &nbsp; Trở Về Trang Chủ
            </a>
            <a href="mailto:admin@example.com" class="btn-luxury btn-secondary">
                <i class="fas fa-envelope"></i> &nbsp; Xin Cấp Quyền
            </a>
        </div>

        <div class="legal-warning">
            <p>
                <i class="fas fa-exclamation-triangle"></i> CẢNH BÁO: Tiếp tục truy cập trái phép có thể dẫn đến bị cấm
                IP tạm thời, nhận email cảnh cáo, hoặc bị ép nghe nhạc Nickelback liên tục.
            </p>
        </div>
    </div>
</body>

</html>