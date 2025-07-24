<?php
require_once '../config/db.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    echo "ID do agendamento não fornecido.";
    exit;
}

$id = $_GET['id'];

// Atualiza se enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = $_POST['nome_cliente'];
    $telefone  = $_POST['telefone'];
    $data      = $_POST['data'];
    $horario   = $_POST['horario'];
    $servico   = $_POST['id_servico'];
    $status    = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE agendamentos SET 
        nome_cliente = :nome, telefone = :telefone, data = :data, horario = :horario, 
        id_servico = :servico, status = :status WHERE id = :id");
    
    $stmt->execute([
        ':nome' => $nome,
        ':telefone' => $telefone,
        ':data' => $data,
        ':horario' => $horario,
        ':servico' => $servico,
        ':status' => $status,
        ':id' => $id
    ]);

    echo "Agendamento atualizado com sucesso. <a href='listar_agendamentos.php'>Voltar</a>";
    exit;
}

// Busca dados atuais do agendamento
$stmt = $pdo->prepare("SELECT * FROM agendamentos WHERE id = ?");
$stmt->execute([$id]);
$agendamento = $stmt->fetch();

if (!$agendamento) {
    echo "Agendamento não encontrado.";
    exit;
}

// Busca serviços para o select
$servicos = $pdo->query("SELECT * FROM servicos")->fetchAll();
?>

<h2>✏️ Editar Agendamento</h2>

<form method="POST">
    Nome: <input type="text" name="nome_cliente" value="<?= htmlspecialchars($agendamento['nome_cliente']) ?>" required><br><br>
    Telefone: <input type="text" name="telefone" value="<?= htmlspecialchars($agendamento['telefone']) ?>" required><br><br>
    Data: <input type="date" name="data" value="<?= $agendamento['data'] ?>" required><br><br>
    Horário: <input type="time" name="horario" value="<?= $agendamento['horario'] ?>" required><br><br>
    Serviço:
    <select name="id_servico" required>
        <?php foreach ($servicos as $s): ?>
            <option value="<?= $s['id'] ?>" <?= $s['id'] == $agendamento['id_servico'] ? 'selected' : '' ?>>
                <?= $s['nome'] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>
    Status:
    <select name="status" required>
        <option value="pendente" <?= $agendamento['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
        <option value="confirmado" <?= $agendamento['status'] === 'confirmado' ? 'selected' : '' ?>>Confirmado</option>
        <option value="cancelado" <?= $agendamento['status'] === 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
    </select><br><br>
    <button type="submit">Salvar alterações</button>
</form>
