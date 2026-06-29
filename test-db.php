<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Database test</title>
</head>
<body>
    <h1>Database test</h1>
    <?php
    require 'db.php';

    try {
        $result = $pdo->query('SELECT 1 AS test');
        $row = $result->fetch_assoc();
        echo '<p style="color:green;">Verbonden met de database. Testwaarde: ' . htmlspecialchars($row['test']) . '</p>';
    } catch (Exception $e) {
        echo '<p style="color:red;">Fout: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
    ?>
</body>
</html>
