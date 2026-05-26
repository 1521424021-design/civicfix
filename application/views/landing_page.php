<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CivicFix - Gorontalo Smart City Portal</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root { --primary-color: #0061ff; --secondary-color: #60efff; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }

        /* Estetika Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(0, 97, 255, 0.85), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1590066394891-b174a5554944?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
        }

        .navbar { transition: all 0.3s ease; z-index: 1000; }
        .navbar-brand span { color: var(--secondary-color); }

        /* Estetika Card & Icon */
        .feature-icon {
            width: 70px; height: 70px;
            background: linear-gradient(45deg, #e7f1ff, #ffffff);
            color: var(--primary-color);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; margin: 0 auto 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .step-card:hover .feature-icon {
            transform: translateY(-10px) rotate(10deg);
            background: var(--primary-color);
            color: white;
        }

        .stat-box { border-radius: 20px; transition: 0.3s; }
        .stat-box:hover { transform: translateY(-5px); background: #f8faff; }

        .btn-primary { 
            background: var(--primary-color); 
            border: none; 
            box-shadow: 0 8px 25px rgba(0, 97, 255, 0.4); 
        }

        /* PREMIUM LIGHT MODE BERITA NEWS GRID */
        .news-report-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .news-report-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04) !important;
        }
        .news-img-wrapper {
            position: relative;
            height: 220px;
            overflow: hidden;
            background-color: #f1f5f9;
        }
        .news-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .news-report-card:hover .news-img-wrapper img {
            transform: scale(1.06);
        }
        .bg-soft-primary { background-color: #eef2ff; color: #3b82f6; }
        .bg-soft-warning { background-color: #fff7ed; color: #ea580c; }
        .bg-soft-success { background-color: #f0fdf4; color: #16a34a; }
        .bg-soft-danger { background-color: #fef2f2; color: #dc2626; }
        .fw-800 { font-weight: 800; }
        .small-caps { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1px; }
        .small-13 { font-size: 0.88rem; line-height: 1.5; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark position-absolute w-100">
        <div class="container py-3">
            <a class="navbar-brand fw-800 fs-3" href="#">Civic<span>Fix</span></a>
            <div class="d-flex gap-2">
                <a href="<?= base_url('auth') ?>" class="btn btn-link text-white text-decoration-none px-4 fw-bold">Masuk</a>
                <a href="<?= base_url('auth/register') ?>" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm">Daftar Warga</a>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 animate__animated animate__fadeInLeft">
                    <span class="badge bg-info mb-3 px-3 py-2 rounded-pill text-uppercase fw-bold" style="letter-spacing: 1px;">E-Gov Gorontalo Digital</span>
                    <h1 class="display-2 fw-800 mb-4" style="line-height: 1.1;">Wujudkan Kota <br><span class="text-info">Lebih Nyaman.</span></h1>
                    <p class="lead mb-5 opacity-75 fs-4">Laporkan kerusakan infrastruktur di sekitarmu dengan satu klik. Pantau perbaikannya secara transparan dan real-time.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?= base_url('auth/register') ?>" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold">
                            <i class="bi bi-megaphone me-2"></i> Mulai Melapor
                        </a>
                        <a href="#cara-kerja" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-bold">
                            Pelajari Alur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white border-bottom">
        <div class="container text-center py-4">
            <div class="row g-4">
                <div class="col-md-4 px-4">
                    <div class="p-4 stat-box">
                        <h2 class="display-5 fw-bold text-primary mb-1"><?= $this->db->count_all('laporan') ?>+</h2>
                        <p class="text-muted fw-bold text-uppercase small">Aduan Masuk</p>
                    </div>
                </div>
                <div class="col-md-4 px-4 border-start border-end">
                    <div class="p-4 stat-box">
                        <h2 class="display-5 fw-bold text-success mb-1">98%</h2>
                        <p class="text-muted fw-bold text-uppercase small">Respons Cepat</p>
                    </div>
                </div>
                <div class="col-md-4 px-4">
                    <div class="p-4 stat-box">
                        <h2 class="display-5 fw-bold text-info mb-1">24/7</h2>
                        <p class="text-muted fw-bold text-uppercase small">Layanan Online</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light border-bottom">
        <div class="container py-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
                <div>
                    <h6 class="text-primary fw-bold text-uppercase mb-2 small-caps" style="letter-spacing: 2px;"><i class="bi bi-broadcast text-danger animate__animated animate__pulse animate__infinite d-inline-block me-1"></i> Live Aktivitas</h6>
                    <h2 class="fw-800 text-dark tracking-tight mb-0">Pemantauan Infrastruktur Terkini</h2>
                </div>
                <p class="text-muted font-medium mb-0 mt-2 mt-md-0">Arus transparansi berkas penanganan satgas fisik lapangan</p>
            </div>

            <div class="row g-4">
                <?php 
                    $this->db->select('laporan.*, users.nama as nama_warga');
                    $this->db->from('laporan');
                    $this->db->join('users', 'users.user_id = laporan.user_id', 'left');
                    $this->db->order_by('laporan.tanggal', 'DESC');
                    $this->db->limit(3);
                    $laporan_terkini = $this->db->get()->result();

                    if(!empty($laporan_terkini)):
                        foreach($laporan_terkini as $row):
                            
                            $badge_class = "bg-soft-primary";
                            if($row->status == 'Pending') $badge_class = "bg-soft-warning";
                            if($row->status == 'Ditolak') $badge_class = "bg-soft-danger";
                            if($row->status == 'Selesai') $badge_class = "bg-soft-success";

                            // FIX SQA INTEGRITY: Fallback deteksi nama kolom database agar anti-error
                            $string_judul = isset($row->judul) ? $row->judul : (isset($row->tipe_kerusakan) ? $row->tipe_kerusakan : (isset($row->judul_laporan) ? $row->judul_laporan : 'Laporan Infrastruktur Warga'));
                            $string_lat   = isset($row->latitude) ? $row->latitude : (isset($row->lat) ? $row->lat : '0.0');
                            $string_lng   = isset($row->longitude) ? $row->longitude : (isset($row->lng) ? $row->lng : '0.0');
                            $string_warga = !empty($row->nama_warga) ? $row->nama_warga : 'Warga Gorontalo';
                ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card news-report-card border-0 shadow-sm h-100">
                        <div class="news-img-wrapper">
                            <?php if(!empty($row->foto) && file_exists(FCPATH . 'uploads/' . $row->foto)): ?>
                                <img src="<?= base_url('uploads/' . $row->foto) ?>" alt="Dokumentasi Kerusakan">
                            <?php else: ?>
                                <img src="https://images.unsplash.com/photo-1515162305285-0293e4767cc2?auto=format&fit=crop&w=600&q=80" alt="Default Failover Image">
                            <?php endif; ?>
                            <span class="badge <?= $badge_class ?> rounded-pill px-3 py-2 position-absolute top-0 end-0 m-3 fw-bold small-caps shadow-sm">
                                <?= $row->status ?>
                            </span>
                        </div>
                        
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2 text-muted x-small font-medium">
                                    <span><i class="bi bi-calendar3 me-1"></i> <?= date('d M Y', strtotime($row->tanggal)) ?></span>
                                    <span><i class="bi bi-person-circle me-1"></i> Pelapor: <?= (strlen($string_warga) > 12) ? substr($string_warga, 0, 12) . '...' : $string_warga; ?></span>
                                </div>
                                <h5 class="fw-bold text-dark mb-2 tracking-tight"><?= (strlen($string_judul) > 45) ? substr($string_judul, 0, 45) . '...' : $string_judul; ?></h5>
                                <p class="text-muted small-13 mb-4"><?= (strlen($row->deskripsi) > 100) ? substr($row->deskripsi, 0, 100) . '...' : $row->deskripsi; ?></p>
                            </div>
                            
                            <div class="p-2 bg-light rounded-3 d-flex align-items-center text-secondary x-small font-medium">
                                <i class="bi bi-geo-alt-fill text-danger me-2 fs-6"></i>
                                <span class="text-truncate">Koordinat: <?= $string_lat ?>, <?= $string_lng ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                        endforeach;
                    else: 
                ?>
                <div class="col-12 text-center py-5">
                    <div class="text-muted py-4">
                        <i class="bi bi-chat-left-dots display-3 opacity-20 d-block mb-3"></i>
                        <p class="font-medium">Belum ada aktivitas penyiaran laporan infrastruktur saat ini.</p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="cara-kerja" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase mb-2" style="letter-spacing: 2px;">Metodologi</h6>
                <h2 class="fw-bold display-6">Cara Kerja CivicFix</h2>
            </div>
            <div class="row g-5 text-center">
                <div class="col-md-4 step-card">
                    <div class="feature-icon"><i class="bi bi-camera-fill"></i></div>
                    <h5 class="fw-bold">1. Foto & Deskripsi</h5>
                    <p class="text-muted px-lg-4">Ambil foto kerusakan jalan atau fasilitas umum yang bermasalah secara mendetail.</p>
                </div>
                <div class="col-md-4 step-card">
                    <div class="feature-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <h5 class="fw-bold">2. Penandaan Lokasi</h5>
                    <p class="text-muted px-lg-4">Gunakan GPS otomatis untuk menandai titik lokasi kerusakan secara akurat di peta.</p>
                </div>
                <div class="col-md-4 step-card">
                    <div class="feature-icon"><i class="bi bi-send-check-fill"></i></div>
                    <h5 class="fw-bold">3. Pantau Progres</h5>
                    <p class="text-muted px-lg-4">Dapatkan notifikasi saat petugas memverifikasi dan memperbaiki laporan Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-5">
        <div class="container text-center">
            <h4 class="fw-bold mb-4">Civic<span class="text-info">Fix</span></h4>
            <p class="opacity-50 small mb-4">Sistem Informasi Pengaduan Infrastruktur Digital Gorontalo</p>
            <div class="d-flex justify-content-center gap-4 mb-4 fs-5">
                <i class="bi bi-facebook"></i><i class="bi bi-instagram"></i><i class="bi bi-twitter-x"></i>
            </div>
            <hr class="opacity-10 mb-4">
            <p class="mb-0 small opacity-50">&copy; 2026 CivicFix TRPL, Vokasi, UNG. Crafted with <i class="bi bi-heart-fill text-danger"></i> for Gorontalo.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>