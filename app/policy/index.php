<?php
session_start();
$_SESSION["chat_history"] = [];
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Vạn Niên CayTre - Tư vấn phong thủy & cuộc sống</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;600&family=Quicksand:wght@400;500;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-color: #3a5a40;
            --secondary-color: #588157;
            --accent-color: #a3b18a;
            --light-bg: #f8f9fa;
            --dark-text: #212529;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f5f5f5;
            color: var(--dark-text);
            padding-top: 70px;
            padding-bottom: 60px;
        }

        /* Topbar styling */
        .topbar {
            background-color: var(--primary-color);
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .topbar .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s;
            padding: 1rem 1.5rem;
        }

        .topbar .nav-link:hover {
            background-color: var(--secondary-color);
        }

        /* Calendar styling */
        .calendar-container {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 20px;
            margin-bottom: 20px;
        }

        .calendar-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .calendar-info {
            background-color: #fff9f0;
            border: 1px solid #f0e6d2;
            border-radius: 10px;
            padding: 20px;
            font-size: 0.95rem;
        }

        .calendar-info h5 {
            color: var(--primary-color);
            border-bottom: 1px dashed var(--accent-color);
            padding-bottom: 8px;
            margin-bottom: 15px;
        }

        /* Chatbot styling */
        .chatbot-container {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 0;
            height: 600px;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 20px;
            border-radius: 12px 12px 0 0;
        }

        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }

        .message {
            margin-bottom: 15px;
            max-width: 80%;
        }

        .user-message {
            margin-left: auto;
            background-color: #e3f2fd;
            border-radius: 15px 15px 0 15px;
        }

        .bot-message {
            margin-right: auto;
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 15px 15px 15px 0;
        }

        .chat-input {
            padding: 15px;
            background-color: white;
            border-top: 1px solid #eee;
            border-radius: 0 0 12px 12px;
        }

        /* Login buttons */
        .login-buttons {
            padding: 30px;
            text-align: center;
        }

        .btn-login {
            width: 100%;
            max-width: 300px;
            margin: 10px auto;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-google {
            background-color: #4285F4;
            color: white;
        }

        .btn-facebook {
            background-color: #3b5998;
            color: white;
        }

        /* Policy and About pages */
        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 30px;
            margin-top: 30px;
        }

        /* Bottom bar */
        .bottombar {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1000;
        }

        /* Custom fonts */
        .calendar-title {
            font-family: 'Noto Serif JP', serif;
            font-weight: 600;
            color: var(--primary-color);
        }

        .lunar-date {
            font-weight: 600;
            color: #d32f2f;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .topbar .nav-link {
                padding: 0.8rem;
            }

            body {
                padding-top: 60px;
            }
        }

        .bot-message ul {
            padding-left: 20px;
            margin-bottom: 10px;
        }

        .bot-message li {
            margin-bottom: 5px;
        }

        .bot-message strong {
            font-weight: 600;
            color: var(--primary-color);
        }
    </style>
</head>

<body>
    <!-- Topbar -->
    <nav class="navbar navbar-expand-lg topbar">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="#">
                <i class="fas fa-calendar-alt me-2"></i>Lịch Vạn Niên
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon text-white"><i class="fas fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/" id="home-link"><i class="fas fa-home me-1"></i> Trang
                            chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" id="policy-link"><i class="fas fa-file-contract me-1"></i> Chính
                            sách</a>
                    </li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown">
                                <img src="<?php echo $_SESSION['user']['avatar_url']; ?>" width="30" height="30"
                                    class="rounded-circle me-1">
                                <?php echo htmlspecialchars($_SESSION['user']['name']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="auth.php?logout">Đăng xuất</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4" id="policy-page">
        <div class="content-card">
            <h2 class="mb-4 text-center"><i class="fas fa-file-contract me-2"></i>Chính Sách</h2>

            <div class="policy-content">
                <p class="lead text-center">
                    "Website được xây dựng phục vụ mục đích cá nhân và phi lợi nhuận. Dữ liệu được cung cấp từ các nguồn
                    công khai. Người dùng chịu trách nhiệm với nội dung họ nhập vào hệ thống."
                </p>

                <div class="mt-5">
                    <h4><i class="fas fa-shield-alt me-2 text-primary"></i>Bảo Mật Thông Tin</h4>
                    <p>Chúng tôi cam kết bảo vệ thông tin cá nhân của người dùng. Mọi dữ liệu cá nhân được cung cấp sẽ
                        chỉ được sử dụng cho mục đích cải thiện trải nghiệm người dùng và không được chia sẻ với bên thứ
                        ba.</p>

                    <h4 class="mt-4"><i class="fas fa-database me-2 text-primary"></i>Thu Thập Dữ Liệu</h4>
                    <p>Website có thể thu thập thông tin không nhận dạng cá nhân như loại trình duyệt, thiết bị truy
                        cập, thời gian truy cập để phân tích và cải thiện dịch vụ.</p>

                    <h4 class="mt-4"><i class="fas fa-exclamation-triangle me-2 text-primary"></i>Giới Hạn Trách Nhiệm
                    </h4>
                    <p>Thông tin trên website được tạo ra bởi trí tuệ nhân tạo và chỉ mang tính chất tham khảo. Chúng
                        tôi không chịu trách nhiệm cho bất kỳ
                        quyết định nào dựa trên thông tin được cung cấp bởi hệ thống.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>