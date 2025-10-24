<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redo - Brand Guidelines</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .nav-link {
            position: relative;
            transition: color 0.2s ease;
        }
        
        .nav-link.active {
            color: #111827;
            font-weight: 500;
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #111827;
        }
        
        .sidebar-link.active {
            background-color: #f9fafb;
            color: #111827;
            font-weight: 500;
            border-left: 3px solid #111827;
        }
        
        .content-section {
            display: none;
        }
        
        .content-section.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            border: 1px solid #e5e7eb;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Header/Navigation -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-bold text-gray-900">c.Redo</span>
                    </div>
                    <!-- Navigation Links -->
                    <nav class="ml-8 flex space-x-8">
                        <a href="#" data-section="home" class="nav-link active text-gray-900">Home[21]</a>
                        <a href="#" data-section="tentang" class="nav-link text-gray-500 hover:text-gray-900">Tentang[22]</a>
                        <a href="#" data-section="data-log" class="nav-link text-gray-500 hover:text-gray-900">Data Log[23]</a>
                        <a href="#" data-section="tabel-data" class="nav-link text-gray-500 hover:text-gray-900">Tabel Data[24]</a>
                        <a href="#" data-section="pengaturan" class="nav-link text-gray-500 hover:text-gray-900">Pengaturan[25]</a>
                    </nav>
                </div>
                
                <!-- CTA Buttons -->
                <div class="flex items-center space-x-4">
                    <button class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded text-sm font-medium transition duration-150">
                        Download Kit
                    </button>
                    <button class="border border-gray-900 text-gray-900 hover:bg-gray-50 px-4 py-2 rounded text-sm font-medium transition duration-150">
                        Contact Us
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="flex max-w-7xl mx-auto">
        <!-- Sidebar -->
        <div class="w-64 bg-white min-h-screen py-8 hidden md:block">
            <div class="px-6">
                <h2 class="text-sm font-semibold text-gray-900 mb-4 uppercase tracking-wide">Contents</h2>
                <ul class="space-y-1">
                    <li><a href="#" data-section="brand-strategy" class="sidebar-link active block py-2 px-4 text-sm rounded-md">01 Brand Strategy</a></li>
                    <li><a href="#" data-section="personality" class="sidebar-link block py-2 px-4 text-sm rounded-md text-gray-700 hover:bg-gray-50">02 Personality</a></li>
                    <li><a href="#" data-section="logo" class="sidebar-link block py-2 px-4 text-sm rounded-md text-gray-700 hover:bg-gray-50">03 Logo</a></li>
                    <li><a href="#" data-section="color" class="sidebar-link block py-2 px-4 text-sm rounded-md text-gray-700 hover:bg-gray-50">04 Color</a></li>
                    <li><a href="#" data-section="typography" class="sidebar-link block py-2 px-4 text-sm rounded-md text-gray-700 hover:bg-gray-50">05 Typography</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 py-8 px-6">
            <?php
            // Konfigurasi Supabase
            $supabase_url = 'https://ixetxxeztvdxtukxnifu.supabase.co';
            $supabase_key = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Iml4ZXR4eGV6dHZkeHR1a3huaWZ1Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTg3NjU0NjgsImV4cCI6MjA3NDM0MTQ2OH0.59vGbOxRHZ6xZRnosTf-Whbs2JWQBp7joarh95EGOJg';
            
            // Fungsi untuk membuat request ke Supabase
            function supabaseRequest($method, $table, $data = null, $query = '') {
                global $supabase_url, $supabase_key;
                
                $url = $supabase_url . '/rest/v1/' . $table . $query;
                
                $options = [
                    'http' => [
                        'method' => $method,
                        'header' => [
                            'Content-Type: application/json',
                            'apikey: ' . $supabase_key,
                            'Authorization: Bearer ' . $supabase_key,
                            'Prefer: return=representation'
                        ],
                        'ignore_errors' => true
                    ]
                ];
                
                if ($data) {
                    $options['http']['content'] = json_encode($data);
                }
                
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                
                return json_decode($result, true);
            }

            // Proses form tambah data
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['full_name']) && isset($_POST['username'])) {
                    $full_name = htmlspecialchars($_POST['full_name']);
                    $username = htmlspecialchars($_POST['username']);
                    
                    $data = [
                        'full_name' => $full_name,
                        'username' => $username,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
                    $result = supabaseRequest('POST', 'profiles', $data);
                    
                    if ($result && !isset($result['message'])) {
                        $success_message = '<div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">Data berhasil ditambahkan!</div>';
                    } else {
                        $error_message = '<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">Gagal menambahkan data: ' . ($result['message'] ?? 'Unknown error') . '</div>';
                    }
                }
                
                if (isset($_POST['log_message'])) {
                    $log_message = htmlspecialchars($_POST['log_message']);
                    $log_type = htmlspecialchars($_POST['log_type']);
                    
                    $data = [
                        'message' => $log_message,
                        'type' => $log_type,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
                    $result = supabaseRequest('POST', 'logs', $data);
                    
                    if ($result && !isset($result['message'])) {
                        $success_message = '<div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">Log berhasil ditambahkan!</div>';
                    } else {
                        $error_message = '<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">Gagal menambahkan log: ' . ($result['message'] ?? 'Unknown error') . '</div>';
                    }
                }
            }
            
            // Ambil data dari Supabase
            $users = supabaseRequest('GET', 'profiles', null, '?select=*&order=created_at.desc&limit=100');
            $logs = supabaseRequest('GET', 'logs', null, '?select=*&order=created_at.desc&limit=50');
            ?>

            <!-- Home Section -->
            <div id="home" class="content-section active">
                <!-- Page Title -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900">Redo</h1>
                    <h2 class="text-2xl font-semibold text-gray-700 mt-2">Brand Guidelines</h2>
                </div>

                <!-- Brand Strategy Content -->
                <div class="prose max-w-none mb-12">
                    <p class="text-gray-700 mb-4 text-lg leading-relaxed">
                        This guide defines the visual language, design style, and principles that shape a clear and consistent brand experience, no matter the team or area of expertise.
                    </p>
                    <p class="text-gray-700 mb-4 text-lg leading-relaxed">
                        At its core, Redo is about precision and clarity—just like our mission to correct financial errors and optimize balance sheets. This guide lays out the essential design standards that bring our brand to life, from our color system and typography to accessibility benchmarks and documentation.
                    </p>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Whether you're designing for digital platforms or printed materials, these guidelines ensure every touchpoint reflects the trust and efficiency at the heart of Redo.
                    </p>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="stat-card rounded-lg p-6 text-center">
                        <div class="text-2xl font-bold text-gray-900 mb-2"><?php echo is_array($users) ? count($users) : 0; ?></div>
                        <div class="text-sm text-gray-600">Total Users</div>
                    </div>
                    <div class="stat-card rounded-lg p-6 text-center">
                        <div class="text-2xl font-bold text-gray-900 mb-2"><?php echo is_array($logs) ? count($logs) : 0; ?></div>
                        <div class="text-sm text-gray-600">System Logs</div>
                    </div>
                    <div class="stat-card rounded-lg p-6 text-center">
                        <div class="text-2xl font-bold text-gray-900 mb-2">24/7</div>
                        <div class="text-sm text-gray-600">Uptime</div>
                    </div>
                </div>
            </div>

            <!-- Tentang Section -->
            <div id="tentang" class="content-section">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Tentang Redo</h3>
                <div class="prose max-w-none">
                    <p class="text-gray-700 mb-4 text-lg leading-relaxed">
                        Redo adalah platform inovatif yang berfokus pada koreksi kesalahan finansial dan optimasi balance sheet untuk perusahaan modern.
                    </p>
                    <p class="text-gray-700 mb-4 text-lg leading-relaxed">
                        Dengan teknologi mutakhir dan tim ahli yang berpengalaman, kami membantu bisnis mencapai efisiensi maksimal dalam pengelolaan keuangan.
                    </p>
                </div>
            </div>

            <!-- Data Log Section -->
            <div id="data-log" class="content-section">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Data Log</h3>
                
                <?php if (isset($success_message)) echo $success_message; ?>
                <?php if (isset($error_message)) echo $error_message; ?>

                <!-- Form Tambah Log -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Tambah Log Baru</h4>
                    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="log_message">Pesan Log</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900" 
                                      id="log_message" name="log_message" rows="3" placeholder="Masukkan pesan log" required></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="log_type">Tipe Log</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900" 
                                    id="log_type" name="log_type" required>
                                <option value="info">Info</option>
                                <option value="warning">Warning</option>
                                <option value="error">Error</option>
                                <option value="success">Success</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white font-medium py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition duration-150">
                                Tambah Log
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Daftar Log -->
                <div>
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Daftar Log Sistem</h4>
                    <?php if ($logs && is_array($logs) && count($logs) > 0): ?>
                        <div class="space-y-4">
                            <?php foreach ($logs as $log): ?>
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition duration-150">
                                    <div class="flex justify-between items-start mb-2">
                                        <span class="inline-block px-2 py-1 text-xs font-medium rounded 
                                            <?php echo $log['type'] === 'error' ? 'bg-red-100 text-red-800' : 
                                                   ($log['type'] === 'warning' ? 'bg-yellow-100 text-yellow-800' : 
                                                   ($log['type'] === 'success' ? 'bg-green-100 text-green-800' : 
                                                   'bg-blue-100 text-blue-800')); ?>">
                                            <?php echo strtoupper(htmlspecialchars($log['type'] ?? 'info')); ?>
                                        </span>
                                        <span class="text-sm text-gray-500"><?php echo htmlspecialchars($log['created_at'] ?? ''); ?></span>
                                    </div>
                                    <p class="text-gray-700"><?php echo htmlspecialchars($log['message'] ?? ''); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded">
                            Tidak ada data log atau terjadi kesalahan saat mengambil data.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tabel Data Section -->
            <div id="tabel-data" class="content-section">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Tabel Data Pengguna</h3>
                
                <?php if (isset($success_message)) echo $success_message; ?>
                <?php if (isset($error_message)) echo $error_message; ?>

                <!-- Form Tambah Data -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Tambah Data Pengguna Baru</h4>
                    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="full_name">Nama Lengkap</label>
                            <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900" 
                                   id="full_name" name="full_name" type="text" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="username">Username</label>
                            <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900" 
                                   id="username" name="username" type="text" placeholder="Masukkan username" required>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white font-medium py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition duration-150">
                                Tambah Data
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Tabel Data -->
                <div>
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Daftar Pengguna</h4>
                    <?php if ($users && is_array($users) && count($users) > 0): ?>
                        <div class="overflow-x-auto border border-gray-200 rounded-lg">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="py-3 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                        <th class="py-3 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                        <th class="py-3 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                        <th class="py-3 px-4 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php foreach ($users as $user): ?>
                                        <tr class="hover:bg-gray-50 transition duration-150">
                                            <td class="py-3 px-4 text-sm text-gray-700"><?php echo htmlspecialchars($user['id'] ?? ''); ?></td>
                                            <td class="py-3 px-4 text-sm text-gray-900 font-medium"><?php echo htmlspecialchars($user['full_name'] ?? ''); ?></td>
                                            <td class="py-3 px-4 text-sm text-gray-700">@<?php echo htmlspecialchars($user['username'] ?? ''); ?></td>
                                            <td class="py-3 px-4 text-sm text-gray-700"><?php echo htmlspecialchars($user['created_at'] ?? ''); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded">
                            Tidak ada data pengguna atau terjadi kesalahan saat mengambil data.
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Pengaturan Section -->
            <div id="pengaturan" class="content-section">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Pengaturan Sistem</h3>
                <div class="bg-gray-50 rounded-lg p-6">
                    <p class="text-gray-700 mb-4">Konfigurasi pengaturan sistem dan preferensi aplikasi.</p>
                    <!-- Tambahkan form pengaturan di sini -->
                </div>
            </div>

            <!-- Brand Strategy Content Sections -->
            <div id="brand-strategy" class="content-section">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">01 Brand Strategy</h3>
                <div class="prose max-w-none">
                    <p class="text-gray-700 mb-4 text-lg leading-relaxed">
                        Strategi merek Redo dibangun di atas fondasi presisi, kejelasan, dan kepercayaan. Setiap elemen desain harus mencerminkan nilai-nilai inti ini.
                    </p>
                </div>
            </div>

            <div id="personality" class="content-section">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">02 Personality</h3>
                <p class="text-gray-700">Konten untuk bagian personality...</p>
            </div>

            <div id="logo" class="content-section">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">03 Logo</h3>
                <p class="text-gray-700">Konten untuk bagian logo...</p>
            </div>

            <div id="color" class="content-section">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">04 Color</h3>
                <p class="text-gray-700">Konten untuk bagian color...</p>
            </div>

            <div id="typography" class="content-section">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">05 Typography</h3>
                <p class="text-gray-700">Konten untuk bagian typography...</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navigation functionality
            const navLinks = document.querySelectorAll('.nav-link');
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            const contentSections = document.querySelectorAll('.content-section');
            
            // Main navigation
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links and sections
                    navLinks.forEach(l => l.classList.remove('active'));
                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    contentSections.forEach(s => s.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Show corresponding section
                    const sectionId = this.getAttribute('data-section');
                    document.getElementById(sectionId).classList.add('active');
                });
            });
            
            // Sidebar navigation
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links and sections
                    navLinks.forEach(l => l.classList.remove('active'));
                    sidebarLinks.forEach(l => l.classList.remove('active'));
                    contentSections.forEach(s => s.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Show corresponding section
                    const sectionId = this.getAttribute('data-section');
                    document.getElementById(sectionId).classList.add('active');
                    
                    // Activate home nav link when using sidebar
                    document.querySelector('[data-section="home"]').classList.add('active');
                });
            });
        });
    </script>
</body>
</html>