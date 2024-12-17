<?php 
session_start();
include 'config.php';

$error = '';

// proses form login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    foreach ($users as $user) {
        if ($user['username'] == $username && $user['password'] == $password) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header('Location: dashboard.php');
            } else {
                header('Location: cek/index.php');
            }
            exit;
        }
    }
    $error = "Username atau Password salah!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login EduSyncPro</title>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            height: 100vh;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            width: 50%;
            max-width: 1200px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .left {
            flex: 1;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .right {
            flex: 1;
            background: url('https://via.placeholder.com/600x800') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #fff;
        }

        .login-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-container {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px;
            background: #f9f9f9;
        }

        .input-container input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 16px;
            background: transparent;
        }

        .input-container i {
            color: #6a11cb;
            margin-right: 10px;
        }

        .input-container:focus-within {
            border-color: #6a11cb;
        }

        button {
            padding: 12px;
            font-size: 16px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
        }

        .error {
            font-size: 14px;
            color: #e74c3c;
            margin-bottom: 10px;
        }
        .right {
        flex: 1;
        background: url(login.jpg);
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 28px;
        font-weight: bold;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        padding: 20px;
        }

        .right div {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left Section -->
        <div class="left">
            <div class="login-container">
                <div class="login-title">Login EduSyncPro</div>
                <?php if ($error): ?>
                    <div class="error"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="input-container">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-container">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>

        <!-- Right Section -->
        <div class="right">
            <div>
                Welcome to EduSyncPro!
                <p style="font-size: 12px; font-weight: normal; margin-top: 10px; text-shadow: none;">
                    Your ultimate platform for managing education efficiently and innovatively. 
                    EduSyncPro connects educators, students, and administrators with seamless tools for 
                    collaboration, tracking, and enhancing the learning experience.
                </p>
            </div>
        </div>
    </div>
</body> 
</html>
