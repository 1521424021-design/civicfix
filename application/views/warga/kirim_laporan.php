<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="container-fluid px-4 py-4 animate__animated animate__fadeIn">
    
    <div class="mb-4">
        <div class="badge bg-soft-primary text-primary rounded-pill px-3 py-2 fw-bold small-caps mb-2 shadow-sm">
            <i class="bi bi-geo-alt-fill text-danger"></i> Geospasial Kunci Lokasi
        </div>
        <h2 class="fw-800 text-dark mb-1 tracking-tight">Kirim Pengaduan Baru</h2>
        <p class="text-muted small mb-0 font-medium">Laporkan kerusakan infrastruktur secara valid demi percepatan pembangunan Kota Gorontalo</p>
    </div>

    <form action="<?= base_url('warga/proses_simpan_laporan'); ?>" method="POST" enctype="multipart/form-data">
        <div class="row g-4">
            
            <div class="col-12 col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 bg-white p-4 h-100">
                    <h5 class="fw-800 text-dark mb-4 border-bottom pb-2">
                        <i class="bi bi-pencil-square text-primary me-2"></i> Detail Informasi Aduan
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary small-uppercase-caps">Kategori / Tipe Kerusakan</label>
                        <input type="text" name="tipe_kerusakan" class="form-control custom-input-sig" placeholder="Contoh: Jalan Berlubang Parah, Drainase Tersumbat" required autocomplete="off">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary small-uppercase-caps">Deskripsi Kronologi Fakta</label>
                        <textarea name="deskripsi" class="form-control custom-input-sig" rows="4" placeholder="Jelaskan secara rinci kondisi kerusakan infrastruktur di lokasi..." required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary small-uppercase-caps">Foto Dokumentasi Fisik</label>
                        <input type="file" name="foto" class="form-control custom-input-sig" accept="image/*" required>
                        <small class="text-muted x-small d-block mt-1"><i class="bi bi-info-circle"></i> Ekstensi valid: JPG, JPEG, PNG. Maksimal 2MB.</small>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label fw-bold text-secondary x-small-caps">Garis Lintang (Latitude)</label>
                            <input type="text" id="form_lat" name="lat" class="form-control bg-light fw-bold text-dark text-center" placeholder="Klik pada peta..." readonly required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold text-secondary x-small-caps">Garis Bujur (Longitude)</label>
                            <input type="text" id="form_lng" name="lng" class="form-control bg-light fw-bold text-dark text-center" placeholder="Klik pada peta..." readonly required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-7">
                <div class="card border-0 shadow-lg rounded-4 bg-white overflow-hidden h-100 d-flex flex-column">
                    <div class="card-header bg-white py-3 px-4 border-0 border-bottom d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2">
                        <div>
                            <h5 class="fw-800 text-dark mb-0 d-flex align-items-center">
                                <i class="bi bi-map-fill text-primary me-2 fs-5"></i> Penentuan Titik Koordinat SIG
                            </h5>
                            <p class="text-muted x-small mb-0">Klik langsung pada peta atau gunakan tombol GPS untuk mengunci lokasi</p>
                        </div>
                        <button type="button" id="btn_temukan_saya" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold shadow-sm text-nowrap">
                            <i class="bi bi-geo-fill text-danger me-1"></i> Gunakan Lokasi Saya
                        </button>
                    </div>
                    
                    <div class="card-body p-0 flex-grow-1" style="min-height: 420px; position: relative;">
                        <div id="mapPenyusupanAduan" style="position: absolute; top: 0; bottom: 0; width: 100%; height: 100%;"></div>
                    </div>
                    
                    <div class="card-footer bg-white p-3 border-0 border-top text-end">
                        <button type="submit" class="btn btn-premium-dark rounded-pill px-5 py-2-5 shadow-md">
                            <i class="bi bi-send-fill text-warning me-2"></i> Kirim Berkas Aduan Ke Satgas
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Koordinat Tengah Awal (Default: Kota Gorontalo / Rektorat UNG)
    var defaultLat = -0.5436;
    var defaultLng = 123.0617;
    
    // 2. Inisialisasi Objek Map
    var map = L.map('mapPenyusupanAduan').setView([defaultLat, defaultLng], 14);

    // 3. Load Lapisan Peta Jalan dari OpenStreetMap Standar SIG
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap | CivicFix TRPL Vokasi UNG'
    }).addTo(map);

    // 4. Buat Variable Tampung untuk Marker Tunggal
    var penandaLokasi = null;

    // 5. Fungsi Mengunci Koordinat & Pindahkan Pin Marker
    function tempatkanPinKece(lat, lng) {
        document.getElementById('form_lat').value = lat.toFixed(6);
        document.getElementById('form_lng').value = lng.toFixed(6);

        if (penandaLokasi) {
            penandaLokasi.setLatLng([lat, lng]);
        } else {
            penandaLokasi = L.marker([lat, lng], { draggable: true }).addTo(map);
            
            // Logika SQA Hardening: Jika pin diseret manual oleh warga, perbarui koordinatnya
            penandaLokasi.on('dragend', function(e) {
                var posisiBaru = penandaLokasi.getLatLng();
                document.getElementById('form_lat').value = posisiBaru.lat.toFixed(6);
                document.getElementById('form_lng').value = posisiBaru.lng.toFixed(6);
            });
        }
        map.panTo([lat, lng]);
    }

    // 6. EVENT KONTROL: Deteksi Klik Pengguna pada Peta
    map.on('click', function(e) {
        tempatkanPinKece(e.latlng.lat, e.latlng.lng);
    });

    // 7. EVENT KONTROL: Fungsi Tombol Geolocation Browser GPS
    document.getElementById('btn_temukan_saya').addEventListener('click', function() {
        if (navigator.geolocation) {
            var tombol = this;
            tombol.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Melacak GPS...';
            tombol.disabled = true;

            navigator.geolocation.getCurrentPosition(function(position) {
                var userLat = position.coords.latitude;
                var userLng = position.coords.longitude;
                
                tempatkanPinKece(userLat, userLng);
                map.setZoom(16);
                
                tombol.innerHTML = '<i class="bi bi-geo-fill text-danger me-1"></i> Gunakan Lokasi Saya';
                tombol.disabled = false;
            }, function(error) {
                alert('Gagal melacak lokasi Anda. Mohon klik lokasi secara manual pada peta.');
                tombol.innerHTML = '<i class="bi bi-geo-fill text-danger me-1"></i> Gunakan Lokasi Saya';
                tombol.disabled = false;
            });
        } else {
            alert('Browser laptop Anda tidak mendukung pelacakan GPS otomatis.');
        }
    });

    // SQA Map Reset Bug-Bypass: Memaksa Leaflet menghitung ulang ukuran kontainer agar peta tidak pecah abu-abu
    setTimeout(function(){ 
        map.invalidateSize(); 
    }, 400);
});
</script>

<style>
    /* UTILITIES PRESET UNTUK ESTETIKA FORMULA SIG */
    .fw-800 { font-weight: 800; }
    .font-medium { font-weight: 500; }
    .tracking-tight { letter-spacing: -0.5px; }
    .small-caps { font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1px; }
    .small-uppercase-caps { font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; }
    .x-small-caps { font-size: 0.7rem; text-transform: uppercase; color: #94a3b8; }
    .x-small { font-size: 0.75rem; }
    .bg-soft-primary { background-color: #eff6ff; }
    
    .custom-input-sig {
        background-color: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: #1e293b;
    }
    .custom-input-sig:focus {
        background-color: #ffffff !important;
        border-color: #0061ff !important;
        box-shadow: 0 0 0 4px rgba(0, 97, 255, 0.1) !important;
    }
    .btn-premium-dark {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        border: none; 
        color: white; 
        font-weight: 700; 
        font-size: 0.9rem;
        transition: 0.2s;
    }
    .btn-premium-dark:hover {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        transform: translateY(-2px);
    }
    .hover-up:hover {
        transform: translateY(-2px);
    }
</style>