<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Login - CivicFix'; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        /* ==========================================================================
           CIVICFIX CORE DESIGN SYSTEM: FIXED STATIC LAYOUT
           ========================================================================== */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f7ff 0%, #f6f9fc 50%, #e0f2fe 100%) !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        /* Container flex murni untuk memastikan posisi selalu pas di tengah layar monitor */
        .auth-flex-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Memaksa lebar kotak login tetap proporsional dan tidak menyusut gepeng */
        .login-box-card {
            width: 100%;
            max-width: 420px; 
            background: #ffffff !important;
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.03) !important;
            padding: 40px 35px;
            box-sizing: border-box;
        }

        .brand-gradient-text {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0061ff 0%, #60efff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -1px;
            margin-bottom: 5px;
        }

        /* Form Controls SQA Standards */
        .form-floating-group {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .custom-login-input {
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            padding: 14px 16px 14px 48px !important;
            font-size: 0.95rem;
            font-weight: 600;
            color: #1e293b !important;
            border-radius: 12px;
            width: 100%;
            box-sizing: border-box;
            outline: none;
            transition: all 0.2s ease;
        }

        .custom-login-input:focus {
            background-color: #ffffff !important;
            border-color: #0061ff !important;
            box-shadow: 0 0 0 4px rgba(0, 97, 255, 0.12) !important;
        }

        /* Ikon di dalam Input */
        .input-group-icon-box {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            color: #94a3b8;
            font-size: 1.1rem;
        }

        .form-floating-group:focus-within .input-group-icon-box {
            color: #0061ff;
        }

        /* Tombol Utama Premium (Aksen Gelap 10%) */
        .btn-premium-login {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            border: none;
            padding: 14px;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            color: #ffffff;
            font-weight: 800;
            width: 100%;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(30, 41, 59, 0.1);
        }

        .btn-premium-login:hover {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.2) !important;
            transform: translateY(-1px);
        }

        /* Alert System Box */
        .alert-soft {
            font-size: 0.85rem;
            border-radius: 12px;
            padding: 12px 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }
        .bg-soft-danger { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fee2e2; }
        .bg-soft-success { background-color: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7; }

        .fw-800 { font-weight: 800; }
        .small-caps { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; }
    </style>
</head>
<body>

<div class="auth-flex-container">
    
    <div class="login-box-card animate__animated animate__zoomIn">
        
        <div class="text-center mb-4">
            <h1 class="brand-gradient-text">CivicFix</h1>
            <div class="text-muted small-caps">Gorontalo Smart City</div>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert-soft bg-soft-danger animate__animated animate__shakeX">
                <i class="bi bi-exclamation-circle-fill me-2 fs-5"></i>
                <span class="fw-bold"><?= $this->session->flashdata('error'); ?></span>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert-soft bg-soft-success animate__animated animate__slideInDown">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <span class="fw-bold"><?= $this->session->flashdata('success'); ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/proses_login'); ?>" method="POST">
            
            <div class="form-floating-group">
                <i class="bi bi-envelope-at-fill input-group-icon-box"></i>
                <input type="email" name="email" class="custom-login-input" placeholder="Masukkan email Anda..." required autocomplete="off">
            </div>

            <div class="form-floating-group" style="margin-bottom: 30px;">
                <i class="bi bi-lock-fill input-group-icon-box"></i>
                <input type="password" name="password" class="custom-login-input" placeholder="Masukkan kata sandi..." required>
            </div>

            <button type="submit" class="btn btn-premium-login mb-4">
                <i class="bi bi-box-arrow-in-right me-2 text-warning"></i> Masuk Ruang Kendali
            </button>
            
            <div class="text-center mb-1" style="font-size: 0.85rem; font-weight: 600;">
                <span class="text-muted">Belum terdaftar?</span> 
                <a href="<?= base_url('auth/register'); ?>" class="text-decoration-none text-primary fw-bold ms-1">Buat Akun Warga</a>
            </div>

            <div class="text-center text-muted border-top pt-3 mt-4" style="font-size: 0.72rem; font-weight: 500; border-color: #f1f5f9 !important;">
                <i class="bi bi-shield-fill-check text-primary me-1"></i> Otorisasi Terenkripsi SQA Satgas Vokasi
            </div>
        </form>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>