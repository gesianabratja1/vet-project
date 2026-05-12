<?php

declare(strict_types=1);

session_start();
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php#kontakt');
    exit;
}

$name = trim((string) ($_POST['name'] ?? ''));
$contact = trim((string) ($_POST['contact'] ?? ''));
$petType = trim((string) ($_POST['pet_type'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));
$allowedPets = ['Qen', 'Mace', 'Kafshë tjetër'];

if ($name === '' || $contact === '' || $message === '' || !in_array($petType, $allowedPets, true)) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'message' => 'Ju lutemi plotësoni të gjitha fushat e formularit.',
    ];
    header('Location: index.php#kontakt');
    exit;
}

if (mb_strlen($name) > 100 || mb_strlen($contact) > 150 || mb_strlen($message) > 1000) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'message' => 'Disa fusha janë më të gjata se limiti i lejuar.',
    ];
    header('Location: index.php#kontakt');
    exit;
}

$pdo = getPdo();

if (!$pdo instanceof PDO) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'message' => 'Nuk u lidhëm dot me databazën. Kontrollo konfigurimin e MySQL.',
    ];
    header('Location: index.php#kontakt');
    exit;
}

try {
    $statement = $pdo->prepare(
        'INSERT INTO appointments (name, contact, pet_type, message) VALUES (:name, :contact, :pet_type, :message)'
    );
    $statement->execute([
        'name' => $name,
        'contact' => $contact,
        'pet_type' => $petType,
        'message' => $message,
    ]);

    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Faleminderit! Kërkesa u regjistrua në databazë dhe do të të kontaktojmë së shpejti.',
    ];
} catch (PDOException) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'message' => 'Kërkesa nuk u ruajt. Sigurohu që tabela appointments ekziston.',
    ];
}

header('Location: index.php#kontakt');
exit;
