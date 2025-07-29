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
        <th>Serviços</th>
    </tr>

    <?php
    $sql = "
        SELECT 
            a.id,
            c.nome AS nome_cliente,
            c.telefone,
            a.data,
            a.horario,
            GROUP_CONCAT(s.nome SEPARATOR ', ') AS nome_servicos
        FROM agendamentos a
        JOIN clientes c ON a.cliente_id = c.id
        LEFT JOIN agendamento_servicos ags ON a.id = ags.agendamento_id
        LEFT JOIN servicos s ON ags.servico_id = s.id
        GROUP BY a.id
        ORDER BY a.data, a.horario
    ";

    $stmt = $pdo->query($sql);
    $agendamentos = $stmt->fetchAll();

    foreach ($agendamentos as $ag) {
        echo "<tr>
                <td>{$ag['nome_cliente']}</td>
                <td>{$ag['telefone']}</td>
                <td>" . date('d/m/Y', strtotime($ag['data'])) . "</td>
                <td>{$ag['horario']}</td>
                <td>{$ag['nome_servicos']}</td>
              </tr>";
    }
    ?>
</table>
