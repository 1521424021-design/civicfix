<nav id="sidebar">
    <div class="sidebar-header text-center">
        <h3 class="fw-800 mb-0 brand-logo-text">CivicFix</h3>
        <small class="text-muted small-caps-tracking">Gorontalo Smart City</small>
    </div>

    <ul class="list-unstyled components flex-grow-1">
        <?php 
            $current_role = $this->session->userdata('role');
            $dashboard_url = strtolower($current_role) . '/dashboard';
            
            // Pengaman Alur URL SQA khusus Warga
            if ($current_role == 'Warga') {
                $dashboard_url = 'warga'; 
            }
        ?>
        <li class="<?= ($this->uri->segment(2) == 'dashboard' || ($this->uri->segment(1) == 'warga' && empty($this->uri->segment(2)))) ? 'active' : ''; ?>">
            <a href="<?= base_url($dashboard_url); ?>">
                <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard Utama
            </a>
        </li>
        
        <?php if($current_role == 'Warga'): ?>
            <li class="<?= ($this->uri->segment(2) == 'kirim_laporan' || $this->uri->segment(2) == 'buat-laporan') ? 'active' : ''; ?>">
                <a href="<?= base_url('warga/kirim_laporan'); ?>">
                    <i class="bi bi-megaphone-fill me-3"></i> Buat Laporan Baru
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) == 'laporan_saya') ? 'active' : ''; ?>">
                <a href="<?= base_url('warga/laporan_saya'); ?>">
                    <i class="bi bi-folder-fill me-3"></i> Berkas Laporan Saya
                </a>
            </li>
        <?php endif; ?>

        <?php if($current_role == 'Admin'): ?>
            <li class="<?= ($this->uri->segment(2) == 'manajemen_user' || $this->uri->segment(2) == 'users') ? 'active' : ''; ?>">
                <a href="<?= base_url('admin/manajemen_user'); ?>">
                    <i class="bi bi-people-fill me-3"></i> Manajemen Pengguna
                </a>
            </li>
        <?php endif; ?>

        <?php $role_folder = strtolower($current_role); ?>
        <li class="<?= ($this->uri->segment(2) == 'profil') ? 'active' : ''; ?>">
            <a href="<?= base_url($role_folder.'/profil'); ?>">
                <i class="bi bi-person-bounding-box me-3"></i> Profil Akun Saya
            </a>
        </li>
    </ul>

    <ul class="list-unstyled components mb-4 border-top border-light-gray pt-3">
        <li>
            <a href="<?= base_url('auth/logout'); ?>" class="logout-link" onclick="return confirm('Yakin ingin keluar dari sistem kendali CivicFix?')">
                <i class="bi bi-power me-3 fs-5"></i> <span>Keluar Sistem</span>
            </a>
        </li>
    </ul>
</nav>

<div id="content">
    
    <nav class="navbar-custom d-flex justify-content-between align-items-center">
        <button type="button" id="sidebarCollapse" class="btn btn-toggle-sidebar shadow-sm rounded-circle">
            <i class="bi bi-text-paragraph fs-5"></i>
        </button>
        
        <div class="user-profile-pill d-flex align-items-center shadow-xsm">
            <div class="text-end me-3 d-none d-sm-block">
                <span class="small-caps-tracking text-muted d-block mb-0-5"><?= $this->session->userdata('role'); ?></span>
                <span class="fw-bold text-dark small-13"><?= $this->session->userdata('nama'); ?></span>
            </div>
            <div class="avatar-navbar-circle text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm fw-800">
                <?= substr($this->session->userdata('nama'), 0, 1); ?>
            </div>
        </div>
    </nav>

    <style>
        #sidebar { 
            min-width: 270px; max-width: 270px; 
            background: #ffffff !important; color: #334155 !important; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            position: relative; min-height: 100vh;
            border-right: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.008);
            display: flex; flex-direction: column;
        }
        #sidebar .sidebar-header { padding: 32px 24px; background: #ffffff; border-bottom: 1px solid #f1f5f9; }
        .brand-logo-text {
            font-size: 1.4rem; font-weight: 800;
            background: linear-gradient(135deg, #0061ff 0%, #60efff 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.5px;
        }
        .small-caps-tracking { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; }
        #sidebar ul.components { padding: 15px 0; }
        #sidebar ul li a { 
            padding: 14px 20px; display: flex; align-items: center;
            color: #64748b; text-decoration: none; transition: all 0.2s ease;
            font-size: 0.88rem; font-weight: 600; margin: 4px 16px; border-radius: 12px;
        }
        #sidebar ul li a:hover { color: #0061ff !important; background: #f0f7ff; padding-left: 24px; }
        #sidebar ul li a i { font-size: 1.15rem; transition: 0.2s; }
        #sidebar ul li a:hover i { transform: scale(1.1); }
        #sidebar ul li.active > a { color: #0061ff !important; background: #e0f2fe !important; font-weight: 700; }
        .border-light-gray { border-color: #f1f5f9 !important; }
        .logout-link { color: #ef4444 !important; }
        .logout-link:hover { background: #fef2f2 !important; color: #b91c1c !important; }
        
        /* Top Navbar Architecture */
        .navbar-custom { 
            background: #ffffff !important; padding: 16px 32px; 
            border-bottom: 1px solid rgba(226, 232, 240, 0.8); margin-bottom: 20px;
        }
        .btn-toggle-sidebar {
            background-color: #ffffff; border: 1px solid #e2e8f0; color: #475569;
            width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; transition: all 0.2s;
        }
        .btn-toggle-sidebar:hover { background-color: #f8fafc; color: #0061ff; border-color: #cbd5e1; }
        .user-profile-pill { background: #f8fafc; border: 1px solid #e2e8f0; padding: 6px 6px 6px 16px; border-radius: 50px; }
        .avatar-navbar-circle {
            width: 36px; height: 36px; font-size: 0.95rem;
            background: linear-gradient(135deg, #0061ff 0%, #60efff 100%);
            box-shadow: 0 4px 10px rgba(0, 97, 255, 0.15);
        }
        .mb-0-5 { margin-bottom: 1px; }
    </style>