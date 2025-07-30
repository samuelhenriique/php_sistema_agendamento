<?php
require_once(__DIR__ . '/../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome_cliente'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $email = $_POST['email'] ?? '';
    $modelo = $_POST['modelo'] ?? '';
    $placa = $_POST['placa'] ?? '';
    $data = $_POST['data'] ?? '';
    $horario = $_POST['horario'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';

    // Receber múltiplos serviços (checkbox)
    $servicosSelecionados = isset($_POST['servicos']) ? $_POST['servicos'] : [];
    $nomesServicos = [];
    if (!empty($servicosSelecionados) && is_array($servicosSelecionados)) {
        // Buscar os nomes dos serviços selecionados
        $placeholders = implode(',', array_fill(0, count($servicosSelecionados), '?'));
        $stmtServicos = $pdo->prepare("SELECT nome FROM servicos WHERE id IN ($placeholders)");
        foreach ($servicosSelecionados as $k => $v) {
            $servicosSelecionados[$k] = (int)$v;
        }
        $stmtServicos->execute($servicosSelecionados);
        $nomes = $stmtServicos->fetchAll(PDO::FETCH_COLUMN);
        if ($nomes) {
            $nomesServicos = $nomes;
        }
    }
    $nome_servico = implode(', ', $nomesServicos);

    try {
        $sql = "INSERT INTO agendamentos (nome_cliente, telefone, email, modelo, placa, data, horario, endereco, observacoes, servicos) VALUES (:nome_cliente, :telefone, :email, :modelo, :placa, :data, :horario, :endereco, :observacoes, :servicos)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome_cliente' => $nome,
            ':telefone' => $telefone,
            ':email' => $email,
            ':modelo' => $modelo,
            ':placa' => $placa,
            ':data' => $data,
            ':horario' => $horario,
            ':endereco' => $endereco,
            ':observacoes' => $observacoes,
            ':servicos' => $nome_servico
        ]);
        // Exibe pop-up de sucesso
        echo '<script>alert("Agendamento realizado com sucesso!"); window.location.href = "../index.php";</script>';
        exit;
    } catch (PDOException $e) {
        echo '<div class="msg error">Erro ao salvar agendamento: ' . htmlspecialchars($e->getMessage()) . '</div>';
        echo '<a href="../index.php">Voltar</a>';
    }
    exit;
}
?>

<link rel="stylesheet" href="../assets/form.css">

<div class="form-container">
    <h2>Agende seu horário</h2>
    <form method="POST" novalidate>
        <label>Nome</label>
        <div class="input-icon">
            <input type="text" name="nome_cliente" required>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zM12 14c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/></svg>
        </div>

        <label>Telefone</label>
        <div class="input-icon">
            <input type="tel" name="telefone" required>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.6 10.8c1.2 2.3 3.2 4.3 5.5 5.5l1.4-1.4c0.2-0.2 0.5-0.3 0.8-0.2 1 0.3 2 0.5 3.1 0.5 0.5 0 0.9 0.4 0.9 0.9v3.6c0 0.5-0.4 0.9-0.9 0.9-8.3 0-15-6.7-15-15 0-0.5 0.4-0.9 0.9-0.9h3.6c0.5 0 0.9 0.4 0.9 0.9 0 1 0.2 2.1 0.5 3.1 0.1 0.3 0 0.6-0.2 0.8l-1.4 1.4z"/></svg>
        </div>

        <label>Data</label>
        <div class="input-icon">
            <input type="date" name="data" min="<?= date('Y-m-d') ?>" required>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H5V9h14v9z"/></svg>
        </div>

        <label>Hora</label>
        <div class="input-icon">
            <select name="horario" required>
                <?php
                $inicio = strtotime('08:00');
                $fim = strtotime('18:00');

                while ($inicio <= $fim) {
                    $hora = date('H:i', $inicio);
                    echo "<option value='$hora'>$hora</option>";
                    $inicio = strtotime('+40 minutes', $inicio);
                }
                ?>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5H7z"/></svg>
        </div>

        <label>Serviço</label>
        <div class="input-icon">
            <select name="id_servico" required>
                <?php
                try {
                    $servicos = $pdo->query("SELECT * FROM servicos")->fetchAll();
                    foreach ($servicos as $servico) {
                        $nome = htmlspecialchars($servico['nome']);
                        $preco = number_format($servico['preco'], 2, ',', '.');
                        echo "<option value='{$servico['id']}'>{$nome} - R$ {$preco}</option>";
                    }
                } catch (PDOException $e) {
                    echo "<option disabled>Erro ao carregar serviços</option>";
                }
                ?>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5H7z"/></svg>
        </div>

        <button type="submit">Agendar</button>

        <a href="../index.php" class="voltar">← Voltar</a>
    </form>
</div>
