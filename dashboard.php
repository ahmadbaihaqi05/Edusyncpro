<?php
include 'auth.php';
authorize('admin'); #otorisasi hanya admin yang bisa akses dashboard
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            min-height: 100vh;
            background-color: #f4f7fc;
        }

        #digital-clock-container {
            text-align: right;
            background-color: #34495e;
            color: white;
            padding: 10px 0;
            font-size: 16px;
            font-family: 'Arial', sans-serif;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 5px;
            padding-right: 5px;
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

        /* welcome text */
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

        .welcome-box h1 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .welcome-box p {
            font-size: 18px;
            color: #7f8c8d;
        }

        /* Cards Section */
        .cards {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: #ecf0f1;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            flex: 1;
            text-align: center;
        }

        .card h3 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .card p {
            color: #7f8c8d;
        }
        .card:hover {
            transform: translateY(-5px); 
            box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2); 
            border-color: #6a11cb; 
        }
        
        .schedule-info-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-top: 20px;
            align-items: start;
        }

        .info-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-box {
            text-align: center;
            padding: 15px 20px;
            background: #d5dff8;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .info-box h2 {
            margin: 0 0 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .info-box p {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .info-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.3);
        }

        .schedule-section {
            flex: 2;
            background: #d5dff8;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .schedule-table th, .schedule-table td {
            border: 1px solid #191f30;
            padding: 10px;
            text-align: left;
        }

        .schedule-table th {
            background-color:rgb(54, 107, 251);
            color: white;
        }

        .schedule-table tr {
            background-color: white;
        }

        .schedule-table tr:hover {
            background-color: #a6beff;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>EduSyncPro</h2>
        </div>
        <ul class="menu">
            <li><a href="index.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="cek/index.php"><i class="fas fa-user-check"></i> Cek Ketersediaan Guru</a></li>
            <li><a href="gantiguru/index.php"><i class="fas fa-exchange-alt"></i> Ganti Guru</a></li>
            <li><a href="alokasi/index.php"><i class="fas fa-calendar-alt"></i> Alokasi Jadwal Guru</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Nigital clock -->
        <div id="digital-clock-container" >
            <span id="day"></span>, 
            <span id="date"></span> - 
            <span id="time"></span>
        </div>

        <!-- Navbar -->
        <div class="navbar">
        <div class="navbar-left">
            <span class="welcome"><i class="fas fa-graduation-cap"></i> Selamat Datang di Halaman Admin EduSyncPro</span>
        </div>
        <div class="navbar-right">
            <button class="dropdown-btn">
                <span>Admin</span>
                <i class="fas fa-user-circle"></i>
            </button>
            <div class="dropdown-menu">
                <ul>
                    <li><a href="profile.php"><i class="fas fa-user"></i> Profil</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        </div>

        <!-- Dashboard content -->
        <div style="margin-top: 10px;" class="dashboard-content">
            <div class="welcome-box">
                <h1>Dashboard</h1>
                <p>Anda login sebagai administrator dengan hak akses terbatas.</p>
            </div>

            <!-- Card Section -->
            <div class="cards">
                <div class="card" onclick="window.location.href='cek/index.php';">
                    <h3>Cek Ketersediaan Guru</h3>
                    <p>Periksa status ketersediaan guru di sistem.</p>
                </div>
                <div class="card" onclick="window.location.href='gantiguru/index.php';">
                    <h3>Ganti Guru</h3>
                    <p>Lakukan penggantian guru sesuai kebutuhan.</p>
                </div>
                <div class="card" onclick="window.location.href='alokasi/index.php';">
                    <h3>Alokasi Jadwal Guru</h3>
                    <p>Kelola jadwal guru dengan mudah dan terorganisir.</p>
                </div>
            </div>
        </div>

        <!-- Tabel Jadwal -->
        <div class="schedule-info-container">
            <div class="schedule-section">
                <h1>Jadwal Guru</h1>
                <div class="search-box" style="margin-top: 10px; position: relative; width: 300px;">
                <input type="text" id="searchInput" placeholder="Cari..." style="width: 100%; padding: 10px 15px; padding-left: 35px; font-size: 16px; border: 2px solid #ddd; border-radius: 25px; outline: none; transition: border-color 0.3s ease;">
                <i class="fa fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); font-size: 18px; color: #888;"></i>
            </div>

                <table class="schedule-table" id="scheduleTable">
                <thead>
            <tr>
                <th>Guru</th>
                <th>Hari</th>
                <th>Jam Pelajaran</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Guru A</td>
                <td>Senin</td>
                <td>1</td>
                <td>Matematika</td>
                <td>10</td>
            </tr>
            <tr>
                <td>Guru B</td>
                <td>Senin</td>
                <td>2</td>
                <td>Kimia</td>
                <td>11</td>
            </tr>
            <tr>
                <td>Guru A</td>
                <td>Selasa</td>
                <td>2</td>
                <td>Fisika</td>
                <td>11</td>
            </tr>
            <tr>
                <td>Guru C</td>
                <td>Kamis</td>
                <td>1</td>
                <td>Biologi</td>
                <td>10</td>
            </tr>
            <tr>
                <td>Guru A</td>
                <td>Senin</td>
                <td>1</td>
                <td>Matematika</td>
                <td>10</td>
            </tr>
            <tr>
                <td>Guru B</td>
                <td>Senin</td>
                <td>2</td>
                <td>Kimia</td>
                <td>11</td>
            </tr>
            <tr>
                <td>Guru A</td>
                <td>Selasa</td>
                <td>1</td>
                <td>Biologi</td>
                <td>11</td>
            </tr>
            <tr>
                <td>Guru C</td>
                <td>Rabu</td>
                <td>2</td>
                <td>Kimia</td>
                <td>10</td>
            </tr>
            <tr>
                <td>Guru B</td>
                <td>Kamis</td>
                <td>2</td>
                <td>Matematika</td>
                <td>10</td>
            </tr>
            <tr>
                <td>Guru C</td>
                <td>Kamis</td>
                <td>1</td>
                <td>Biologi</td>
                <td>10</td>
            </tr>
        </tbody>

                </table>
            </div>

            <!-- Info Section -->
            <div class="info-container">
                <div class="info-box">
                    <h2>Jumlah Guru</h2>
                    <p>15</p>
                </div>
                <div class="info-box">
                    <h2>Jumlah Siswa</h2>
                    <p>200</p>
                </div>
            </div>
        </div>
    </div>
    


    <script>
        // Mengontrol dropdown
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

        // Digital Clock
        document.addEventListener("DOMContentLoaded", function () {
        const dayElement = document.getElementById("day");
        const dateElement = document.getElementById("date");
        const timeElement = document.getElementById("time");

        function updateDateTime() {
            const now = new Date();

            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            const day = days[now.getDay()];

            const date = now.toLocaleDateString("id-ID", {
                day: "numeric",
                month: "long",
                year: "numeric"
            });

            const time = now.toLocaleTimeString("id-ID", {
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit"
            });

            dayElement.textContent = day;
            dateElement.textContent = date;
            timeElement.textContent = time;
        }

            setInterval(updateDateTime, 1000);
            updateDateTime();
        });

        // function search box
        const searchInput = document.getElementById('searchInput');
        const scheduleTable = document.getElementById('scheduleTable');
        const rows = scheduleTable.getElementsByTagName('tr');

        searchInput.addEventListener('keyup', () => {
            const filter = searchInput.value.toLowerCase();
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].innerText.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? '' : 'none';
            }
        });
    </script>
</body>
</html>
