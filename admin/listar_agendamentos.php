<?php
require_once '../config/db.php';

$filtro_data = $_GET['data'] ?? '';
$filtro_status = $_GET['status'] ?? '';

$sql = "
    SELECT 
        a.id,
        c.nome AS nome_cliente,
        c.telefone,
        a.data,
        a.horario,
        GROUP_CONCAT(s.nome SEPARATOR ', ') AS nome_servico,
        a.status
    FROM agendamentos a
    JOIN clientes c ON a.cliente_id = c.id
    LEFT JOIN agendamento_servicos ags ON a.id = ags.agendamento_id
    LEFT JOIN servicos s ON ags.servico_id = s.id
    WHERE 1
";

$params = [];

if ($filtro_data) {
    $sql .= " AND a.data = :data";
    $params[':data'] = $filtro_data;
}

if ($filtro_status) {
    $sql .= " AND a.status = :status";
    $params[':status'] = $filtro_status;
}

$sql .= " GROUP BY a.id ORDER BY a.data, a.horario";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$agendamentos = $stmt->fetchAll();
?>
