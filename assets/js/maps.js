var map;
var marker;

// Inisialisasi Peta saat halaman siap (Default ke Gorontalo)
function initMap() {
    // Koordinat pusat Gorontalo (sekitar UNG)
    map = L.map('map').setView([0.5562, 123.0585], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
}

function getLocation() {
    if (navigator.geolocation) {
        document.getElementById('location-status').innerHTML = "Sedang mencari lokasi... <i class='bi bi-arrow-repeat spin'></i>";
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation tidak didukung oleh browser ini.");
    }
}

function showPosition(position) {
    const lat = position.coords.latitude;
    const lng = position.coords.longitude;

    // 1. Update Input Form
    document.getElementById('koordinat_gps').value = lat + ", " + lng;
    document.getElementById('location-status').innerHTML = "<i class='bi bi-check-circle-fill'></i> Lokasi Berhasil Dikunci!";

    // 2. Arahkan Peta ke Titik Tersebut
    map.setView([lat, lng], 17); // Zoom diperbesar ke 17

    // 3. Tambahkan atau Pindahkan Marker
    if (marker) {
        marker.setLatLng([lat, lng]);
    } else {
        marker = L.marker([lat, lng], {draggable: true}).addTo(map);
        
        // Fitur Tambahan: Marker bisa digeser manual jika GPS kurang akurat
        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            document.getElementById('koordinat_gps').value = position.lat + ", " + position.lng;
        });
    }

    marker.bindPopup("<b>Lokasi Kerusakan</b><br>Titik ditemukan di sini.").openPopup();
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("User menolak permintaan Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Informasi lokasi tidak tersedia.");
            break;
        case error.TIMEOUT:
            alert("Waktu permintaan lokasi habis.");
            break;
    }
}

// Jalankan initMap saat halaman selesai loading
window.onload = initMap;