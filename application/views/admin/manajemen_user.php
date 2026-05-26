<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container-fluid py-4 main-user-container animate__animated animate__fadeIn">
    
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-lg rounded-4 mb-4 dashboard-alert animate__animated animate__slideInDown">
            <div class="d-flex align-items-center">
                <div class="alert-icon-box bg-success text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                </div>
                <div>
                    <strong class="d-block text-dark small-uppercase-caps">Sistem Berhasil</strong>
                    <span class="text-muted small-13"><?= $this->session->flashdata('success'); ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-5 gap-3 dynamic-header-panel">
        <div>
            <div class="badge bg-soft-primary text-primary rounded-pill px-3 py-2 fw-bold small-caps mb-2 shadow-sm">
                <i class="bi bi-people-fill me-1"></i> Hak Akses Kontrol
            </div>
            <h2 class="fw-800 text-dark mb-1 tracking-tight">Manajemen Pengguna</h2>
            <p class="text-muted small mb-0 font-medium">Sistem Otorisasi CivicFix &bull; Kelola Akun Warga & Personil Lapangan URC</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <button type="button" class="btn btn-premium-dark shadow-md rounded-pill px-4 py-2-5 transition-all hover-up" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                <i class="bi bi-person-plus-fill me-2 text-warning"></i> Tambah Pengguna Baru
            </button>
        </div>
    </div>

    <div class="card border-0 shadow-lg rounded-4 bg-white table-container-card animate__animated animate__fadeInUp">
        <div class="card-header bg-white py-4 px-4 border-0 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-800 text-dark mb-0 d-flex align-items-center">
                    <i class="bi bi-shield-shared text-primary me-2 fs-4"></i> Registrasi Akun Terdaftar
                </h5>
                <p class="text-muted small mb-0">Pantau, verifikasi, atau hapus kredensial hak akses pengguna</p>
            </div>
            <span class="badge bg-light text-dark rounded-pill px-3 py-2 border fw-bold"><?= count($all_users); ?> Akun Aktif</span>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 custom-premium-table">
                    <thead class="bg-light-table text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="ps-4 py-3 border-0">Nama & Identitas</th>
                            <th class="py-3 border-0">Kontak Email</th>
                            <th class="py-3 border-0 text-center">Nomor NIK</th>
                            <th class="py-3 border-0 text-center">Role Sistem</th>
                            <th class="py-3 border-0 text-end pe-4">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($all_users)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 empty-table-state">
                                    <img src="https://illustrations.popsy.co/blue/customer-support.svg" style="width: 180px;" class="mb-3 opacity-75">
                                    <h6 class="text-dark fw-bold mb-1">Tidak Ada User</h6>
                                    <p class="text-muted small mb-0">Belum ada data pengguna yang terdaftar di sistem.</p>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach($all_users as $user_row): ?>
                        <tr class="item-row transition-all">
                            <td class="ps-4 py-3-5">
                                <div class="d-flex align-items-center">
                                    <?php
                                        $avatar_bg = 'bg-soft-primary text-primary';
                                        if($user_row->role == 'Admin') $avatar_bg = 'bg-soft-danger text-danger';
                                        if($user_row->role == 'Petugas') $avatar_bg = 'bg-soft-info text-info';
                                    ?>
                                    <div class="avatar-box <?= $avatar_bg; ?> rounded-3 me-3 shadow-sm">
                                        <?= substr($user_row->nama ?? '?', 0, 1); ?>
                                    </div>
                                    <div>
                                        <div class="fw-800 text-dark small-13 mb-0"><?= $user_row->nama; ?></div>
                                        <small class="text-muted x-small d-block mt-0-5">ID: #USR-00<?= $user_row->user_id; ?></small>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="py-3-5 font-medium text-dark small-13">
                                <?= $user_row->email; ?>
                            </td>
                            
                            <td class="text-center py-3-5 text-muted small-13 font-medium">
                                <?= !empty($user_row->nik) ? $user_row->nik : '<span class="text-light-gray italic">-</span>'; ?>
                            </td>
                            
                            <td class="text-center py-3-5">
                                <?php 
                                    $role_class = 'bg-soft-secondary text-secondary';
                                    if($user_row->role == 'Admin') $role_class = 'bg-soft-danger text-danger-deep';
                                    elseif($user_row->role == 'Petugas') $role_class = 'bg-soft-info text-info-deep';
                                    elseif($user_row->role == 'Warga') $role_class = 'bg-soft-success text-success-deep';
                                ?>
                                <span class="badge <?= $role_class; ?> rounded-pill px-3 py-2 fw-bold status-badge-premium">
                                    <?= strtoupper($user_row->role); ?>
                                </span>
                            </td>

                            <td class="text-end pe-4 py-3-5">
                                <?php if($user_row->user_id != $this->session->userdata('user_id')): ?>
                                    <a href="<?= base_url('admin/hapus_user/'.$user_row->user_id); ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold shadow-xsm transition-all" onclick="return confirm('Tindakan SQA: Yakin ingin menghapus permanen akun ini?')">
                                        <i class="bi bi-trash3-fill me-1"></i> Hapus
                                    </a>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted rounded-pill px-3 py-2 border x-small fw-bold">Akun Anda</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahUser" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-xl rounded-4">
            <div class="modal-header bg-light border-0 py-3 px-4">
                <h5 class="modal-title fw-800 text-dark"><i class="bi bi-person-plus-fill text-primary me-2"></i>Registrasi User Sistem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="<?= base_url('admin/proses_tambah_user'); ?>" method="POST" class="core-user-form">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-800 text-dark small-uppercase-caps">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control border-0 bg-light-panel-footer rounded-3 py-2-5 px-3 shadow-xsm" placeholder="Masukkan nama lengkap..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-800 text-dark small-uppercase-caps">Alamat Email</label>
                        <input type="email" name="email" class="form-control border-0 bg-light-panel-footer rounded-3 py-2-5 px-3 shadow-xsm" placeholder="contoh@civicfix.id" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-800 text-dark small-uppercase-caps">NIK (Opsional)</label>
                        <input type="text" name="nik" class="form-control border-0 bg-light-panel-footer rounded-3 py-2-5 px-3 shadow-xsm" placeholder="750XXXXXXXXXXXXX">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-800 text-dark small-uppercase-caps">Kata Sandi</label>
                        <input type="password" name="password" class="form-control border-0 bg-light-panel-footer rounded-3 py-2-5 px-3 shadow-xsm" placeholder="••••••••" required>
                    </div>

                    <div class="mb-1">
                        <label class="form-label fw-800 text-dark small-uppercase-caps">Level Akses Otoritas</label>
                        <select name="role" class="form-select border-0 bg-light-panel-footer rounded-3 py-2-5 px-3 fw-bold text-primary shadow-xsm">
                            <option value="Warga">🟢 WARGA (Masyarakat Pelapor)</option>
                            <option value="Petugas">🔵 PETUGAS (Unit Reaksi Cepat Lapangan)</option>
                            <option value="Admin">🔴 ADMIN (Pengawas & Validasi Pusat)</option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer border-0 bg-light py-3 px-4 d-flex gap-2">
                    <button type="button" class="btn btn-white border rounded-pill px-4 fw-bold shadow-sm" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-premium-save rounded-pill px-4 py-2 text-white fw-bold shadow-blue">
                        <i class="bi bi-cloud-arrow-up-fill me-1 text-warning"></i> Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* ==========================================================================
       CIVICFIX USER MANAGEMENT PREMIUM LIGHT STYLING
       ========================================================================== */
    
    .btn-premium-dark {
        background-color: #1e293b; color: #ffffff; border: none; font-weight: 700; font-size: 0.85rem;
    }
    .btn-premium-dark:hover { background-color: #0f172a; color: #ffffff; }
    
    .py-3-5 { padding-top: 1.1rem; padding-bottom: 1.1rem; }
    .text-light-gray { color: #cbd5e1; }
    .bg-light-panel-footer { background-color: #f8fafc; }

    /* Soft Role Badges Colors */
    .bg-soft-danger { background-color: #fef2f2; }
    .bg-soft-info { background-color: #f0f9ff; }
    .bg-soft-success { background-color: #f0fdf4; }
    .bg-soft-primary { background-color: #eef2ff; }
    .bg-soft-secondary { background-color: #f1f5f9; }
    .bg-light-table { background-color: #f8fafc; }

    .text-danger-deep { color: #b91c1c; }
    .text-info-deep { color: #0284c7; }
    .text-success-deep { color: #16a34a; }

    /* Table & Card Settings */
    .table-container-card { border: 1px solid rgba(226, 232, 240, 0.8); }
    .custom-premium-table tbody tr { border-bottom: 1px solid #f1f5f9; }
    .item-row:hover { background-color: #f8fafc !important; }

    .avatar-box {
        width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 1.1rem; border-radius: 12px;
    }
    .status-badge-premium { font-size: 0.7rem; letter-spacing: 0.5px; padding: 6px 14px !important; }

    /* Button Premium Save */
    .btn-premium-save { background: linear-gradient(135deg, #1e293b 0%, #334155 100%); border: none; }
    .btn-premium-save:hover { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); }
    .shadow-blue { box-shadow: 0 8px 20px rgba(30, 41, 59, 0.2); }
    .shadow-xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15) !important; }
</style>