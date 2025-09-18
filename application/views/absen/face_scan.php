<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Recognition</title>
    <script defer src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api/dist/face-api.min.js" onload="initFaceAPI()"></script>

</head>

<body>
    <h2>Face Recognition dengan Face API.js</h2>
    <video id="video" width="720" height="560" autoplay></video>
    <canvas id="canvas"></canvas>

    <script>
        function initFaceAPI() {
    console.log("Face API.js berhasil dimuat!");

    // Pastikan Face API tersedia sebelum menjalankan deteksi wajah
    if (typeof faceapi === 'undefined') {
        console.error("Face API.js belum dimuat! Periksa koneksi internet.");
        return;
    }

    // Mulai proses pengenalan wajah setelah skrip dimuat
    startFaceRecognition();
}

async function startFaceRecognition() {
    console.log("Memuat model Face API...");

    try {
        await faceapi.nets.tinyFaceDetector.loadFromUri('<?= base_url('assets/models') ?>');
        await faceapi.nets.faceLandmark68Net.loadFromUri('<?= base_url('assets/models') ?>');
        await faceapi.nets.faceRecognitionNet.loadFromUri('<?= base_url('assets/models') ?>');

        console.log("Model Face API berhasil dimuat!");

        const video = document.getElementById('video');
        navigator.mediaDevices.getUserMedia({ video: {} })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => console.error("Gagal mengakses kamera:", err));

        video.addEventListener('play', async () => {
            console.log("Kamera aktif, mulai deteksi wajah...");

            const canvas = faceapi.createCanvasFromMedia(video);
            document.body.append(canvas);
            const displaySize = { width: video.width, height: video.height };
            faceapi.matchDimensions(canvas, displaySize);

            setInterval(async () => {
                const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks();
                const resizedDetections = faceapi.resizeResults(detections, displaySize);
                canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                faceapi.draw.drawDetections(canvas, resizedDetections);
                faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
            }, 100);
        });

    } catch (error) {
        console.error("Gagal memuat model Face API:", error);
    }
}

// Pastikan halaman sudah dimuat sebelum memulai
window.onload = () => {
    console.log("Halaman dimuat, mulai Face Recognition...");
    initFaceAPI();
};

      

        
    </script>
</body>

</html>