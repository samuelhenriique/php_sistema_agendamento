<?php
require_once '../config/db.php';

$filtro_data = $_GET['data'] ?? '';
$filtro_status = $_GET['status'] ?? '';

$sql = "SELECT a.*, s.nome AS nome_servico 
        FROM agendamentos a
        JOIN servicos s ON a.id_servico = s.id
        WHERE 1";

$params = [];

if ($filtro_data) {
    $sql .= " AND a.data = :data";
    $params[':data'] = $filtro_data;
}

if ($filtro_status) {
    $sql .= " AND a.status = :status";
    $params[':status'] = $filtro_status;
}

$sql .= " ORDER BY a.data, a.horario";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$agendamentos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendamentos</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h1>📋 Lista de Agendamentos</h1>

        <form method="GET" class="filtros">
            <input type="date" name="data" value="<?= htmlspecialchars($filtro_data) ?>">
            <select name="status">
                <option value="">Todos</option>
                <option value="Pendente" <?= $filtro_status === 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                <option value="Confirmado" <?= $filtro_status === 'Confirmado' ? 'selected' : '' ?>>Confirmado</option>
                <option value="Cancelado" <?= $filtro_status === 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
            </select>
            <button type="submit">🔍 Filtrar</button>
        </form>

        <table class="tabela">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Serviço</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($agendamentos as $ag): ?>
                    <tr>
                        <td><?= htmlspecialchars($ag['nome_cliente']) ?></td>
                        <td><?= htmlspecialchars($ag['telefone']) ?></td>
                        <td><?= date('d/m/Y', strtotime($ag['data'])) ?></td>
                        <td><?= htmlspecialchars($ag['horario']) ?></td>
                        <td><?= htmlspecialchars($ag['nome_servico']) ?></td>
                        <td><?= htmlspecialchars($ag['status']) ?></td>
                        <td>
                            <a class="btn editar" href="editar_agendamento.php?id=<?= $ag['id'] ?>">✏️</a>
                            <a class="btn excluir" href="excluir_agendamento.php?id=<?= $ag['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">🗑️</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="../index.php" class="voltar">← Voltar</a>
    </div>
</body>
</html>
