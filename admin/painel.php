<?php
require_once '../config/db.php';
?>

<h2>📋 Lista de Agendamentos</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Cliente</th>
        <th>Telefone</th>
        <th>Data</th>
        <th>Horário</th>
        <th>Serviço</th>
    </tr>

    <?php
    $sql = "SELECT a.nome_cliente, a.telefone, a.data, a.horario, s.nome AS nome_servico
            FROM agendamentos a
            JOIN servicos s ON a.id_servico = s.id
            ORDER BY a.data, a.horario";
    $stmt = $pdo->query($sql);
    $agendamentos = $stmt->fetchAll();

    foreach ($agendamentos as $ag) {
        echo "<tr>
                <td>{$ag['nome_cliente']}</td>
                <td>{$ag['telefone']}</td>
                <td>{$ag['data']}</td>
                <td>{$ag['horario']}</td>
                <td>{$ag['nome_servico']}</td>
              </tr>";
    }
    ?>
</table>
