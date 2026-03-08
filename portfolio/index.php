<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writing Portfolio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #2c3e50;
            color: #fff;
            padding: 3rem 2rem;
            text-align: center;
        }

        header h1 {
            font-size: 2.4rem;
            margin-bottom: 0.5rem;
        }

        header p {
            font-size: 1.1rem;
            color: #bdc3c7;
        }

        main {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .sample-list {
            list-style: none;
        }

        .sample-list li {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            margin-bottom: 1rem;
            transition: box-shadow 0.2s;
        }

        .sample-list li:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .sample-list a {
            display: flex;
            align-items: center;
            padding: 1.25rem 1.5rem;
            text-decoration: none;
            color: #2c3e50;
        }

        .pdf-icon {
            flex-shrink: 0;
            width: 40px;
            height: 40px;
            background-color: #e74c3c;
            color: #fff;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            margin-right: 1.25rem;
        }

        .sample-info {
            flex: 1;
        }

        .sample-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .sample-meta {
            font-size: 0.85rem;
            color: #888;
            margin-top: 0.2rem;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #999;
        }

        .empty-state p {
            margin-bottom: 0.5rem;
        }

        .empty-state code {
            background: #eee;
            padding: 0.2rem 0.5rem;
            border-radius: 3px;
            font-size: 0.9rem;
        }

        footer {
            text-align: center;
            padding: 2rem;
            color: #aaa;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Writing Portfolio</h1>
        <p>A collection of selected writing samples</p>
    </header>

    <main>
        <?php
        $samples_dir = __DIR__ . '/samples';
        $pdf_files = glob($samples_dir . '/*.pdf');

        if ($pdf_files && count($pdf_files) > 0):
            // Sort alphabetically by filename
            sort($pdf_files);
        ?>
        <ul class="sample-list">
            <?php foreach ($pdf_files as $file):
                $filename = basename($file);
                $title = pathinfo($filename, PATHINFO_FILENAME);
                // Convert hyphens/underscores to spaces and title-case
                $title = ucwords(str_replace(['-', '_'], ' ', $title));
                $size = filesize($file);
                $size_label = $size < 1048576
                    ? round($size / 1024) . ' KB'
                    : round($size / 1048576, 1) . ' MB';
            ?>
            <li>
                <a href="samples/<?= htmlspecialchars($filename, ENT_QUOTES, 'UTF-8') ?>" target="_blank">
                    <span class="pdf-icon">PDF</span>
                    <span class="sample-info">
                        <span class="sample-title"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="sample-meta"><?= $size_label ?></span>
                    </span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <div class="empty-state">
            <p>No writing samples found yet.</p>
            <p>Place PDF files in the <code>portfolio/samples/</code> directory.</p>
        </div>
        <?php endif; ?>
    </main>

    <footer>
        &copy; <?= date('Y') ?> Writing Portfolio
    </footer>
</body>
</html>
