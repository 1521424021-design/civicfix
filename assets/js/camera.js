function takeSnapshot() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    
    // Set ukuran canvas sesuai video
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0);
    
    // 1. Ubah ke Blob (File Virtual)
    canvas.toBlob(function(blob) {
        // 2. Gunakan DataTransfer untuk memasukkan blob ke input file asli
        let file = new File([blob], "foto_kamera.png", {type: "image/png"});
        let container = new DataTransfer();
        container.items.add(file);
        
        // 3. Masukkan ke input file yang namanya "foto" (sesuaikan name di HTML)
        document.getElementById('foto_input_asli').files = container.files;
        
        alert("Foto berhasil dijepret dan siap dikirim!");
    }, 'image/png');
}