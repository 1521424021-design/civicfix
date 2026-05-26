<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container-fluid px-4 py-4 main-dashboard-warga animate__animated animate__fadeIn">
    
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden position-relative welcome-premium-banner">
                <div class="card-body p-4 p-md-5 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-4">
                    <div class="banner-text-content">
                        <span class="badge bg-primary text-white rounded-pill px-3 py-1-5 fw-bold small-caps mb-2 shadow-sm animate__animated animate__fadeInLeft">
                            <i class="bi bi-circle-fill text-warning me-1 small-dot"></i> Ruang Publik Warga
                        </span>
                        <h2 class="fw-800 text-dark mb-1 tracking-tight">Halo, <?= $this->session->userdata('nama'); ?>!</h2>
                        <p class="text-muted small-13 mb-0 font-medium">Terima kasih telah bergabung. Kontribusi laporan Anda sangat berarti bagi percepatan pemeliharaan infrastruktur Gorontalo.</p>
                    </div>
                    <div class="banner-action-content flex-shrink-0">
                        <a href="<?= base_url('warga/kirim_laporan'); ?>" class="btn btn-premium-dark shadow-md rounded-pill px-4 py-3 transition-all hover-up-action">
                            <i class="bi bi-megaphone-fill me-2 text-warning fs-6"></i> Buat Pengaduan Baru
                        </a>
                    </div>
                </div>
                <div class="banner-background-overlay"></div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4 statistical-grid-row">
        <?php
            // Logika Counter Aman SQA (Mencegah Loop Error)
            $total_aduan = 0; $pending_aduan = 0; $selesai_aduan = 0;
            if(!empty($laporan_saya) && is_array($laporan_saya)) {
                foreach($laporan_saya as $l) {
                    $total_aduan++;
                    if($l->status == 'Pending') $pending_aduan++;
                    if($l->status == 'Selesai') $selesai_aduan++;
                }
            }
        ?>
        
        <div class="col-12 col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="card card-stat-premium border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                <div class="card-body p-4 d-flex align-items-center justify-content-between position-relative">
                    <div class="stat-content">
                        <p class="text-muted-caps small fw-bold text-uppercase mb-1">Total Aduan Saya</p>
                        <h2 class="fw-800 text-dark mb-0 tracking-tight"><?= number_format($total_aduan); ?> <span class="text-muted fs-6 fw-normal">Berkas</span></h2>
                    </div>
                    <div class="icon-premium-shape bg-soft-primary text-primary rounded-4 d-flex align-items-center justify-content-center">
                        <i class="bi bi-folder2-open fs-3"></i>
                    </div>
                    <div class="decor-indicator-line bg-primary"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="card card-stat-premium border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                <div class="card-body p-4 d-flex align-items-center justify-content-between position-relative">
                    <div class="stat-content">
                        <p class="text-muted-caps small fw-bold text-uppercase mb-1">Dalam Antrean Validasi</p>
                        <h2 class="fw-800 text-dark mb-0 tracking-tight"><?= number_format($pending_aduan); ?> <span class="text-muted fs-6 fw-normal">Laporan</span></h2>
                    </div>
                    <div class="icon-premium-shape bg-soft-warning text-warning-deep rounded-4 d-flex align-items-center justify-content-center">
                        <i class="bi bi-hourglass-split fs-3"></i>
                    </div>
                    <div class="decor-indicator-line bg-warning"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <div class="card card-stat-premium border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                <div class="card-body p-4 d-flex align-items-center justify-content-between position-relative">
                    <div class="stat-content">
                        <p class="text-muted-caps small fw-bold text-uppercase mb-1">Tuntas Diperbaiki</p>
                        <h2 class="fw-800 text-dark mb-0 tracking-tight"><?= number_format($selesai_aduan); ?> <span class="text-muted fs-6 fw-normal">Selesai</span></h2>
                    </div>
                    <div class="icon-premium-shape bg-soft-success text-success-deep rounded-4 d-flex align-items-center justify-content-center">
                        <i class="bi bi-patch-check-fill fs-3"></i>
                    </div>
                    <div class="decor-indicator-line bg-success"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 bg-white layout-infographic-card animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                <div class="card-header bg-white py-4 px-4 border-0">
                    <h5 class="fw-800 text-dark mb-1 d-flex align-items-center">
                        <i class="bi bi-info-circle-fill text-primary me-2 fs-4"></i> Alur Kerja Penanganan Aduan CivicFix
                    </h5>
                    <p class="text-muted small mb-0 font-medium">Transparansi sistem pengawasan dari proses pengiriman masyarakat hingga ekosistem URC selesai</p>
                </div>
                
                <div class="card-body p-4 pt-0">
                    <div class="row g-4">
                        <div class="col-12 col-lg-4">
                            <div class="p-3-5 bg-light-panel border border-dashed rounded-4 h-100 position-relative hover-light-card transition-all">
                                <div class="badge-number bg-soft-primary text-primary fw-800 mb-3 rounded-3 d-flex align-items-center justify-content-center">1</div>
                                <h6 class="fw-bold text-dark mb-2">Kirim Laporan Valid</h6>
                                <p class="text-muted small-13 mb-0 lh-base">Masyarakat mengunggah laporan kerusakan infrastruktur disertai bukti foto fisik asli dan titik lokasi koordinat GPS otomatis.</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="p-3-5 bg-light-panel border border-dashed rounded-4 h-100 position-relative hover-light-card transition-all">
                                <div class="badge-number bg-soft-warning text-warning-deep fw-800 mb-3 rounded-3 d-flex align-items-center justify-content-center">2</div>
                                <h6 class="fw-bold text-dark mb-2">Verifikasi Pusat (Admin)</h6>
                                <p class="text-muted small-13 mb-0 lh-base">Tim pengawas pusat memvalidasi keaslian laporan. Jika data akurat, aduan langsung diteruskan ke unit pengerjaan lapangan.</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="p-3-5 bg-light-panel border border-dashed rounded-4 h-100 position-relative hover-light-card transition-all">
                                <div class="badge-number bg-soft-success text-success-deep fw-800 mb-3 rounded-3 d-flex align-items-center justify-content-center">3</div>
                                <h6 class="fw-bold text-dark mb-2">Eksekusi Fisik URC</h6>
                                <p class="text-muted small-13 mb-0 lh-base">Unit Reaksi Cepat meluncur ke titik lokasi guna melakukan perbaikan infrastruktur fisik, kemudian mengunggah dokumentasi tuntas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    /* ==========================================================================
       CIVICFIX DASHBOARD DESIGN SYSTEM SPECIFICATIONS
       ========================================================================== */
    .fw-800 { font-weight: 800; }
    .font-medium { font-weight: 500; }
    .tracking-tight { letter-spacing: -0.5px; }
    .small-caps { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1px; }
    .small-13 { font-size: 0.85rem; }
    .p-3-5 { padding: 1.25rem; }
    .small-dot { font-size: 0.4rem; vertical-align: middle; }

    /* Custom Premium Banner Background Logic */
    .welcome-premium-banner {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 1px solid rgba(191, 219, 254, 0.4) !important;
    }
    
    /* Tombol Utama (Elemen Gelap 10% Penyeimbang Kontras) */
    .btn-premium-dark {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.88rem;
        box-shadow: 0 4px 15px rgba(30, 41, 59, 0.15);
    }
    .btn-premium-dark:hover {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #ffffff;
    }

    /* Counter Cards Model */
    .card-stat-premium {
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
        transition: transform 0.25s ease;
    }
    .card-stat-premium:hover {
        transform: translateY(-3px);
    }
    .decor-indicator-line {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }

    /* Shape Icon Configuration */
    .icon-premium-shape {
        width: 54px;
        height: 54px;
        flex-shrink: 0;
    }

    /* Soft Tone Variations */
    .bg-soft-primary { background-color: #eef2ff; color: #3b82f6; }
    .bg-soft-warning { background-color: #fff7ed; color: #f97316; }
    .bg-soft-success { background-color: #f0fdf4; color: #10b981; }
    .text-warning-deep { color: #ea580c; }
    .text-success-deep { color: #16a34a; }

    /* Infographics Box Style */
    .layout-infographic-card {
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
    }
    .bg-light-panel {
        background-color: #f8fafc;
    }
    .border-dashed {
        border: 2px dashed #e2e8f0 !important;
    }
    .badge-number {
        width: 36px;
        height: 36px;
        font-size: 1.05rem;
    }

    /* Interactive Hover Effect */
    .hover-light-card:hover {
        background-color: #ffffff !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.015);
        border-color: #cbd5e1 !important;
    }
    .hover-up-action { transition: 0.2s; }
    .hover-up-action:hover { transform: translateY(-2px); }
</style>