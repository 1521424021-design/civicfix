<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container-fluid py-4 main-profile-container animate__animated animate__fadeIn">
    
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4 identity-card-premium animate__animated animate__fadeInDown">
                <div class="p-5 text-center position-relative profile-gradient-banner" style="background: linear-gradient(135deg, #0061ff 0%, #60efff 100%);">
                    <div class="position-relative z-index-1">
                        <div class="avatar-xl bg-white text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-lg hover-scale transition-all">
                            <h1 class="display-3 fw-800 mb-0 text-gradient-blue-clip"><?= substr($user->nama, 0, 1); ?></h1>
                        </div>
                        <h3 class="fw-800 text-white mb-1 tracking-tight"><?= $user->nama; ?></h3>
                        <span class="badge bg-white bg-opacity-25 rounded-pill px-4 py-2 mt-2 fw-bold text-uppercase small-caps border border-white border-opacity-25">
                            <i class="bi bi-shield-fill-check me-1 text-warning"></i> Satgas URC Lapangan CivicFix
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-4 p-md-5 bg-white">
                    <h5 class="fw-800 text-dark mb-4 border-bottom pb-2 d-flex align-items-center">
                        <i class="bi bi-person-badge text-primary me-2 fs-4"></i> Informasi Kredensial Personil
                    </h5>
                    
                    <div class="row g-4 label-value-grid">
                        <div class="col-md-6">
                            <label class="small text-uppercase fw-800 text-muted tracking-wider small-caps">Nomor Induk Kependudukan (NIK)</label>
                            <div class="d-flex align-items-center mt-1 p-2-5 bg-light rounded-3 border">
                                <i class="bi bi-card-text text-primary me-3 fs-5"></i>
                                <span class="fw-bold text-dark font-medium"><?= !empty($user->nik) ? $user->nik : 'Belum Diatur'; ?></span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="small text-uppercase fw-800 text-muted tracking-wider small-caps">Alamat Email Aktif</label>
                            <div class="d-flex align-items-center mt-1 p-2-5 bg-light rounded-3 border">
                                <i class="bi bi-envelope-fill text-primary me-3 fs-5"></i>
                                <span class="fw-bold text-dark font-medium"><?= $user->email; ?></span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="small text-uppercase fw-800 text-muted tracking-wider small-caps">Hak Akses Sistem</label>
                            <div class="d-flex align-items-center mt-1 p-2-5 bg-light rounded-3 border">
                                <i class="bi bi-person-gear text-secondary me-3 fs-5"></i>
                                <span class="fw-bold text-dark text-uppercase font-medium"><?= $user->role; ?> FIELD OFFICER</span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="small text-uppercase fw-800 text-muted tracking-wider small-caps">Status Penugasan</label>
                            <div class="d-flex align-items-center mt-1 p-2-5 bg-light rounded-3 border">
                                <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                                <span class="fw-bold text-success text-uppercase font-medium">Aktif & Siap Siaga</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-5 border-light-gray" style="opacity: 0.1;">

                    <div class="alert alert-soft-primary border-0 rounded-4 p-4 mb-0 d-flex align-items-start gap-3 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                        <div class="icon-shape-info bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center shadow-blue">
                            <i class="bi bi-info-circle-fill fs-4"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-primary">Prosedur Operasional Standar (SOP)</h6>
                            <p class="small mb-0 text-muted font-medium line-height-relaxed">
                                Akun ini terintegrasi langsung dengan pemantauan SDGs infrastruktur kota. Pastikan Anda memperbarui laporan penanganan kerusakan secara jujur, mengunggah bukti gambar yang jelas (HD), dan menjaga kerahasiaan hak akses demi keamanan data publik Gorontalo.
                            </p>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
    /* ==========================================================================
       CIVICFIX PETUGAS PROFILE EXCLUSIVE PREMIUM LIGHT MODE STYLING 
       ========================================================================== */
    
    /* Layout Variables */
    .fw-800 { font-weight: 800; }
    .font-medium { font-weight: 600; }
    .tracking-tight { letter-spacing: -0.5px; }
    .tracking-wider { letter-spacing: 0.8px; }
    .small-caps { font-size: 0.7rem; }
    .p-2-5 { padding: 0.75rem 1rem; }
    .line-height-relaxed { line-height: 1.6; }
    .border-light-gray { border-color: #cbd5e1; }

    /* Custom Transitions */
    .transition-all { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

    /* Avatar Banner Custom Design */
    .avatar-xl {
        width: 110px;
        height: 110px;
        border: 6px solid rgba(255, 255, 255, 0.25);
    }
    .text-gradient-blue-clip {
        background: linear-gradient(135deg, #0061ff 0%, #00c6ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    /* Input Display Fields Styling */
    .bg-light {
        background-color: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
    }
    
    /* Alert Soft Themes */
    .alert-soft-primary {
        background-color: #f0f7ff;
    }
    .icon-shape-info {
        width: 44px;
        height: 44px;
    }
    .shadow-blue {
        box-shadow: 0 4px 14px rgba(0, 97, 255, 0.3);
    }

    /* Micro Hover Interactions */
    .hover-scale:hover {
        transform: scale(1.05) rotate(3deg);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15) !important;
    }
</style>