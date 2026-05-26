<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="<?= base_url('warga/dashboard'); ?>" class="btn btn-white border shadow-sm rounded-pill px-4 py-2 text-dark fw-bold">
            <i class="bi bi-arrow-left me-2 text-primary"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                <div class="row g-0">
                    <div class="col-md-5 position-relative bg-dark d-flex align-items-center">
                        <img src="<?= base_url('uploads/'.$laporan->foto); ?>" class="img-fluid w-100" style="max-height: 600px; object-fit: contain;" alt="Bukti Kerusakan">
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-dark bg-opacity-75 backdrop-blur rounded-pill px-3 py-2 border border-white border-opacity-25">
                                FOTO LAPORAN (BEFORE)
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-md-7">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h2 class="fw-800 text-dark mb-1">Detail Laporan #<?= $laporan->laporan_id; ?></h2>
                                    <span class="badge bg-soft-primary text-primary rounded-pill px-3 py-2 fw-bold">
                                        <i class="bi bi-calendar-check me-1"></i> Diajukan: <?= date('d F Y', strtotime($laporan->tanggal)); ?>
                                    </span>
                                </div>
                                <?php 
                                    $b_class = 'bg-soft-warning text-warning';
                                    if($laporan->status == 'Selesai') $b_class = 'bg-soft-success text-success';
                                    if($laporan->status == 'Sedang Dikerjakan' || $laporan->status == 'Terverifikasi') $b_class = 'bg-soft-info text-info';
                                    if($laporan->status == 'Ditolak') $b_class = 'bg-soft-danger text-danger';
                                ?>
                                <div class="badge <?= $b_class; ?> fs-6 px-4 py-2 rounded-pill shadow-sm fw-800">
                                    <i class="bi bi-circle-fill me-1 small"></i> <?= strtoupper($laporan->status); ?>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold text-dark text-uppercase small letter-spacing-1 mb-2">Deskripsi Masalah:</h6>
                                <p class="text-muted bg-light p-4 rounded-4 border-start border-primary border-4 italic-style">
                                    "<?= $laporan->deskripsi; ?>"
                                </p>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-6">
                                    <h6 class="fw-bold text-dark text-uppercase small letter-spacing-1 mb-2">Titik Lokasi:</h6>
                                    <a href="https://www.google.com/maps?q=<?= $laporan->koordinat_gps; ?>" target="_blank" class="btn btn-sm btn-soft-danger rounded-pill px-3 fw-bold">
                                        <i class="bi bi-geo-alt-fill me-1"></i> Buka Google Maps
                                    </a>
                                </div>
                                <div class="col-6">
                                    <h6 class="fw-bold text-dark text-uppercase small letter-spacing-1 mb-2">Instansi Terkait:</h6>
                                    <span class="fw-bold text-dark"><i class="bi bi-building me-1 text-primary"></i> Dinas PUPR Gorontalo</span>
                                </div>
                            </div>

                            <hr class="my-4 opacity-10">

                            <h6 class="fw-800 mb-4 text-dark"><i class="bi bi-activity me-2 text-primary"></i>PROGRES PENANGANAN</h6>
                            <div class="modern-timeline">
                                <div class="t-step active">
                                    <div class="t-icon bg-success text-white"><i class="bi bi-check-lg"></i></div>
                                    <div class="t-content">
                                        <div class="fw-bold text-dark">Laporan Diterima</div>
                                        <small class="text-muted"><?= date('d M Y, H:i', strtotime($laporan->tanggal)); ?> WITA</small>
                                    </div>
                                </div>
                                <div class="t-step <?= ($laporan->status != 'Pending') ? 'active' : ''; ?>">
                                    <div class="t-icon <?= ($laporan->status != 'Pending') ? 'bg-primary text-white' : 'bg-light text-muted'; ?>">
                                        <i class="bi <?= ($laporan->status != 'Pending') ? 'bi-shield-check' : 'bi-hourglass'; ?>"></i>
                                    </div>
                                    <div class="t-content">
                                        <div class="fw-bold <?= ($laporan->status != 'Pending') ? 'text-dark' : 'text-muted'; ?>">Verifikasi Admin</div>
                                        <small class="text-muted"><?= ($laporan->status != 'Pending') ? 'Telah Disetujui' : 'Menunggu antrean'; ?></small>
                                    </div>
                                </div>
                                <div class="t-step <?= ($laporan->status == 'Selesai') ? 'active' : ''; ?>">
                                    <div class="t-icon <?= ($laporan->status == 'Selesai') ? 'bg-success text-white' : 'bg-light text-muted'; ?>">
                                        <i class="bi bi-flag-fill"></i>
                                    </div>
                                    <div class="t-content">
                                        <div class="fw-bold <?= ($laporan->status == 'Selesai') ? 'text-dark' : 'text-muted'; ?>">Perbaikan Selesai</div>
                                        <small class="text-muted"><?= ($laporan->status == 'Selesai') ? 'Pekerjaan tuntas di lapangan' : 'Masih dalam proses'; ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(!empty($laporan->foto_bukti_petugas)): ?>
    <div class="row mt-5 justify-content-center animate__animated animate__fadeInUp">
        <div class="col-lg-11">
            <h5 class="fw-800 text-dark mb-4 text-center">DOKUMENTASI PENYELESAIAN</h5>
            <div class="row g-4">
                <div class="col-md-6 text-center">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <img src="<?= base_url('uploads/'.$laporan->foto); ?>" class="img-fluid" style="height: 300px; object-fit: cover;">
                        <div class="card-body bg-light py-2">
                            <span class="fw-bold text-muted small text-uppercase">Foto Laporan Awal</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden border-top border-success border-5">
                        <img src="<?= base_url('uploads/bukti/'.$laporan->foto_bukti_petugas); ?>" class="img-fluid" style="height: 300px; object-fit: cover;">
                        <div class="card-body bg-success-subtle py-2">
                            <span class="fw-bold text-success small text-uppercase">Hasil Perbaikan Petugas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($laporan->tanggapan_petugas)): ?>
    <div class="row justify-content-center mt-5">
        <div class="col-lg-11">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4 border-start border-primary border-5">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-chat-quote-fill fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-800 mb-0">Tanggapan Unit Reaksi Cepat</h6>
                        <small class="text-muted">Pesan resmi dari tim lapangan</small>
                    </div>
                </div>
                <p class="text-dark fs-5 italic-style ps-2" style="border-left: 2px solid #eee;">
                    "<?= $laporan->tanggapan_petugas; ?>"
                </p>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
    /* HD DETAILING CSS */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
    
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7fe; }
    .fw-800 { font-weight: 800; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .backdrop-blur { backdrop-filter: blur(10px); }
    .italic-style { font-style: italic; }
    
    /* Modern Timeline Style */
    .modern-timeline { position: relative; padding-left: 45px; }
    .modern-timeline::before {
        content: ""; position: absolute; left: 19px; top: 0; bottom: 0;
        width: 3px; background: #eef2f7;
    }
    .t-step { position: relative; margin-bottom: 30px; }
    .t-icon {
        position: absolute; left: -38px; top: 0;
        width: 30px; height: 30px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        z-index: 2; font-size: 0.8rem;
        box-shadow: 0 0 0 5px white;
    }
    .t-step.active .fw-bold { color: #000; }
    
    /* Soft Colors */
    .bg-soft-primary { background-color: #e7f1ff; color: #0d6efd; }
    .bg-soft-success { background-color: #e8f5e9; color: #2e7d32; }
    .bg-soft-info { background-color: #e0f7fa; color: #00acc1; }
    .bg-soft-warning { background-color: #fff8e1; color: #f9a825; }
    .bg-soft-danger { background-color: #ffebee; color: #c62828; }
    .btn-soft-danger { background-color: #fff1f0; color: #ff4d4f; border: none; }
    .btn-soft-danger:hover { background-color: #ff4d4f; color: #fff; }

    .btn-white { background-color: #fff; transition: 0.3s; }
    .btn-white:hover { background-color: #f8f9fa; transform: translateY(-2px); }
</style>