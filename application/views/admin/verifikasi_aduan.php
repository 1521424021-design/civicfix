<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container-fluid py-4 main-verification-container animate__animated animate__fadeIn">
    
    <div class="d-flex align-items-center justify-content-between mb-5 back-navigation-panel">
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('admin/dashboard'); ?>" class="btn btn-back-premium shadow-sm rounded-circle p-2-5 transition-all hover-up" title="Kembali ke Dashboard">
                <i class="bi bi-arrow-left fs-5 text-primary"></i>
            </a>
            <div>
                <span class="badge bg-soft-warning text-warning-deep rounded-pill px-3 py-1-5 fw-bold small-caps mb-1 shadow-sm">
                    <i class="bi bi-shield-fill-exclamation me-1"></i> Mode Peninjauan Laporan
                </span>
                <h3 class="fw-800 text-dark mb-0 tracking-tight">Verifikasi Detail Aduan #<?= $laporan->laporan_id; ?></h3>
            </div>
        </div>
        <span class="text-muted small font-medium d-none d-md-inline-block">
            <i class="bi bi-clock-history me-1"></i> Masuk: <?= date('d M Y (H:i)', strtotime($laporan->tanggal)); ?>
        </span>
    </div>

    <div class="row g-4 layout-content-row">
        
        <div class="col-xl-6 col-lg-6 col-md-12 animate__animated animate__fadeInLeft">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white-card h-100 table-container-card">
                <div class="card-header bg-white py-3 px-4 border-0 border-bottom-light">
                    <h6 class="fw-800 text-dark mb-0">
                        <i class="bi bi-image text-primary me-2"></i> Bukti Foto Lapangan (Warga)
                    </h6>
                </div>
                
                <div class="position-relative evidence-image-frame bg-light p-3 text-center">
                    <?php if(!empty($laporan->foto)): ?>
                        <img src="<?= base_url('uploads/' . $laporan->foto); ?>" class="img-fluid rounded-4 shadow-sm core-evidence-img" style="max-height: 420px; width: 100%; object-fit: cover;">
                    <?php else: ?>
                        <div class="py-5 bg-soft-secondary text-muted rounded-4">
                            <i class="bi bi-camera-video-off fs-1 d-block mb-2"></i>
                            <span class="small fw-bold">Warga tidak mengunggah foto bukti fisik.</span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-body p-4 bg-light-panel-footer border-top-light">
                    <label class="small-caps fw-bold text-muted d-block mb-2"><i class="bi bi-geo-alt-fill text-danger"></i> Titik Koordinat GPS Lokasi</label>
                    <div class="d-flex align-items-center justify-content-between bg-white p-3 rounded-3 border shadow-xsm">
                        <code class="text-primary fw-bold fs-6 gps-coordinate-string"><?= !empty($laporan->koordinat_gps) ? $laporan->koordinat_gps : '0.0000, 0.0000 (Satelit Tidak Terdeteksi)'; ?></code>
                        <a href="https://www.google.com/maps/search/?api=1&query=<?= $laporan->koordinat_gps; ?>" target="_blank" class="btn btn-sm btn-soft-primary rounded-pill px-3 fw-bold transition-all hover-up">
                            <i class="bi bi-map-fill me-1"></i> Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 animate__animated animate__fadeInRight">
            <div class="card border-0 shadow-lg rounded-4 p-4 bg-white table-container-card h-100">
                <h5 class="fw-800 text-dark mb-4 border-bottom pb-3 d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-file-earmark-person text-primary me-2"></i> Berkas Berita Acara</span>
                    <span class="badge bg-soft-primary text-primary rounded-pill x-small px-3 py-2 fw-bold">ID Transaksi: <?= $laporan->laporan_id; ?></span>
                </h5>
                
                <div class="row g-3 mb-4 identity-meta-grid">
                    <div class="col-md-6">
                        <label class="small-caps fw-bold text-muted d-block mb-1">Nama Pelapor Resmi</label>
                        <div class="d-flex align-items-center bg-soft-light-gray p-2-5 rounded-3 border-light">
                            <i class="bi bi-person-fill-check text-primary me-2 fs-5"></i>
                            <span class="fw-bold text-dark small-13"><?= $laporan->nama_warga ?? 'User Anonim'; ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="small-caps fw-bold text-muted d-block mb-1">NIK Pelapor</label>
                        <div class="d-flex align-items-center bg-soft-light-gray p-2-5 rounded-3 border-light">
                            <i class="bi bi-card-text text-secondary me-2 fs-5"></i>
                            <span class="fw-bold text-muted small-13"><?= !empty($laporan->nik) ? $laporan->nik : '12345XXXXXXXX'; ?></span>
                        </div>
                    </div>
                </div>

                <div class="mb-4 description-block-wrapper">
                    <label class="small-caps fw-bold text-muted d-block mb-1">Uraian Kronologi / Deskripsi Kerusakan</label>
                    <div class="text-muted italic-bg p-3 rounded-3 position-relative custom-quote-box">
                        <p class="mb-0 small-13 font-medium text-dark italic-text-style">
                            "<?= $laporan->deskripsi; ?>"
                        </p>
                    </div>
                </div>

                <hr class="my-4 border-light-gray">

                <form action="<?= base_url('admin/proses_verifikasi'); ?>" method="POST" class="core-decision-form">
                    <input type="hidden" name="laporan_id" value="<?= $laporan->laporan_id; ?>">
                    
                    <div class="mb-4 select-status-group">
                        <label class="form-label fw-800 text-dark small-uppercase-caps mb-2"><i class="bi bi-toggle2-off text-primary me-1"></i> Tentukan Status Keputusan</label>
                        <select name="status" class="form-select border-0 bg-light-panel-footer rounded-3 py-3 px-3 fw-bold text-primary shadow-xsm custom-premium-select">
                            <option value="Pending" <?= ($laporan->status == 'Pending') ? 'selected' : ''; ?>>🕒 Tahan di Antrean (Status: Pending)</option>
                            <option value="Terverifikasi" <?= ($laporan->status == 'Terverifikasi') ? 'selected' : ''; ?>>✅ Terima & Terverifikasi (Kirim ke Petugas)</option>
                            <option value="Ditolak" <?= ($laporan->status == 'Ditolak') ? 'selected' : ''; ?>>❌ Tolak Laporan (Data Tidak Valid)</option>
                            <option value="Selesai" <?= ($laporan->status == 'Selesai') ? 'selected' : ''; ?>>🎉 Tandai Selesai (Kasus Ditutup)</option>
                        </select>
                    </div>

                    <div class="mb-4 textarea-tanggapan-group">
                        <label class="form-label fw-800 text-dark small-uppercase-caps mb-2"><i class="bi bi-chat-left-text text-primary me-1"></i> Berikan Memo / Tanggapan Tambahan</label>
                        <textarea name="tanggapan_admin" class="form-control border-0 bg-light-panel-footer rounded-3 p-3 shadow-xsm custom-premium-textarea" rows="4" placeholder="Tuliskan catatan teknis untuk petugas lapangan, atau alasan penolakan jika laporan warga ditolak..."><?= isset($laporan->tanggapan_admin) ? $laporan->tanggapan_admin : ''; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-premium-save w-100 rounded-pill py-3 fw-800 shadow-blue text-white transition-all hover-up">
                        <i class="bi bi-cloud-arrow-up-fill me-2 text-warning"></i> Simpan & Kirim Keputusan Verifikasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* ==========================================================================
       CIVICFIX EXCLUSIVE VERIFICATION PAGE LIGHT MODE STYLING 
       ========================================================================== */
    
    /* Panel Navigasi Kembali */
    .btn-back-premium {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }
    .btn-back-premium:hover {
        background-color: #eff6ff;
        border-color: #bfdbfe;
        transform: scale(1.05);
    }

    /* Layout Components */
    .border-bottom-light { border-bottom: 1px solid #f1f5f9; }
    .border-top-light { border-top: 1px solid #f1f5f9; }
    .border-light-gray { border-color: #f1f5f9; opacity: 1; }
    .bg-light-panel-footer { background-color: #f8fafc; }
    .bg-soft-light-gray { background-color: #f8fafc; }
    .border-light { border: 1px solid #e2e8f0; }

    /* Shadow Customizing */
    .shadow-xsm { box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
    .shadow-xl { box-shadow: 0 20px 40px rgba(0,0,0,0.05); }

    /* Kutipan Deskripsi Warga */
    .custom-quote-box {
        background-color: #f0f7ff;
        border-left: 5px solid #3b82f6;
    }
    .italic-text-style {
        font-style: italic;
        line-height: 1.6;
    }

    /* Input Form Elements Elite */
    .custom-premium-select, .custom-premium-textarea {
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
        font-size: 0.9rem;
    }
    .custom-premium-select:focus, .custom-premium-textarea:focus {
        background-color: #ffffff !important;
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15) !important;
    }

    /* Big Save Button Premium */
    .btn-premium-save {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        border: none;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }
    .btn-premium-save:hover {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.3) !important;
    }

    /* Structural Tuning */
    .core-evidence-img {
        transition: transform 0.5s ease;
    }
    .core-evidence-img:hover {
        transform: scale(1.015);
    }
</style>