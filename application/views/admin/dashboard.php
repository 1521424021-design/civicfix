<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<div class="container-fluid py-4 main-dashboard-container animate__animated animate__fadeIn">
    
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-lg rounded-4 mb-4 dashboard-alert animate__animated animate__slideInDown">
            <div class="d-flex align-items-center">
                <div class="alert-icon-box bg-success text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                </div>
                <div>
                    <strong class="d-block text-dark small-uppercase-caps">Sistem Sukses</strong>
                    <span class="text-muted small-13"><?= $this->session->flashdata('success'); ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger border-0 shadow-lg rounded-4 mb-4 dashboard-alert animate__animated animate__shakeX">
            <div class="d-flex align-items-center">
                <div class="alert-icon-box bg-danger text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                </div>
                <div>
                    <strong class="d-block text-dark small-uppercase-caps">Sistem Proteksi</strong>
                    <span class="text-muted small-13"><?= $this->session->flashdata('error'); ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-5 gap-3 dynamic-header-panel">
        <div>
            <div class="badge bg-soft-primary text-primary rounded-pill px-3 py-2 fw-bold small-caps mb-2 shadow-sm">
                <i class="bi bi-cpu me-1"></i> Core Control Room V.2.0
            </div>
            <h2 class="fw-800 text-dark mb-1 tracking-tight">Dashboard Monitoring</h2>
            <p class="text-muted small mb-0 font-medium">Sistem Informasi CivicFix Gorontalo &bull; Ruang Kendali Infrastruktur Kota</p>
        </div>
        <div class="d-flex align-items-center gap-3 action-header-group">
            <a href="<?= base_url('admin/cetak'); ?>" target="_blank" class="btn btn-premium-dark shadow-md rounded-pill px-4 py-2-5 transition-all hover-up">
                <i class="bi bi-printer-fill me-2 text-warning"></i> Rekap Laporan Fisik
            </a>
            <button onclick="window.location.reload()" class="btn btn-premium-white shadow-sm rounded-circle border p-2-5 transition-all hover-rotate" title="Segarkan Data">
                <i class="bi bi-arrow-clockwise fs-5 text-primary"></i>
            </button>
        </div>
    </div>

    <div class="row g-4 mb-5 card-stats-row">
        <?php
            $total = count($semua_laporan);
            $pending = 0; $selesai = 0;
            foreach($semua_laporan as $l) {
                if($l->status == 'Pending') $pending++;
                if($l->status == 'Selesai') $selesai++;
            }
            $warga = $this->db->count_all('users');
        ?>
        
        <div class="col-xl-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="card card-stat-premium border-0 shadow-sm rounded-4 overflow-hidden bg-white-card">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted-caps small fw-bold text-uppercase mb-2">Total Masukan Aduan</p>
                            <h1 class="fw-800 text-dark mb-0 tracking-tight"><?= number_format($total); ?></h1>
                        </div>
                        <div class="icon-shape-wrapper bg-gradient-blue text-white rounded-4 p-3 shadow-blue">
                            <i class="bi bi-megaphone-fill fs-3"></i>
                        </div>
                    </div>
                    <div class="card-decor-line bg-primary"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="card card-stat-premium border-0 shadow-sm rounded-4 overflow-hidden bg-white-card">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted-caps small fw-bold text-uppercase mb-2">Butuh Verifikasi Tim</p>
                            <h1 class="fw-800 text-dark mb-0 tracking-tight"><?= number_format($pending); ?></h1>
                        </div>
                        <div class="icon-shape-wrapper bg-gradient-orange text-white rounded-4 p-3 shadow-orange">
                            <i class="bi bi-shield-lock-fill fs-3"></i>
                        </div>
                    </div>
                    <div class="card-decor-line bg-warning"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <div class="card card-stat-premium border-0 shadow-sm rounded-4 overflow-hidden bg-white-card">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted-caps small fw-bold text-uppercase mb-2">Tuntas Dikerjakan</p>
                            <h1 class="fw-800 text-dark mb-0 tracking-tight"><?= number_format($selesai); ?></h1>
                        </div>
                        <div class="icon-shape-wrapper bg-gradient-green text-white rounded-4 p-3 shadow-green">
                            <i class="bi bi-check-all fs-3"></i>
                        </div>
                    </div>
                    <div class="card-decor-line bg-success"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
            <div class="card card-stat-premium border-0 shadow-sm rounded-4 overflow-hidden bg-white-card">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted-caps small fw-bold text-uppercase mb-2">Warga Terdaftar</p>
                            <h1 class="fw-800 text-dark mb-0 tracking-tight"><?= number_format($warga); ?></h1>
                        </div>
                        <div class="icon-shape-wrapper bg-gradient-dark text-white rounded-4 p-3 shadow-dark">
                            <i class="bi bi-people-fill fs-3"></i>
                        </div>
                    </div>
                    <div class="card-decor-line bg-dark"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-lg rounded-4 mb-5 bg-white overflow-hidden animate__animated animate__fadeIn">
        <div class="card-header bg-white py-3 px-4 border-0 border-bottom d-flex align-items-center">
            <i class="bi bi-map-fill text-primary me-2 fs-5"></i> 
            <span class="fw-800 text-dark">Peta Sebaran Laporan Kerusakan Infrastruktur (Gorontalo SIG)</span>
        </div>
        <div class="card-body p-0">
            <div id="mapCivicFix" style="height: 420px; width: 100%;"></div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-pill mb-5 bg-glass-navigation overflow-hidden animate__animated animate__fadeIn">
        <div class="card-body px-4 py-2">
            <div class="d-flex align-items-center gap-2 overflow-auto scroll-hide custom-pill-container">
                <span class="fw-bold text-muted small me-3 text-nowrap"><i class="bi bi-funnel-fill text-primary"></i> Filter Status:</span>
                <a href="<?= base_url('admin/dashboard'); ?>" class="btn-pill-filter <?= (empty($status_aktif)) ? 'active' : ''; ?>">Semua Laporan</a>
                <a href="<?= base_url('admin/dashboard/Pending'); ?>" class="btn-pill-filter <?= ($status_aktif == 'Pending') ? 'active' : ''; ?>">Antrean Pending</a>
                <a href="<?= base_url('admin/dashboard/Terverifikasi'); ?>" class="btn-pill-filter <?= ($status_aktif == 'Terverifikasi') ? 'active' : ''; ?>">Terverifikasi</a>
                <a href="<?= base_url('admin/dashboard/Selesai'); ?>" class="btn-pill-filter <?= ($status_aktif == 'Selesai') ? 'active' : ''; ?>">Selesai Tuntas</a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-lg rounded-4 bg-white table-container-card animate__animated animate__fadeInUp">
        <div class="card-header bg-white py-4 px-4 border-0 d-flex justify-content-between align-items-center table-card-header">
            <div>
                <h5 class="fw-800 text-dark mb-0 d-flex align-items-center">
                    <i class="bi bi-list-stars text-primary me-2 fs-4"></i> Antrean Validasi Aduan Masuk
                </h5>
                <p class="text-muted small mb-0">Klik tombol tindakan untuk memproses data secara real-time</p>
            </div>
            <span class="badge bg-light text-dark rounded-pill px-3 py-2 border fw-bold"><?= count($semua_laporan); ?> Data Dimuat</span>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 custom-premium-table">
                    <thead class="bg-light-table text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="ps-4 py-3 border-0">Profil Pelapor</th>
                            <th class="py-3 border-0">Isi Aduan & Kerusakan</th>
                            <th class="py-3 border-0 text-center">Tanggal Masuk</th>
                            <th class="py-3 border-0 text-center">Status Alur</th>
                            <th class="py-3 border-0 text-end pe-4">Aksi Kontrol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($semua_laporan)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 empty-table-state">
                                    <img src="https://illustrations.popsy.co/blue/no-data-found.svg" style="width: 200px;" class="mb-3 opacity-75">
                                    <h6 class="text-dark fw-bold mb-1">Data Kosong</h6>
                                    <p class="text-muted small mb-0">Belum ada aduan warga untuk kategori status ini.</p>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach($semua_laporan as $row): ?>
                        <tr class="item-row transition-all shadow-hover">
                            <td class="ps-4 py-3-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-box bg-soft-primary text-primary rounded-3 me-3 shadow-sm">
                                        <?= substr($row->nama_warga ?? '?', 0, 1); ?>
                                    </div>
                                    <div>
                                        <div class="fw-800 text-dark small-13 mb-0"><?= $row->nama_warga ?? 'User Anonim'; ?></div>
                                        <small class="text-muted x-small d-block mt-0-5"><i class="bi bi-hash"></i> LPR-00<?= $row->laporan_id; ?></small>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="py-3-5 data-deskripsi-col">
                                <p class="mb-1 text-dark small-13 text-truncate-2 font-medium"><?= character_limiter($row->deskripsi, 75); ?></p>
                                <a href="<?= base_url('admin/verifikasi_aduan/'.$row->laporan_id); ?>" class="text-decoration-none x-small text-primary fw-bold hover-link">
                                    <i class="bi bi-images me-1"></i> Buka Dokumentasi Lapangan &rarr;
                                </a>
                            </td>
                            
                            <td class="text-center py-3-5">
                                <div class="text-dark fw-bold small-13 mb-0"><?= date('d F', strtotime($row->tanggal)); ?></div>
                                <small class="text-muted x-small d-block mt-0-5"><?= date('Y &bull; H:i', strtotime($row->tanggal)); ?></small>
                            </td>
                            
                            <td class="text-center py-3-5">
                                <?php 
                                    $b_class = 'bg-soft-secondary text-secondary';
                                    if($row->status == 'Pending') $b_class = 'bg-soft-warning text-warning-deep';
                                    elseif($row->status == 'Terverifikasi' || $row->status == 'Sedang Dikerjakan') $b_class = 'bg-soft-info text-info-deep';
                                    elseif($row->status == 'Selesai') $b_class = 'bg-soft-success text-success-deep';
                                    elseif($row->status == 'Ditolak') $b_class = 'bg-soft-danger text-danger-deep';
                                ?>
                                <span class="badge <?= $b_class; ?> rounded-pill px-3 py-2 fw-bold status-badge-premium">
                                    <i class="bi bi-circle-fill small-dot me-1"></i> <?= strtoupper($row->status); ?>
                                </span>
                            </td>

                            <td class="text-end pe-4 py-3-5">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-action-trigger dropdown-toggle rounded-pill px-3 fw-bold shadow-sm" data-bs-toggle="dropdown" aria-expanded="false">
                                        Kelola Laporan
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-xl border-0 rounded-4 p-2 animate__animated animate__fadeIn animate__faster">
                                        <li>
                                            <a class="dropdown-item py-2-5 rounded-3 fw-bold text-primary mb-1" href="<?= base_url('admin/verifikasi_aduan/'.$row->laporan_id); ?>">
                                                <i class="bi bi-shield-check me-2 fs-5"></i> Buka Halaman Verifikasi
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 rounded-3 fw-bold text-success mb-1" href="<?= base_url('admin/verifikasi/'.$row->laporan_id.'/Terverifikasi'); ?>">
                                                <i class="bi bi-check-circle me-2"></i> Terima & Verifikasi Cepat
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 rounded-3 fw-bold text-danger mb-1" href="<?= base_url('admin/verifikasi/'.$row->laporan_id.'/Ditolak'); ?>" onclick="return confirm('Yakin ingin menolak laporan ini?')">
                                                <i class="bi bi-x-circle me-2"></i> Tolak Laporan
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider my-2"></li>
                                        <li>
                                            <a class="dropdown-item py-2 rounded-3 fw-bold text-muted" href="<?= base_url('admin/hapus_laporan/'.$row->laporan_id); ?>" onclick="return confirm('Tindakan SQA: Hapus permanen data ini?')">
                                                <i class="bi bi-trash3-fill me-2 text-secondary"></i> Hapus Permanen
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Koordinat Tengah Default (Pusat Kota Gorontalo / Kampus UNG)
    var defaultLat = -0.5436;
    var defaultLng = 123.0617;
    
    // 2. Inisialisasi Peta Utama
    var map = L.map('mapCivicFix').setView([defaultLat, defaultLng], 13);

    // 3. Muat Layer OpenStreetMap Standar SIG
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap | CivicFix TRPL Vokasi UNG'
    }).addTo(map);

    // 4. Grouping Marker untuk Auto-Fit Tampilan Batas Peta
    var markerGroup = new L.featureGroup();

    <?php 
        // Melakukan looping data PHP langsung ke baris koding JavaScript
        if(!empty($semua_laporan)):
            foreach($semua_laporan as $item):
                // Pengaman Kolom: Deteksi fallback nama kolom koordinat database laptopmu
                $lat_val = $item->latitude ?? $item->lat ?? 0;
                $lng_val = $item->longitude ?? $item->lng ?? 0;
                $judul_val = !empty($item->deskripsi) ? character_limiter($item->deskripsi, 30) : 'Laporan Infrastruktur';
                $status_val = $item->status ?? 'Pending';
                
                // Hanya buat penanda jika koordinat di database valid (bukan 0)
                if($lat_val != 0 && $lng_val != 0):
    ?>
                    // Suntik Marker via Loop JS
                    var marker = L.marker([<?= $lat_val ?>, <?= $lng_val ?>]);
                    
                    // Balon Pop-Up Interaktif detail aduan
                    var popupContent = `
                        <div style="font-family: 'Plus Jakarta Sans', sans-serif; min-width: 160px; padding: 3px;">
                            <strong style="color: #1e293b; display: block; margin-bottom: 2px;">ID: LPR-00<?= $item->laporan_id ?></strong>
                            <p style="font-size: 12px; color: #475569; margin: 0 0 6px 0; font-weight: 500;"><?= addslashes($judul_val) ?></p>
                            <span style="font-size: 10px; font-weight: bold; padding: 2px 8px; border-radius: 20px; background-color: #eff6ff; color: #1d4ed8;">
                                <?= strtoupper($status_val) ?>
                            </span>
                        </div>
                    `;
                    marker.bindPopup(popupContent);
                    markerGroup.addLayer(marker);
    <?php 
                endif;
            endforeach;
        endif;
    ?>

    // 5. Masukkan semua Pin Marker ke dalam Peta
    map.addLayer(markerGroup);

    // 6. SQA Auto Zoom Layer: Jika ada pin, peta otomatis melakukan zoom terpusat mengepung pin tersebut
    if (markerGroup.getLayers().length > 0) {
        map.fitBounds(markerGroup.getBounds(), { padding: [40, 40] });
    }
});
</script>

<style>
    /* ==========================================================================
       CIVICFIX EXCLUSIVE PREMIUM LIGHT MODE STYLING 
       ========================================================================== */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    
    body { 
        background-color: #f6f9fc !important; 
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        color: #334155;
    }

    .fw-800 { font-weight: 800; }
    .font-medium { font-weight: 500; }
    .tracking-tight { letter-spacing: -0.5px; }
    .small-caps { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; }
    .small-uppercase-caps { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .small-13 { font-size: 0.85rem; }
    .x-small { font-size: 0.75rem; }
    .mt-0-5 { margin-top: 2px; }
    .transition-all { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

    .btn-premium-dark {
        background-color: #1e293b;
        color: #ffffff;
        border: none;
        font-weight: 700;
        font-size: 0.85rem;
    }
    .btn-premium-dark:hover {
        background-color: #0f172a;
        color: #ffffff;
    }
    .btn-premium-white {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        font-weight: 700;
    }
    .btn-premium-white:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
    }

    .card-stat-premium {
        background: #ffffff !important;
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
        transition: all 0.3s ease;
    }
    .card-stat-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.04) !important;
    }
    .card-decor-line {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }

    .bg-gradient-blue   { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); }
    .bg-gradient-orange { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
    .bg-gradient-green  { background: linear-gradient(135deg, #10b981 0%, #047857 100%); }
    .bg-gradient-dark   { background: linear-gradient(135deg, #475569 0%, #1e293b 100%); }

    .shadow-blue   { box-shadow: 0 8px 20px rgba(59, 130, 246, 0.25); }
    .shadow-orange { box-shadow: 0 8px 20px rgba(249, 115, 22, 0.25); }
    .shadow-green  { box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25); }
    .shadow-dark   { box-shadow: 0 8px 20px rgba(71, 85, 105, 0.25); }

    .bg-soft-primary { background-color: #eff6ff; }
    .bg-soft-warning { background-color: #fff7ed; }
    .bg-soft-info    { background-color: #f0f9ff; }
    .bg-soft-success { background-color: #f0fdf4; }
    .bg-soft-danger  { background-color: #fef2f2; }
    .bg-soft-secondary { background-color: #f1f5f9; }
    .bg-light-table { background-color: #f8fafc; }

    .text-warning-deep { color: #c2410c; }
    .text-info-deep    { color: #0369a1; }
    .text-success-deep { color: #047857; }
    .text-danger-deep  { color: #b91c1c; }

    .bg-glass-navigation {
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5) !important;
    }
    .btn-pill-filter {
        padding: 8px 24px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #475569;
        text-decoration: none;
        border-radius: 50px;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .btn-pill-filter:hover {
        background-color: #e2e8f0;
        color: #0f172a;
    }
    .btn-pill-filter.active {
        background-color: #3b82f6 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .table-container-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    .custom-premium-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
    }
    .item-row:last-child {
        border-bottom: none !important;
    }
    .item-row:hover {
        background-color: #f8fafc !important;
    }

    .avatar-box {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.1rem;
        border-radius: 12px;
    }

    .status-badge-premium {
        font-size: 0.7rem;
        letter-spacing: 0.5px;
        padding: 6px 14px !important;
    }
    .small-dot {
        font-size: 0.45rem;
        vertical-align: middle;
        margin-right: 4px;
    }

    .btn-action-trigger {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        color: #475569;
        font-size: 0.8rem;
        transition: all 0.2s ease;
    }
    .btn-action-trigger:hover, .btn-action-trigger:focus {
        background-color: #3b82f6;
        color: #ffffff;
        border-color: #3b82f6;
    }

    .dropdown-item {
        font-size: 0.85rem;
        transition: all 0.15s ease;
    }
    .dropdown-item:hover {
        background-color: #f1f5f9;
    }

    .hover-up:hover { transform: translateY(-3px); }
    .hover-rotate:hover i { transform: rotate(180deg); transition: transform 0.4s ease; }
    .hover-link:hover { text-decoration: underline !important; color: #1d4ed8 !important; }
    .scroll-hide::-webkit-scrollbar { display: none; }
</style>