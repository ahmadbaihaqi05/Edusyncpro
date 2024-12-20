<?php
include '../auth.php'; // Hanya admin yang dapat mengakses halaman ini
authorize('admin'); // Fungsi untuk membatasi akses hanya untuk admin
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alokasi Jadwal Guru</title>
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
            min-height: 100vh;
            background-color: #f4f7fc;
        }

        /* Sidebar*/
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar-header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
            color: #ecf0f1;
        }

        .menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .menu li {
            margin: 15px 0;
        }

        .menu a {
            text-decoration: none;
            color: #ecf0f1;
            font-size: 18px;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .menu a i {
            margin-right: 10px;
        }

        .menu a:hover {
            background-color: #34495e;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px;
        }

        /* Navbar container */
        .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(90deg, #6a11cb, #2575fc); /* Gradien */
        padding: 15px 20px;
        color: white;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Bayangan */
        font-family: 'Arial', sans-serif;
        }

        /* Bagian kiri navbar (welcome text) */
        .navbar-left .welcome {
        font-size: 18px;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 8px;
        }

        /* Icon welcome */
        .navbar-left .welcome i {
        font-size: 22px;
        }

        /* user info */
        .navbar-right {
            position: relative; 
        }

        .dropdown-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            background: none;
            border: none;
            color: white;
            outline: none;
            padding: 5px 10px;
            transition: background 0.3s ease;
        }

        .dropdown-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .dropdown-menu {
            display: none; 
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            z-index: 1000;
            min-width: 150px;
            overflow: hidden;
        }

        .dropdown-menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .dropdown-menu ul li {
            border-bottom: 1px solid #f0f0f0;
        }

        .dropdown-menu ul li:last-child {
            border-bottom: none;
        }

        .dropdown-menu ul li a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.3s;
        }

        .dropdown-menu ul li a:hover {
            background-color: #f4f4f4;
            color: #007bff;
        }

        /* Dashboard Content */
        .dashboard-content {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        /* Form Container */
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
        }

        .form-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        /* Form Styles */
        form {
            width: 100%;
        }

        .form-group, .form-row {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #34495e;
            text-align: left;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #dcdcdc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="number"]:focus, select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        /* Form Row for Multiple Columns */
        .form-row {
            display: flex;
            gap: 10px;
        }

        .form-column {
            flex: 1;
        }

        .button-submit {
            margin-top: 20px;
            text-align: left;
        }
        /* Submit Button */
        .submit-btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-align: left;
        }

        .submit-btn:hover {
            background-color: #2980b9;
        }

        /* Result Section */
        .result {
          margin: 20px auto; 
          padding: 10px;
          border-radius: 4px;
          background-color: transparent; 
          font-size: 16px;
          color:#34495e;
          width: 30%;
          text-align: center; 
          font-weight: bold;
          display: none; 
          transition: background-color 0.3s ease, opacity 0.3s ease; 
        }

        .result.active {
          display: block; 
          background-color: #e9ecef; 
          opacity: 1; 
        }


        .dashboard-btn {
            background: linear-gradient(90deg, #6a11cb, #2575fc); /* Gradien warna */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .dashboard-btn .icon {
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dashboard-btn .text {
            font-size: 16px;
        }

        .dashboard-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
        }

        .dashboard-btn:active {
            transform: translateY(0px);
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.2);
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="jquery.js"></script>
    <script src="client.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>EduSyncPro</h2>
        </div>
        <ul class="menu">
            <li><a href="../cek/index.php"><i class="fas fa-user-check"></i> Cek Ketersediaan Guru</a></li>
            <li><a href="../gantiguru/index.php"><i class="fas fa-exchange-alt"></i> Ganti Guru</a></li>
            <li><a href="index.php"><i class="fas fa-calendar-alt"></i> Alokasi Jadwal Guru</a></li>
        </ul>
    </div>


    <div class="main-content">
        <!-- navbar -->
        <div class="navbar">
        <div class="navbar-left">
            <span class="welcome"><i class="fas fa-graduation-cap"></i> Halo Admin ! Halaman ini dirancang untuk mempermudah Anda dalam mengatur pengalokasian jadwal.</span>
        </div>
        <div class="navbar-right">
            <button class="dropdown-btn">
                <span>Admin</span>
                <i class="fas fa-user-circle"></i>
            </button>
            <div class="dropdown-menu">
                <ul>
                    <li><a href="../profile.php"><i class="fas fa-user"></i> Profil</a></li>
                    <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        </div>

        <div style="margin-top: 10px;" class="dashboard-content">
            <!-- form alokasi -->
            <div class="form-container">
                <h1><i class="fas fa-calendar-alt"></i> Alokasi Jadwal Guru</h1>
                <form id="checkForm">
                    <div class="form-group">
                        <label for="nama_guru">Nama Guru:</label>
                        <input type="text" id="nama_guru" name="nama_guru" placeholder="Masukkan nama guru" required>
                    </div>

                    <div class="form-row">
                        <div class="form-column">
                            <label for="hari_lama">Hari Lama:</label>
                            <select id="hari_lama" name="hari_lama" required>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                        <div class="form-column">
                            <label for="hari_baru">Hari Baru:</label>
                            <select id="hari_baru" name="hari_baru" required>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-column">
                            <label for="jam_lama">Jam Pelajaran Lama:</label>
                            <input type="number" id="jam_lama" name="jam_lama" min="1" max="8" required>
                        </div>
                        <div class="form-column">
                            <label for="jam_baru">Jam Pelajaran Baru:</label>
                            <input type="number" id="jam_baru" name="jam_baru" min="1" max="8" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sistem_belajar">Sistem Belajar:</label>
                        <select id="sistem_belajar" name="sistem_belajar" required>
                            <option value="daring">Daring</option>
                            <option value="luring">Luring</option>
                        </select>
                    </div>
                    <div class="button-submit"> <button type="submit" class="submit-btn">Kirim</button> </div>
                    
                </form>
                <div id="result" class="result">
                    <p id="output"></p>
                </div>
            
                <!-- jika klik kembali kedashboard tidak perlu login ulang -->
                <div class="button-container">
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <button class="dashboard-btn" onclick="window.location.href='../dashboard.php';">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="text">Kembali ke Dashboard</span>
                    </button>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // mengontrol dropdown
        document.addEventListener("DOMContentLoaded", function () {
            const dropdownBtn = document.querySelector(".dropdown-btn");
            const dropdownMenu = document.querySelector(".dropdown-menu");

            dropdownBtn.addEventListener("click", function () {
                dropdownMenu.style.display = 
                    dropdownMenu.style.display === "block" ? "none" : "block";
            });

            // Tutup dropdown jika klik di luar area dropdown
            document.addEventListener("click", function (e) {
                if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.style.display = "none";
                }
            });
        });

        // untuk menyembunyian result ketika user belum klik button submit
        document.getElementById("checkForm").addEventListener("submit", function (e) {
          e.preventDefault();
          const result = document.getElementById("result");
          const output = document.getElementById("output");

          result.classList.add("active");
          output.textContent = "Hasil akan ditampilkan di sini."; 
        });
    </script>
 
</body>
</html>
