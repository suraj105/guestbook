<?php

require_once __DIR__ . '/inc/db-connect.php';
require_once __DIR__ . '/inc/functions.php';

// Pagination settings
$perPage = 15;
$currentPage = max(1, (int)($_GET['page'] ?? 1)); // Default to page 1 if not set or invalid

// Get the total number of entries
$stmtCount = $pdo->query('SELECT COUNT(*) AS count FROM entries');
$countTotal = $stmtCount->fetchColumn();

// Fetch paginated entries
$offset = ($currentPage - 1) * $perPage;
$stmt = $pdo->prepare('SELECT * FROM entries ORDER BY id DESC LIMIT :offset, :perPage');
$stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Render the view
require __DIR__ . '/views/index.view.php';
