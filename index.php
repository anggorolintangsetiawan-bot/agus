
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN Takeran - Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-primary: #f0f9ff;
            --bg-secondary: #ffffff;
            --bg-sidebar: linear-gradient(180deg, #0891b2 0%, #06b6d4 100%);
            --bg-hero: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%);
            --text-primary: #333;
            --text-secondary: #666;
            --text-sidebar: #e0f2fe;
            --text-sidebar-active: #fff;
            --border-color: #e5e5e5;
            --table-header: #ecfeff;
            --table-header-text: #0e7490;
            --log-bg: #ecfeff;
            --log-border: #06b6d4;
            --btn-primary: #0891b2;
            --btn-hover: #0e7490;
        }

        [data-theme="dark"] {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-sidebar: linear-gradient(180deg, #164e63 0%, #155e75 100%);
            --bg-hero: linear-gradient(135deg, #164e63 0%, #155e75 50%, #0e7490 100%);
            --text-primary: #e2e8f0;
            --text-secondary: #cbd5e1;
            --text-sidebar: #cffafe;
            --text-sidebar-active: #fff;
            --border-color: #334155;
            --table-header: #1e293b;
            --table-header-text: #22d3ee;
            --log-bg: #1e293b;
            --log-border: #0891b2;
            --btn-primary: #0891b2;
            --btn-hover: #0e7490;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            display: flex;
            height: 100vh;
            overflow: hidden;
            background: var(--bg-primary);
            transition: background 0.3s;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 180px;
            background: var(--bg-sidebar);
            border-right: 1px solid #06b6d4;
            display: flex;
            flex-direction: column;
            padding: 30px 0;
            box-shadow: 2px 0 10px rgba(8, 145, 178, 0.1);
        }

        .logo {
            padding: 0 20px 40px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            text-align: center;
        }

        .nav-menu {
            flex: 1;
        }

        .nav-item {
            padding: 12px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            color: var(--text-sidebar);
            position: relative;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: var(--text-sidebar-active);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.25);
            color: var(--text-sidebar-active);
            font-weight: 600;
            border-left: 3px solid #fff;
        }

        .nav-item sup {
            font-size: 10px;
            color: #cffafe;
            opacity: 0.7;
        }

        .nav-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nav-footer a {
            display: block;
            padding: 8px 0;
            color: var(--text-sidebar);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }

        .nav-footer a:hover {
            color: #fff;
        }

        /* Main Content Area */
        .main-content {
            flex: 1;
            overflow-y: auto;
            background: var(--bg-primary);
        }

        .content-wrapper {
            min-height: 100%;
            background: var(--bg-secondary);
            margin: 0;
        }

        /* Hero Section */
        .hero {
            height: 50vh;
            background: var(--bg-hero);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .hero-logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-logo img {
            max-width: 300px;
            max-height: 300px;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        /* Content Section */
        .content-section {
            padding: 60px 80px;
            background: var(--bg-secondary);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            max-width: 1200px;
        }

        .section-title {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 40px;
            line-height: 1.2;
            color: var(--text-primary);
        }

        .section-text {
            font-size: 15px;
            line-height: 1.8;
            color: var(--text-primary);
            margin-bottom: 20px;
        }

        .contents-list {
            list-style: none;
        }

        .contents-list li {
            font-size: 18px;
            margin-bottom: 12px;
            color: var(--text-primary);
        }

        .contents-list span {
            margin-right: 10px;
            color: #999;
        }

        /* Page Styles */
        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        /* Table Styles */
        .table-container {
            padding: 40px;
            overflow-x: auto;
            background: var(--bg-secondary);
        }

        .table-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .bulk-actions {
            display: flex;
            gap: 10px;
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 13px;
        }

        .btn-danger {
            background: #ef4444;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-success {
            background: #10b981;
        }

        .btn-success:hover {
            background: #059669;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table th,
        .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .data-table th {
            background: var(--table-header);
            font-weight: 600;
            color: var(--table-header-text);
        }

        .data-table tbody tr:hover {
            background: var(--log-bg);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-icon {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
        }

        .btn-edit:hover {
            background: #2563eb;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            animation: fadeIn 0.3s;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: var(--bg-secondary);
            padding: 30px;
            border-radius: 8px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            animation: slideUp 0.3s;
        }

        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 14px;
            background: var(--bg-primary);
            color: var(--text-primary);
        }

        .modal-footer {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .btn-cancel {
            background: #6b7280;
        }

        .btn-cancel:hover {
            background: #4b5563;
        }

        /* Log Styles */
        .log-container {
            padding: 40px;
            background: var(--bg-secondary);
        }

        .log-entry {
            padding: 15px;
            border-left: 3px solid var(--log-border);
            margin-bottom: 15px;
            background: var(--log-bg);
            border-radius: 4px;
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 15px;
            align-items: start;
        }

        .log-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--btn-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 18px;
        }

        .log-details {
            flex: 1;
        }

        .log-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .log-name {
            font-weight: 600;
            font-size: 15px;
            color: var(--text-primary);
        }

        .log-time {
            font-size: 12px;
            color: #999;
        }

        .log-message {
            font-size: 14px;
            color: var(--text-secondary);
        }

        /* Settings Styles */
        .settings-container {
            padding: 40px;
            max-width: 600px;
            background: var(--bg-secondary);
        }

        .settings-group {
            margin-bottom: 30px;
        }

        .settings-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: var(--text-primary);
        }

        .theme-switch {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--btn-primary);
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .btn {
            padding: 10px 24px;
            background: var(--btn-primary);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }

        .btn:hover {
            background: var(--btn-hover);
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .page-header {
            padding: 40px;
            border-bottom: 1px solid var(--border-color);
            background: var(--bg-secondary);
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--table-header-text);
        }

        .page-description {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .error-message {
            color: #ef4444;
            padding: 20px;
            background: #fee;
            border-radius: 4px;
            margin: 20px 0;
        }

        [data-theme="dark"] .error-message {
            background: #7f1d1d;
            color: #fca5a5;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="logo">SMKN TAKERAN</div>
        
        <nav class="nav-menu">
            <div class="nav-item active" data-page="home">Home<sup>01</sup></div>
            <div class="nav-item" data-page="tentang">Tentang<sup>02</sup></div>
            <div class="nav-item" data-page="log">Data Log<sup>03</sup></div>
            <div class="nav-item" data-page="tabel">Data Pengguna<sup>04</sup></div>
            <div class="nav-item" data-page="pengaturan">Pengaturan<sup>05</sup></div>
        </nav>

        <div class="nav-footer">
            <a href="#" id="contactUs">Contact Us</a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Home Page -->
        <div class="page active" id="home">
            <div class="hero">
                <div class="hero-logo">
                    <img src="file/1.jpg" alt="Logo SMKN Takeran">
                </div>
            </div>
            <div class="content-section">
                <div class="content-grid">
                    <div>
                        <h1 class="section-title">SMKN Takeran</h1>
                    </div>
                    <div>
                        <p class="section-text">
                            Selamat datang di Dashboard SMKN Takeran. Platform ini dirancang untuk memudahkan pengelolaan data siswa, monitoring kehadiran, dan administrasi sekolah secara digital.
                        </p>
                        <p class="section-text">
                            Dengan sistem yang terintegrasi dengan Supabase, semua data dapat diakses secara real-time dan tersimpan dengan aman di cloud. Dashboard ini menyediakan visualisasi data yang jelas dan mudah dipahami.
                        </p>
                        <p class="section-text">
                            Gunakan menu navigasi di sebelah kiri untuk mengakses berbagai fitur yang tersedia, mulai dari data log kehadiran hingga informasi profil pengguna lengkap.
                        </p>
                    </div>
                </div>
                <div style="margin-top: 60px;">
                    <h2 style="font-size: 24px; margin-bottom: 30px; color: var(--text-primary);">Menu Tersedia</h2>
                    <ul class="contents-list">
                        <li><span>01</span>Home - Halaman Utama</li>
                        <li><span>02</span>Tentang - Informasi Sekolah</li>
                        <li><span>03</span>Data Log - Riwayat Kehadiran</li>
                        <li><span>04</span>Data Pengguna - Profil Siswa</li>
                        <li><span>05</span>Pengaturan - Konfigurasi Tema</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tentang Page -->
        <div class="page" id="tentang">
            <div class="page-header">
                <h1 class="page-title">Tentang SMKN Takeran</h1>
                <p class="page-description">Sistem Manajemen Sekolah Digital</p>
            </div>
            <div class="content-section">
                <p class="section-text">
                    SMKN Takeran adalah sekolah menengah kejuruan yang berkomitmen untuk memberikan pendidikan berkualitas dan menghasilkan lulusan yang siap kerja. Kami mengintegrasikan teknologi dalam proses pembelajaran dan administrasi untuk meningkatkan efisiensi.
                </p>
                <p class="section-text">
                    Dashboard ini merupakan bagian dari upaya digitalisasi sistem manajemen sekolah, yang memungkinkan guru, siswa, dan staf administrasi untuk mengakses informasi dengan cepat dan akurat.
                </p>
                <h3 style="margin-top: 40px; margin-bottom: 20px; font-size: 24px; color: var(--text-primary);">Fitur Utama</h3>
                <ul style="list-style-position: inside; line-height: 2; color: var(--text-primary);">
                    <li>Real-time attendance tracking dan monitoring</li>
                    <li>Database siswa yang terorganisir</li>
                    <li>Sistem reporting yang komprehensif</li>
                    <li>Interface yang user-friendly</li>
                    <li>Cloud-based storage dengan Supabase</li>
                    <li>Dark mode untuk kenyamanan mata</li>
                </ul>
            </div>
        </div>

        <!-- Data Log Page -->
        <div class="page" id="log">
            <div class="page-header">
                <h1 class="page-title">Data Log Kehadiran</h1>
                <p class="page-description">Riwayat kehadiran siswa dari tabel attendance</p>
            </div>
            <div class="log-container">
                <div id="logContent" class="loading">Memuat data log...</div>
            </div>
        </div>

        <!-- Tabel Data Page -->
        <div class="page" id="tabel">
            <div class="page-header">
                <h1 class="page-title">Data Pengguna</h1>
                <p class="page-description">Informasi profil siswa dari tabel profiles</p>
            </div>
            <div class="table-container">
                <div class="table-actions">
                    <div class="bulk-actions">
                        <button class="btn btn-small btn-danger" onclick="deleteSelected()" id="deleteBtn" disabled>
                            🗑️ Hapus Terpilih
                        </button>
                    </div>
                    <button class="btn btn-small btn-success" onclick="openAddModal()">
                        ➕ Tambah Data
                    </button>
                </div>
                <div id="tableContent" class="loading">Memuat data tabel...</div>
            </div>
        </div>

        <!-- Pengaturan Page -->
        <div class="page" id="pengaturan">
            <div class="page-header">
                <h1 class="page-title">Pengaturan</h1>
                <p class="page-description">Konfigurasi tampilan aplikasi</p>
            </div>
            <div class="settings-container">
                <div class="settings-group">
                    <label class="settings-label">Tema Tampilan</label>
                    <div class="theme-switch">
                        <span style="color: var(--text-primary);">☀️ Terang</span>
                        <label class="switch">
                            <input type="checkbox" id="themeToggle">
                            <span class="slider"></span>
                        </label>
                        <span style="color: var(--text-primary);">🌙 Gelap</span>
                    </div>
                    <p style="margin-top: 15px; font-size: 13px; color: var(--text-secondary);">
                        Pilih tema yang nyaman untuk mata Anda. Tema gelap dapat mengurangi kelelahan mata saat digunakan dalam waktu lama.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Add/Edit Data -->
    <div class="modal" id="dataModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Tambah Data Pengguna</h2>
            </div>
            <form id="dataForm">
                <input type="hidden" id="editId">
                <div id="formFields"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Configuration
        const config = {
            supabaseUrl: 'https://ixetxxeztvdxtukxnifu.supabase.co',
            supabaseKey: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Iml4ZXR4eGV6dHZkeHR1a3huaWZ1Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTg3NjU0NjgsImV4cCI6MjA3NDM0MTQ2OH0.59vGbOxRHZ6xZRnosTf-Whbs2JWQBp7joarh95EGOJg',
            logTable: 'attendance',
            dataTable: 'profiles'
        };

        // Theme Management
        function initTheme() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            document.getElementById('themeToggle').checked = savedTheme === 'dark';
        }

        document.getElementById('themeToggle').addEventListener('change', function() {
            const theme = this.checked ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        });

        // Navigation
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
                
                document.querySelectorAll('.page').forEach(page => page.classList.remove('active'));
                const pageId = this.getAttribute('data-page');
                document.getElementById(pageId).classList.add('active');
                
                if (pageId === 'log') {
                    loadLogs();
                } else if (pageId === 'tabel') {
                    loadTable();
                }
            });
        });

        // Fetch data from Supabase
        async function fetchFromSupabase(table) {
            try {
                const response = await fetch(`${config.supabaseUrl}/rest/v1/${table}?select=*&order=created_at.desc`, {
                    headers: {
                        'apikey': config.supabaseKey,
                        'Authorization': `Bearer ${config.supabaseKey}`,
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(`HTTP ${response.status}: ${errorText}`);
                }

                return await response.json();
            } catch (error) {
                console.error('Fetch error:', error);
                return { error: error.message };
            }
        }

        // Load logs
        async function loadLogs() {
            const container = document.getElementById('logContent');
            container.innerHTML = '<div class="loading">Memuat data log...</div>';

            const data = await fetchFromSupabase(config.logTable);

            if (data.error) {
                container.innerHTML = `<div class="error-message">Error: ${data.error}</div>`;
                return;
            }

            if (!Array.isArray(data) || data.length === 0) {
                container.innerHTML = '<div style="padding: 20px; color: #999;">Tidak ada data log kehadiran.</div>';
                return;
            }

            container.innerHTML = data.map(log => {
                const date = log.created_at ? new Date(log.created_at).toLocaleString('id-ID') : 'N/A';
                const name = log.user_name || log.full_name || log.name || 'Unknown User';
                const status = log.status || log.action || 'Check-in';
                const initials = name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
                
                return `
                    <div class="log-entry">
                        <div class="log-avatar">${initials}</div>
                        <div class="log-details">
                            <div class="log-header">
                                <span class="log-name">${name}</span>
                                <span class="log-time">${date}</span>
                            </div>
                            <div class="log-message">Status: ${status}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Load table data
        let selectedRows = new Set();
        let currentData = [];

        async function loadTable() {
            const container = document.getElementById('tableContent');
            container.innerHTML = '<div class="loading">Memuat data tabel...</div>';

            const data = await fetchFromSupabase(config.dataTable);

            if (data.error) {
                container.innerHTML = `<div class="error-message">Error: ${data.error}</div>`;
                return;
            }

            if (!Array.isArray(data) || data.length === 0) {
                container.innerHTML = '<div style="padding: 20px; color: #999;">Tidak ada data pengguna.</div>';
                return;
            }

            currentData = data;
            selectedRows.clear();
            document.getElementById('deleteBtn').disabled = true;

            const keys = [...new Set(data.flatMap(item => Object.keys(item)))];

            container.innerHTML = `
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">
                                <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)">
                            </th>
                            ${keys.map(key => `<th>${key}</th>`).join('')}
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${data.map((row, index) => `
                            <tr>
                                <td>
                                    <input type="checkbox" class="row-checkbox" data-id="${row.id}" onchange="toggleRowSelection(this)">
                                </td>
                                ${keys.map(key => {
                                    let value = row[key];
                                    if (value === null || value === undefined) value = '-';
                                    if (typeof value === 'object') value = JSON.stringify(value);
                                    return `<td>${value}</td>`;
                                }).join('')}
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon btn-edit" onclick='editRow(${JSON.stringify(row)})'>✏️ Edit</button>
                                        <button class="btn-icon btn-delete" onclick="deleteRow('${row.id}')">🗑️</button>
                                    </div>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;
        }

        function toggleSelectAll(checkbox) {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(cb => {
                cb.checked = checkbox.checked;
                if (checkbox.checked) {
                    selectedRows.add(cb.dataset.id);
                } else {
                    selectedRows.delete(cb.dataset.id);
                }
            });
            updateDeleteButton();
        }

        function toggleRowSelection(checkbox) {
            if (checkbox.checked) {
                selectedRows.add(checkbox.dataset.id);
            } else {
                selectedRows.delete(checkbox.dataset.id);
                document.getElementById('selectAll').checked = false;
            }
            updateDeleteButton();
        }

        function updateDeleteButton() {
            document.getElementById('deleteBtn').disabled = selectedRows.size === 0;
        }

        // Modal functions
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Data Pengguna';
            document.getElementById('editId').value = '';
            
            // Generate form fields based on current data structure
            const sampleData = currentData[0] || {};
            const fields = Object.keys(sampleData).filter(key => 
                key !== 'id' && 
                key !== 'created_at' && 
                key !== 'updated_at'
            );
            
            const formFields = document.getElementById('formFields');
            formFields.innerHTML = fields.map(field => {
                const fieldType = field.toLowerCase().includes('email') ? 'email' : 'text';
                return `
                    <div class="form-group">
                        <label class="form-label">${field}</label>
                        <input type="${fieldType}" class="form-input" name="${field}" required>
                    </div>
                `;
            }).join('');
            
            document.getElementById('dataModal').classList.add('active');
        }

        function editRow(row) {
            document.getElementById('modalTitle').textContent = 'Edit Data Pengguna';
            document.getElementById('editId').value = row.id;
            
            const fields = Object.keys(row).filter(key => 
                key !== 'id' && 
                key !== 'created_at' && 
                key !== 'updated_at'
            );
            
            const formFields = document.getElementById('formFields');
            formFields.innerHTML = fields.map(field => {
                const fieldType = field.toLowerCase().includes('email') ? 'email' : 'text';
                return `
                    <div class="form-group">
                        <label class="form-label">${field}</label>
                        <input type="${fieldType}" class="form-input" name="${field}" value="${row[field] || ''}" required>
                    </div>
                `;
            }).join('');
            
            document.getElementById('dataModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('dataModal').classList.remove('active');
            document.getElementById('dataForm').reset();
        }

        // CRUD Operations
        async function deleteRow(id) {
            if (!confirm('Yakin ingin menghapus data ini?')) return;
            
            try {
                const response = await fetch(`${config.supabaseUrl}/rest/v1/${config.dataTable}?id=eq.${id}`, {
                    method: 'DELETE',
                    headers: {
                        'apikey': config.supabaseKey,
                        'Authorization': `Bearer ${config.supabaseKey}`
                    }
                });

                if (response.ok) {
                    alert('Data berhasil dihapus!');
                    loadTable();
                } else {
                    throw new Error('Gagal menghapus data');
                }
            } catch (error) {
                alert('Error: ' + error.message);
            }
        }

        async function deleteSelected() {
            if (selectedRows.size === 0) return;
            if (!confirm(`Yakin ingin menghapus ${selectedRows.size} data terpilih?`)) return;
            
            try {
                for (const id of selectedRows) {
                    await fetch(`${config.supabaseUrl}/rest/v1/${config.dataTable}?id=eq.${id}`, {
                        method: 'DELETE',
                        headers: {
                            'apikey': config.supabaseKey,
                            'Authorization': `Bearer ${config.supabaseKey}`
                        }
                    });
                }
                alert('Data berhasil dihapus!');
                loadTable();
            } catch (error) {
                alert('Error: ' + error.message);
            }
        }

        // Form submit
        document.getElementById('dataForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            const editId = document.getElementById('editId').value;
            
            try {
                let response;
                if (editId) {
                    // Update - don't send created_at
                    const updateData = {...data};
                    delete updateData.created_at;
                    
                    response = await fetch(`${config.supabaseUrl}/rest/v1/${config.dataTable}?id=eq.${editId}`, {
                        method: 'PATCH',
                        headers: {
                            'apikey': config.supabaseKey,
                            'Authorization': `Bearer ${config.supabaseKey}`,
                            'Content-Type': 'application/json',
                            'Prefer': 'return=minimal'
                        },
                        body: JSON.stringify(updateData)
                    });
                } else {
                    // Insert - let database handle id and created_at automatically
                    const insertData = {...data};
                    delete insertData.id;
                    delete insertData.created_at;
                    
                    response = await fetch(`${config.supabaseUrl}/rest/v1/${config.dataTable}`, {
                        method: 'POST',
                        headers: {
                            'apikey': config.supabaseKey,
                            'Authorization': `Bearer ${config.supabaseKey}`,
                            'Content-Type': 'application/json',
                            'Prefer': 'return=minimal'
                        },
                        body: JSON.stringify(insertData)
                    });
                }

                if (response.ok) {
                    alert(editId ? 'Data berhasil diupdate!' : 'Data berhasil ditambahkan!');
                    closeModal();
                    loadTable();
                } else {
                    const errorText = await response.text();
                    console.error('Error response:', errorText);
                    throw new Error(errorText);
                }
            } catch (error) {
                console.error('Submit error:', error);
                alert('Error: ' + error.message);
            }
        });

        // Initialize
        initTheme();

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('dataModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Contact button
        document.getElementById('contactUs').addEventListener('click', (e) => {
            e.preventDefault();
            alert('Hubungi kami di: regan.dewa39@smk.belajar.id');
        });
    </script>
</body>
</html>
