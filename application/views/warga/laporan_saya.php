<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container-fluid py-4 main-warga-history-container animate__animated animate__fadeIn">
    
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-5 gap-3 dynamic-header-panel">
        <div>
            <div class="badge bg-soft-primary text-primary rounded-pill px-3 py-2 fw-bold small-caps mb-2 shadow-sm">
                <i class="bi bi-clock-history me-1"></i> Tracking System
            </div>
            <h2 class="fw-800 text-dark mb-1 tracking-tight">Berkas Laporan Saya</h2>
            <p class="text-muted small mb-0 font-medium">CivicFix Gorontalo &bull; Pantau status validasi dan progres penanganan aduan Anda secara real-time</p>
        </div>
        <a href="<?= base_url('warga/kirim_laporan'); ?>" class="btn btn-premium-dark shadow-md rounded-pill px-4 py-2-5 transition-all hover-up">
            <i class="bi bi-megaphone-fill me-2 text-warning"></i> Buat Laporan Baru
        </a>
    </div>

    <div class="row g-4 layout-content-row">
        <?php if(empty($laporan_saya)): ?>
            <div class="col-12 text-center py-5 empty-table-state animate__animated animate__fadeInUp">
                <img src="https://illustrations.popsy.co/blue/searching.svg" style="width: 200px;" class="mb-3 opacity-75">
                <h5 class="text-dark fw-bold mb-1">Belum Ada Riwayat Aduan</h5>
                <p class="text-muted small mb-0">Anda belum pernah mengirimkan laporan kerusakan infrastruktur.</p>
            </div>
        <?php else: ?>
            <?php foreach($laporan_saya as $row): ?>
                <div class="col-12 animate__animated animate__fadeInUp">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white table-container-card mb-2">
                        <div class="card-body p-4">
                            <div class="row g-3 align-items-center">
                                
                                <div class="col-md-2 text-center text-md-start">
                                    <?php if(!empty($row->foto)): ?>
                                        <img src="<?= base_url('uploads/' . $row->foto); ?>" class="img-fluid rounded-3 shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-soft-secondary text-muted rounded-3 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 100px; height: 100px;">
                                            <i class="bi bi-camera-video-off fs-3"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-7">
                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                        <span class="badge bg-light text-dark rounded-pill border fw-bold x-small">ID: LPR-00<?= $row->laporan_id; ?></span>
                                        <span class="text-muted x-small font-medium"><i class="bi bi-calendar3 me-1"></i> <?= date('d M Y &bull; H:i', strtotime($row->tanggal)); ?></span>
                                    </div>
                                    <p class="mb-2 text-dark small-13 font-medium text-truncate-2"><?= $row->deskripsi; ?></p>
                                    
                                    <?php if(!empty($row->tanggapan_petugas)): ?>
                                        <div class="p-2-5 bg-soft-info text-info-deep rounded-3 x-small font-medium mt-2 border border-info border-opacity-10">
                                            <i class="bi bi-chat-left-dots-fill me-1"></i> <strong>Memo Lapangan (URC):</strong> "<?= $row->tanggapan_petugas; ?>"
                                        </div>
                                    <?php elseif(!empty($row->tanggapan_admin)): ?>
                                        <div class="p-2-5 bg-soft-primary text-primary rounded-3 x-small font-medium mt-2 border border-primary border-opacity-10">
                                            <i class="bi bi-chat-left-quote-fill me-1"></i> <strong>Tanggapan Pusat (Admin):</strong> "<?= $row->tanggapan_admin; ?>"
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-3 text-center text-md-end">
                                    <?php 
                                        $b_class = 'bg-soft-warning text-warning-deep';
                                        if($row->status == 'Sedang Dikerjakan' || $row->status == 'Terverifikasi') $b_class = 'bg-soft-info text-info-deep';
                                        elseif($row->status == 'Selesai') $b_class = 'bg-soft-success text-success-deep';
                                        elseif($row->status == 'Ditolak') $b_class = 'bg-soft-danger text-danger-deep';
                                    ?>
                                    <div class="mb-3">
                                        <span class="badge <?= $b_class; ?> rounded-pill px-3 py-2 fw-bold status-badge-premium">
                                            <i class="bi bi-circle-fill small-dot me-1"></i> <?= strtoupper($row->status); ?>
                                        </span>
                                    </div>
                                    
                                    <?php if(!empty($row->foto_bukti_petugas) && $row->status == 'Selesai'): ?>
                                        <a href="<?= base_url('uploads/bukti/' . $row->foto_bukti_petugas); ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold x-small transition-all hover-up">
                                            <i class="bi bi-images me-1"></i> Bukti Selesai HD
                                        </a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    /* ==========================================================================
       CIVICFIX CITIZEN COMPLAINT HISTORY PREMIUM LIGHT THEME
       ========================================================================== */
    
    .btn-premium-dark {
        background-color: #1e293b; color: #ffffff; border: none; font-weight: 700; font-size: 0.85rem;
    }
    .btn-premium-dark:hover { background-color: #0f172a; color: #ffffff; }
    
    .table-container-card { border: 1px solid rgba(226, 232, 240, 0.8); transition: transform 0.2s ease; }
    .table-container-card:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.02) !important; }
    
    .p-2-5 { padding: 0.65rem 1rem; }
    .small-13 { font-size: 0.88rem; line-height: 1.5; }
    .text-truncate-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

    /* Theme Palette Colors */
    .bg-soft-warning { background-color: #fff7ed; }
    .bg-soft-info    { background-color: #f0f9ff; }
    .bg-soft-success { background-color: #f0fdf4; }
    .bg-soft-danger  { background-color: #fef2f2; }
    .bg-soft-primary { background-color: #eef2ff; }
    .bg-soft-secondary { background-color: #f8fafc; }

    .text-warning-deep { color: #c2410c; }
    .text-info-deep    { color: #0369a1; }
    .text-success-deep { color: #047857; }
    .text-danger-deep  { color: #b91c1c; }

    .status-badge-premium { font-size: 0.72rem; letter-spacing: 0.5px; padding: 6px 14px !important; }
    .small-dot { font-size: 0.45rem; vertical-align: middle; margin-right: 4px; }
</style>