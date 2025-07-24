<?php
require_once '../config/db.php';

if (!isset($_GET['id'])) {
    echo "ID do agendamento não informado.";
    exit;
}

$id = $_GET['id'];

// Exclui o agendamento
$stmt = $pdo->prepare("DELETE FROM agendamentos WHERE id = ?");
$stmt->execute([$id]);

header("Location: listar_agendamentos.php?msg=excluido");
exit;
