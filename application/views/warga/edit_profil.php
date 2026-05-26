<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="mb-4 animate__animated animate__fadeInLeft">
                <a href="<?= base_url('warga/profil'); ?>" class="text-decoration-none text-muted fw-bold small">
                    <i class="bi bi-arrow-left me-2"></i> KEMBALI KE PROFIL
                </a>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate__animated animate__fadeInUp">
                <div class="card-header p-4 border-0" style="background: linear-gradient(135deg, #0061ff 0%, #60efff 100%);">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                            <i class="bi bi-person-gear text-white fs-4"></i>
                        </div>
                        <div>
                            <h5 class="text-white fw-800 mb-0">Pengaturan Profil</h5>
                            <small class="text-white opacity-75">Perbarui informasi identitas Anda</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="<?= base_url('warga/proses_edit_profil'); ?>" method="POST">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark small-caps">Nama Lengkap Anda</label>
                            <div class="input-group custom-input-group">
                                <span class="input-group-text bg-soft-primary border-0"><i class="bi bi-person-vcard text-primary"></i></span>
                                <input type="text" name="nama" class="form-control border-0 bg-light-f9 py-3" 
                                       value="<?= $this->session->userdata('nama'); ?>" 
                                       placeholder="Masukkan nama sesuai KTP" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark small-caps">Alamat Email Aktif</label>
                            <div class="input-group custom-input-group">
                                <span class="input-group-text bg-soft-primary border-0"><i class="bi bi-envelope-at text-primary"></i></span>
                                <input type="email" name="email" class="form-control border-0 bg-light-f9 py-3" 
                                       value="<?= $this->session->userdata('email'); ?>" 
                                       placeholder="nama@email.com" required>
                            </div>
                            <div class="mt-2 d-flex align-items-start">
                                <i class="bi bi-info-circle text-primary me-2 mt-1"></i>
                                <small class="text-muted italic">Pastikan email aktif untuk menerima notifikasi real-time terkait progres laporan perbaikan infrastruktur Anda.</small>
                            </div>
                        </div>

                        <hr class="my-5 opacity-10">

                        <div class="d-flex flex-column flex-md-row gap-3">
                            <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill fw-800 shadow-blue flex-grow-1 order-md-2">
                                SIMPAN PERUBAHAN <i class="bi bi-shield-check ms-2"></i>
                            </button>
                            <a href="<?= base_url('warga/profil'); ?>" class="btn btn-soft-light px-4 py-3 rounded-pill fw-bold order-md-1">
                                BATALKAN
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <p class="text-center mt-4 text-muted x-small fw-bold opacity-50 uppercase">
                Keamanan data Anda terjaga oleh sistem enkripsi CivicFix Professional
            </p>
        </div>
    </div>
</div>

<style>
    /* HD CUSTOM STYLING */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
    
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7fe; }
    
    .fw-800 { font-weight: 800; }
    .small-caps { font-size: 0.7rem; letter-spacing: 0.5px; text-transform: uppercase; color: #64748b !important; }
    .x-small { font-size: 0.65rem; }
    .italic { font-style: italic; font-size: 0.75rem; }

    /* Input Group Styling */
    .bg-light-f9 { background-color: #f8fafc !important; }
    .bg-soft-primary { background-color: #eef2ff !important; }
    
    .custom-input-group {
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .custom-input-group:focus-within {
        border-color: #0061ff;
        box-shadow: 0 0 0 4px rgba(0, 97, 255, 0.1);
        transform: translateY(-2px);
    }

    .form-control:focus {
        background-color: #fff !important;
        box-shadow: none;
    }

    /* Button Styling */
    .btn-primary { background: linear-gradient(135deg, #0061ff 0%, #60efff 100%); border: none; }
    .shadow-blue { box-shadow: 0 10px 20px rgba(0, 97, 255, 0.2); }
    .btn-soft-light { background-color: #f1f5f9; color: #64748b; border: none; }
    .btn-soft-light:hover { background-color: #e2e8f0; color: #1e293b; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-header { text-align: center; }
        .card-header .d-flex { flex-direction: column; }
        .card-header .me-3 { margin-right: 0 !important; margin-bottom: 1rem; }
    }
</style>