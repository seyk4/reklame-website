<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>WebAR - Viewer</title>
    <script src="https://aframe.io/releases/1.5.0/aframe.min.js"></script>
    <script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
</head>
<body style="margin: 0px; overflow: hidden;">

    <a-scene embedded arjs="sourceType: webcam; debugUIEnabled: false;">
        <a-assets>
            <img id="uploaded-image" src="">
        </a-assets>

        <a-marker preset="hiro">
            <a-image id="ar-image" src="#uploaded-image" rotation="-90 0 0"></a-image>
        </a-marker>
      
        <a-entity camera></a-entity>
    </a-scene>

    <script>
        window.addEventListener('load', () => {
            // Ambil data gambar dari sessionStorage
            const imageData = sessionStorage.getItem('arImage');
            const uploadedImage = document.querySelector('#uploaded-image');

            if (imageData) {
                // Setel data gambar ke elemen <img> di assets
                uploadedImage.setAttribute('src', imageData);
            } else {
                // Arahkan kembali ke halaman upload jika tidak ada gambar
                alert("Anda harus mengupload gambar terlebih dahulu!");
                window.location.href = "{{ route('reklame.ar.upload') }}";
            }
        });
    </script>
</body>
</html>