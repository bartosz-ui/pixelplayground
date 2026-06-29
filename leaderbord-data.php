<?php
require 'session.php';
require 'db.php';

header('Content-Type: application/json');

try {
    $result = $pdo->query(
        'SELECT player_name, connect4_rank, connect4_score, wordle_rank, wordle_score FROM leaderboard ORDER BY connect4_rank ASC'
    );

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    echo json_encode(['rows' => $rows]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
