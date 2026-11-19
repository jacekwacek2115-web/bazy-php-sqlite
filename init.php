<?php
$pdo = new PDO('sqlite:' . __DIR__ . '/baza.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec("
    CREATE TABLE IF NOT EXISTS uzytkownicy (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        imie TEXT NOT NULL,
        nazwisko TEXT NOT NULL,
        wiek INTEGER NOT NULL
    )
");

$count = (int)$pdo->query("SELECT COUNT(*) FROM uzytkownicy")->fetchColumn();
if ($count === 0) {
    $pdo->exec("
        INSERT INTO uzytkownicy (imie, nazwisko, wiek) VALUES
        ('Jan', 'Kowalski', 22),
        ('Anna', 'Nowak', 21),
        ('Piotr', 'Zieliński', 23)
    ");
}

$rows = $pdo->query("SELECT * FROM uzytkownicy")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Uruchamianie bazy danych</title>
</head>
<body>
    <h2>Uruchamianie bazy danych</h2>
    <p><a href="index.php">Powrót</a></p>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>Id</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Wiek</th>
        </tr>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= htmlspecialchars((string)$row['id']) ?></td>
                <td><?= htmlspecialchars((string)$row['imie']) ?></td>
                <td><?= htmlspecialchars((string)$row['nazwisko']) ?></td>
                <td><?= htmlspecialchars((string)$row['wiek']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
