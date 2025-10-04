<?php
require __DIR__ . '/../config/db.php';
header('Content-Type: application/json');

$offering = $_GET['offering'] ?? null;
if (!$offering) {
  echo json_encode([]);
  exit;
}

$stmt = $pdo->prepare("
  SELECT u.full_name, u.email 
  FROM registrations r
  JOIN users u ON r.student_id = u.id
  WHERE r.offering_id = ?
");
$stmt->execute([$offering]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
