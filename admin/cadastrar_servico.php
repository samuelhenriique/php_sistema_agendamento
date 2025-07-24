<?php
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = $_POST['preco'];

    try {
        $sql = "INSERT INTO servicos (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':preco' => $preco
        ]);
        echo "<div class='msg success'>✅ Serviço cadastrado com sucesso!</div>";
    } catch (PDOException $e) {
        echo "<div class='msg error'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
    }
}
?>

<link rel="stylesheet" href="../assets/form.css">

<div class="form-container">
    <h2>Cadastrar Serviço</h2>
    <form method="POST" novalidate>
        <label>Nome do Serviço</label>
        <div class="input-icon">
            <input type="text" name="nome" required>
            <!-- Ícone tag -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 12v-2h-8V4H6v8H4v4h8v8h4v-8h8v-4h-8z"/></svg>
        </div>

        <label>Descrição</label>
        <textarea name="descricao" rows="4" style="width:100%; padding:10px; border-radius:10px; border:1px solid #ccc; resize: vertical;"></textarea>

        <label>Preço (R$)</label>
        <div class="input-icon">
            <input type="number" step="0.01" min="0" name="preco" required>
            <!-- Ícone dinheiro -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 1C6.5 1 2 5.5 2 11s4.5 10 10 10 10-4.5 10-10S17.5 1 12 1zm1 15h-2v-2h2v2zm0-4h-2V7h2v5z"/></svg>
        </div>

        <button type="submit">Cadastrar</button>
    </form>
</div>
