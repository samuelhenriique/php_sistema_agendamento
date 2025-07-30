<?php
require_once(__DIR__ . '/config/db.php');

try {
    $stmt = $pdo->query('SELECT * FROM agendamentos ORDER BY id DESC LIMIT 5');
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Últimos agendamentos:\n";
    foreach ($agendamentos as $agendamento) {
        echo 'ID: ' . $agendamento['id'] . ' | Nome: ' . $agendamento['nome_cliente'] . ' | Serviço: ' . $agendamento['servicos'] . "\n";
    }
} catch (PDOException $e) {
    echo 'Erro ao consultar agendamentos: ' . $e->getMessage();
}
