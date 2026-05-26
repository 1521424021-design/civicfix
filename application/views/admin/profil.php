<div class="container-fluid py-4">
    <div class="row g-4">
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate__animated animate__fadeInLeft">
                <div class="p-5 text-center" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%);">
                    <div class="avatar-wrapper position-relative d-inline-block">
                        <div class="avatar-circle shadow-lg d-flex align-items-center justify-content-center bg-white text-dark mb-3">
                            <h1 class="display-3 fw-800 mb-0"><?= substr($user->nama, 0, 1); ?></h1>
                        </div>
                        <span class="position-absolute bottom-0 end-0 bg-success border border-4 border-white rounded-circle p-2 shadow-sm" title="Online Status"></span>
                    </div>
                    <h4 class="fw-bold text-white mb-1"><?= $user->nama; ?></h4>
                    <p class="text-white-50 small text-uppercase ls-2 fw-bold">Super Administrator</p>
                </div>

                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box-sm bg-soft-primary text-primary me-3">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 10px;">Email Resmi</small>
                            <span class="fw-bold text-dark"><?= $user->email; ?></span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box-sm bg-soft-info text-info me-3">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 10px;">Level Akses</small>
                            <span class="fw-bold text-danger">Root Level Control</span>
                        </div>
                    </div>

                    <hr class="my-4 opacity-5">
                    
                    <div class="d-grid">
                        <button class="btn btn-dark rounded-pill py-2 fw-bold shadow-sm hover-up">
                            <i class="bi bi-pencil-square me-2"></i> Edit Konfigurasi Profil
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white animate__animated animate__fadeInUp">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="fw-800 mb-0"><?= number_format($total_verifikasi); ?></h3>
                                <small class="text-muted fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 1px;">Laporan Diverifikasi</small>
                            </div>
                            <div class="bg-soft-success rounded-circle p-3">
                                <i class="bi bi-check-all fs-2 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="fw-800 mb-0"><?= number_format($total_user); ?></h3>
                                <small class="text-muted fw-bold text-uppercase" style="font-size: 11px; letter-spacing: 1px;">Pengguna Terdaftar</small>
                            </div>
                            <div class="bg-soft-primary rounded-circle p-3">
                                <i class="bi bi-people fs-2 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="card-header bg-white border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-gear-fill text-primary me-2"></i>Pengaturan Keamanan Akun
                    </h5>
                </div>
                <div class="card-body p-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 py-3 border-light d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Otentikasi Dua Faktor</h6>
                                <small class="text-muted">Tambahkan lapisan keamanan ekstra menggunakan kode OTP.</small>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked style="cursor:pointer;">
                            </div>
                        </li>
                        <li class="list-group-item px-0 py-3 border-light d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Kredensial Password</h6>
                                <small class="text-muted">Ganti kata sandi secara berkala untuk menjaga keamanan.</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 fw-bold">Update</button>
                        </li>
                        <li class="list-group-item px-0 py-3 border-0 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0 text-danger">Manajemen Sesi Akun</h6>
                                <small class="text-muted">Paksa keluar dari semua perangkat yang sedang login.</small>
                            </div>
                            <button class="btn btn-sm btn-soft-danger rounded-pill px-4 fw-bold text-danger">Logout Sesi Lain</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    /* CUSTOM HD & ESTETIK CSS */
    .fw-800 { font-weight: 800; }
    .ls-2 { letter-spacing: 2px; }
    
    /* Avatar Circle Styling */
    .avatar-circle { 
        width: 120px; 
        height: 120px; 
        border-radius: 50%; 
        border: 6px solid rgba(255,255,255,0.15);
        transition: transform 0.3s ease;
    }
    .avatar-circle:hover { transform: scale(1.05); }

    /* Icon Box Helper */
    .icon-box-sm { 
        width: 42px; 
        height: 42px; 
        border-radius: 12px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 1.1rem; 
    }

    /* Soft Colors */
    .bg-soft-primary { background-color: #eef2ff; }
    .bg-soft-info    { background-color: #e0f2fe; }
    .bg-soft-success { background-color: #f0fdf4; }
    
    /* Danger Button Custom */
    .btn-soft-danger { background-color: #fef2f2; border: none; transition: 0.2s; }
    .btn-soft-danger:hover { background-color: #fee2e2; transform: translateY(-2px); }

    /* General Hover Effect */
    .hover-up { transition: 0.3s; }
    .hover-up:hover { transform: translateY(-3px); }

    /* Fix for badge display */
    .ls-2 { letter-spacing: 1.5px; }
</style>