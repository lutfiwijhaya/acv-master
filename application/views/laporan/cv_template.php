<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV <?= $nama; ?></title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .container { width: 100%; max-width: 800px; margin: auto; border: 1px solid #ddd; padding: 20px; }
        h1 { text-align: center; color: #2c3e50; }
        .section { margin-bottom: 20px; }
        .section h2 { border-bottom: 2px solid #3498db; padding-bottom: 5px; color: #3498db; }
        .contact { list-style: none; padding: 0; }
        .contact li { margin: 5px 0; }
        .skills { display: flex; flex-wrap: wrap; }
        .skills span { background: #3498db; color: white; padding: 5px 10px; margin: 5px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= $nama; ?></h1>
        <ul class="contact">
            <li><strong>Email:</strong> <?= $email; ?></li>
            <li><strong>Telepon:</strong> <?= $phone; ?></li>
            <li><strong>Alamat:</strong> <?= $address; ?></li>
        </ul>

        <div class="section">
            <h2>Tentang Saya</h2>
            <p><?= $summary; ?></p>
        </div>

        <div class="section">
            <h2>Keterampilan</h2>
            <div class="skills">
                <?php foreach ($skills as $skill): ?>
                    <span><?= $skill; ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
