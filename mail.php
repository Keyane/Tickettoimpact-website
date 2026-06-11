<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$name    = trim(strip_tags($_POST['name'] ?? ''));
$email   = trim(strip_tags($_POST['email'] ?? ''));
$phone   = trim(strip_tags($_POST['phone'] ?? ''));
$message = trim(strip_tags($_POST['message'] ?? ''));

if (!$name || !$email || !$message) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Vul alle verplichte velden in.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Ongeldig e-mailadres.']);
    exit;
}

$to      = 'keyane.moorman@gmail.com';
$subject = 'Nieuw contactbericht via tickettoimpact.com';

$body  = "Naam: " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "\n";
$body .= "E-mail: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "\n";
$body .= "Telefoon: " . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . "\n\n";
$body .= "Bericht:\n" . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . "\n";

$headers  = "From: website@tickettoimpact.com\r\n";
$headers .= "Reply-To: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$sent = mail($to, $subject, $body, $headers);

if ($sent) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Verzenden mislukt. Probeer het later opnieuw.']);
}
