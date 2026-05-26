<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container-fluid py-4 main-profile-warga-container animate__animated animate__fadeIn">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4 table-container-card">
                
                <div class="position-relative profile-gradient-banner" style="height: 180px; background: linear-gradient(135deg, #0061ff 0%, #60efff 100%);">
                    <div class="position-absolute top-100 start-50 translate-middle">
                        <div class="bg-white p-2 rounded-circle shadow-lg animate__animated animate__scaleIn">
                            <div class="avatar-circle-warga text-primary rounded-circle d-flex align-items-center justify-content-center bg-soft-primary shadow-inner">
                                <h1 class="display-3 fw-800 mb-0 text-gradient-blue-clip"><?= substr($this->session->userdata('nama'), 0, 1); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-5 mt-5 px-4 px-md-5 bg-white">
                    <div class="text-center mb-5">
                        <h2 class="fw-800 text-dark mb-1 tracking-tight"><?= $this->session->userdata('nama'); ?></h2>
                        <p class="text-muted small-13 font-medium"><i class="bi bi-envelope-at-fill me-2 text-primary"></i><?= $this->session->userdata('email'); ?></p>
                        
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <span class="badge bg-soft-success text-success rounded-pill px-4 py-2 fw-bold status-badge-premium shadow-sm">
                                <i class="bi bi-patch-check-fill me-1"></i> Akun Terverifikasi
                            </span>
                            <span class="badge bg-soft-primary text-primary rounded-pill px-4 py-2 fw-bold status-badge-premium shadow-sm">
                                <i class="bi bi-person-badge me-1"></i> Role: <?= $this->session->userdata('role'); ?>
                            </span>
                        </div>
                    </div>

                    <hr class="border-light-gray mb-5">

                    <div class="row text-center mb-5 g-3 stats-counter-row">
                        <?php 
                            $total = is_array($laporan_saya) ? count($laporan_saya) : 0;
                            $done = 0; $pending = 0;
                            if($total > 0) {
                                foreach($laporan_saya as $l) {
                                    if($l->status == 'Selesai') $done++;
                                    if($l->status == 'Pending') $pending++;
                                }
                            }
                        ?>
                        <div class="col-4">
                            <div class="p-3 rounded-4 bg-light shadow-xsm transition-all hover-up-small border">
                                <h4 class="fw-800 text-primary mb-0"><?= $total; ?></h4>
                                <small class="text-muted text-uppercase fw-800 x-small tracking-wider">Aduan Saya</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 rounded-4 bg-light shadow-xsm transition-all hover-up-small border">
                                <h4 class="fw-800 text-success mb-0"><?= $done; ?></h4>
                                <small class="text-muted text-uppercase fw-800 x-small tracking-wider">Tuntas</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 rounded-4 bg-light shadow-xsm transition-all hover-up-small border">
                                <h4 class="fw-800 text-warning mb-0"><?= $pending; ?></h4>
                                <small class="text-muted text-uppercase fw-800 x-small tracking-wider">Antrean</small>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-5 layout-data-grid">
                        <div class="col-12">
                            <h6 class="fw-800 text-dark text-uppercase small tracking-wider mb-0 d-flex align-items-center">
                                <span class="bg-primary p-1 rounded-1 me-2" style="height: 18px; width: 4px; display: inline-block;"></span>
                                Kredensial & Lokasi Terverifikasi
                            </h6>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="p-4 bg-soft-primary rounded-4 h-100 border border-white shadow-xsm">
                                <label class="text-primary fw-800 x-small d-block mb-1 text-uppercase tracking-wider">Nomor Induk Kependudukan (NIK)</label>
                                <span class="fw-bold text-dark small-13">
                                    <?= (!empty($user) && !empty($user->nik)) ? $user->nik : ($this->session->userdata('nik') ? $this->session->userdata('nik') : '<span class="text-muted italic x-small font-medium">Data belum tersedia</span>'); ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="p-4 bg-soft-primary rounded-4 h-100 border border-white shadow-xsm">
                                <label class="text-primary fw-800 x-small d-block mb-1 text-uppercase tracking-wider">Domisili Utama</label>
                                <span class="fw-bold text-dark small-13 lh-base">
                                    <?= (!empty($user) && !empty($user->alamat)) ? $user->alamat : ($this->session->userdata('alamat') ? $this->session->userdata('alamat') : '<span class="text-muted italic x-small font-medium">Alamat belum dilengkapi</span>'); ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-4 h-100 shadow-xsm">
                                <label class="text-muted fw-800 x-small d-block mb-1 text-uppercase tracking-wider">Origin Instansi</label>
                                <span class="fw-bold text-dark small-13 d-block">Universitas Negeri Gorontalo</span>
                                <small class="text-primary fw-bold x-small italic-style">Fakultas Vokasi &bull; TRPL 2026</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="p-4 bg-light rounded-4 h-100 shadow-xsm">
                                <label class="text-muted fw-800 x-small d-block mb-1 text-uppercase tracking-wider">Status Keamanan Akun</label>
                                <span class="fw-bold text-dark small-13 d-block"><i class="bi bi-shield-fill-check text-success me-1"></i> Enkripsi End-to-End Aktif</span>
                                <small class="text-muted x-small italic-style">Terakhir Akses: <?= date('d/m/Y H:i'); ?> WITA</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mb-2 pt-4 border-top border-light-gray">
                        <a href="<?= base_url('warga/edit_profil'); ?>" class="btn btn-premium-action rounded-pill px-5 py-3 shadow-blue fw-800 text-uppercase tracking-wider hover-up">
                            <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Data Profil
                        </a>
                        <a href="<?= base_url('auth/logout'); ?>" class="btn btn-soft-danger rounded-pill px-5 py-3 fw-bold text-uppercase tracking-wider transition-all" onclick="return confirm('Yakin ingin memutus sesi akun?')">
                            Logout Session <i class="bi bi-power ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 bg-premium-dark text-white rounded-4 shadow-sm p-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-20 rounded-circle p-3 me-4 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                        <i class="bi bi-incognito text-warning fs-3"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-800 text-warning">Proteksi Identitas CivicFix</h6>
                        <p class="small opacity-75 mb-0">Kami menjamin keamanan tingkat tinggi dan kerahasiaan identitas pelapor. Data NIK dan Domisili Anda terenkripsi penuh dan hanya digunakan untuk kepentingan validasi fisik laporan oleh instansi terkait.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* ==========================================================================
       CIVICFIX CITIZEN PROFILE EXCLUSIVE PREMIUM LIGHT MODE STYLING 
       ========================================================================== */
    
    /* Utilities Layout */
    .fw-800 { font-weight: 800; }
    .font-medium { font-weight: 500; }
    .tracking-tight { letter-spacing: -0.5px; }
    .tracking-wider { letter-spacing: 0.8px; }
    .small-13 { font-size: 0.88rem; }
    .x-small { font-size: 0.72rem; }
    .italic-style { font-style: italic; }
    .border-light-gray { border-color: #f1f5f9; opacity: 1; }

    /* Avatar Sizing Dynamic Box */
    .avatar-circle-warga {
        width: 130px;
        height: 130px;
        border: 5px solid #ffffff;
    }
    .text-gradient-blue-clip {
        background: linear-gradient(135deg, #0061ff 0%, #00c6ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Soft Tones Panels Base */
    .bg-soft-primary { background-color: #eff6ff; }
    .bg-light { background-color: #f8fafc !important; }
    .shadow-xsm { box-shadow: 0 2px 8px rgba(0,0,0,0.015); }
    .table-container-card { border: 1px solid rgba(226, 232, 240, 0.8); }

    /* Action Trigger Button Custom (Dark Tone) */
    .btn-premium-action {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        border: none;
        color: #ffffff;
        font-size: 0.88rem;
    }
    .btn-premium-action:hover {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #ffffff;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.25) !important;
    }
    .btn-soft-danger {
        background-color: #fef2f2;
        color: #b91c1c;
        border: none;
        font-size: 0.88rem;
    }
    .btn-soft-danger:hover {
        background-color: #fee2e2;
        color: #991b1b;
    }
    .bg-premium-dark {
        background-color: #1e293b;
    }

    /* Badge Customizations */
    .status-badge-premium { font-size: 0.72rem; letter-spacing: 0.5px; }
    
    /* Animations & Hover Tricks */
    .transition-all { transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); }
    .hover-up { transition: 0.3s; }
    .hover-up:hover { transform: translateY(-3px); }
    .hover-up-small:hover { transform: translateY(-2px); background-color: #ffffff !important; }
    .shadow-blue { box-shadow: 0 8px 20px rgba(30, 41, 59, 0.15); }
</style>