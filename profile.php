<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f7fc;
        }

        .profile-container {
            background-color: white;
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .profile-container h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }

        .profile-container p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .profile-container a {
            display: block;
            background-color: #6a11cb;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            transition: background 0.3s ease;
        }

        .profile-container a:hover {
            background-color: #2575fc;
        }

        .profile-details {
            margin-top: 20px;
            text-align: left;
        }

        .profile-details ul {
            list-style: none;
            padding: 0;
        }

        .profile-details ul li {
            margin-bottom: 10px;
            font-size: 14px;
            color: #444;
        }

        .profile-details ul li i {
            margin-right: 10px;
            color: #6a11cb;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <img src="foto-admin.png" alt="Admin Profile">
        <h2>Admin EduSyncPro</h2>
        <p>Selamat datang di halaman profil admin.</p>

        <a href="dashboard.php"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>

        <div class="profile-details">
            <h3 >Detail Profil</h3>
            <ul>
                <li><i class="fas fa-user" style="margin-top: 10px;"></i> Nama: Admin</li>
                <li><i class="fas fa-envelope"></i> Email: admin@gmail.com</li>
                <li><i class="fas fa-phone"></i> Telepon: 0812-3456-7890</li>
                <li><i class="fas fa-briefcase"></i> Jabatan: Administrator</li>
            </ul>
        </div>
    </div>
</body>
</html>
