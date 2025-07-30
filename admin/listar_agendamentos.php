<?php
require_once '../config/db.php';

$filtro_data = $_GET['data'] ?? '';
$filtro_status = $_GET['status'] ?? '';


$sql = "SELECT id, nome_cliente, telefone, email, modelo, placa, data, horario, endereco, observacoes, servicos, criado_em FROM agendamentos WHERE 1";

$params = [];


if ($filtro_data) {
    $sql .= " AND data = :data";
    $params[':data'] = $filtro_data;
}

$sql .= " ORDER BY data, horario";


$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$agendamentos = $stmt->fetchAll();

?>
<link rel="stylesheet" href="../assets/style.css">
<link rel="stylesheet" href="../assets/form.css">
<link rel="stylesheet" href="../assets/agendamentos.css">

<style>
.chip-servico {
  display: inline-block;
  background: #e3f2fd;
  color: #1976d2;
  font-size: 0.95em;
  font-weight: 500;
  border-radius: 16px;
  padding: 3px 12px;
  margin: 2px 2px 2px 0;
  box-shadow: 0 1px 2px rgba(25,118,210,0.07);
  letter-spacing: 0.01em;
}
.avatar-nome {
  display: flex;
  align-items: center;
  gap: 10px;
}
.avatar-nome .avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: linear-gradient(135deg, #1976d2 60%, #64b5f6 100%);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  font-size: 1.1em;
  box-shadow: 0 1px 4px rgba(25,118,210,0.10);
}
.tabela-agendamentos-simples th {
  letter-spacing: 0.02em;
}
.tabela-agendamentos-simples td {
  font-size: 1.01em;
}
.tabela-agendamentos-simples tr {
  transition: box-shadow 0.2s;
}
.tabela-agendamentos-simples tr:hover {
  box-shadow: 0 2px 12px rgba(25,118,210,0.08);
  background: #f0f4fa;
}
body {
  background: #f6f7fb;
  margin: 0;
  font-family: 'Segoe UI', Arial, sans-serif;
}
.tabela-agendamentos-simples {
  margin: 40px auto 0 auto;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 12px rgba(0,0,0,0.10);
  width: 95%;
  max-width: 1200px;
  padding: 0;
  overflow: hidden;
}
.tabela-agendamentos-simples h2 {
  color: #222;
  margin: 0;
  padding: 24px 0 16px 0;
  font-size: 2rem;
  background: #f6f7fb;
  border-bottom: 1px solid #e0e0e0;
  text-align: center;
}
.tabela-scroll {
  max-height: 480px;
  overflow-y: auto;
  overflow-x: auto;
}
.tabela-agendamentos-simples table {
  width: 100%;
  border-collapse: collapse;
  min-width: 900px;
}
.tabela-agendamentos-simples th, .tabela-agendamentos-simples td {
  padding: 10px 8px;
  border-bottom: 1px solid #f0f0f0;
  color: #222;
  background: #fff;
}
.tabela-agendamentos-simples th {
  background: #f6f7fb;
  color: #1976d2;
  font-weight: 600;
  position: sticky;
  top: 0;
  z-index: 2;
  border-bottom: 2px solid #e0e0e0;
  font-size: 1rem;
}
.tabela-agendamentos-simples tr:hover td {
  background: #f0f4fa;
}
.tabela-agendamentos-simples td.data {
  color: #388e3c;
  font-weight: 500;
}
.tabela-agendamentos-simples td.horario {
  color: #f57c00;
  font-weight: 500;
}
.tabela-agendamentos-simples td.servicos {
  color: #1976d2;
  font-weight: 500;
}
.voltar-btn {
  display: inline-block;
  margin: 24px auto 0 auto;
  background: #1976d2;
  color: #fff;
  border-radius: 4px;
  padding: 10px 24px;
  text-decoration: none;
  font-weight: bold;
  box-shadow: 0 2px 8px rgba(25,118,210,0.10);
  transition: background 0.2s, color 0.2s;
  border: none;
}
.voltar-btn:hover {
  background: #1251a3;
  color: #fff;
}
</style>

<div class="tabela-agendamentos-simples">
  <h2>Lista de Agendamentos</h2>
  <div class="tabela-scroll">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Telefone</th>
          <th>Email</th>
          <th>Modelo</th>
          <th>Placa</th>
          <th>Data</th>
          <th>Horário</th>
          <th>Endereço</th>
          <th>Serviços</th>
          <th>Observações</th>
          <th>Criado em</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($agendamentos) === 0): ?>
          <tr><td colspan="12">Nenhum agendamento encontrado.</td></tr>
        <?php else: ?>
          <?php foreach ($agendamentos as $ag): ?>
            <tr>
              <td><?= $ag['id'] ?></td>
              <td>
                <div class="avatar-nome">
                  <span class="avatar"><?= strtoupper(mb_substr($ag['nome_cliente'] ?? '?', 0, 1, 'UTF-8')) ?></span>
                  <span><?= htmlspecialchars($ag['nome_cliente'] ?? '') ?></span>
                </div>
              </td>
              <td><?= htmlspecialchars($ag['telefone'] ?? '') ?></td>
              <td><?= htmlspecialchars($ag['email'] ?? '') ?></td>
              <td><?= htmlspecialchars($ag['modelo'] ?? '') ?></td>
              <td><?= htmlspecialchars($ag['placa'] ?? '') ?></td>
              <td class="data" data-label="Data"><?= htmlspecialchars($ag['data'] ?? '') ?></td>
              <td class="horario" data-label="Horário"><?= htmlspecialchars($ag['horario'] ?? '') ?></td>
              <td data-label="Endereço"><?= htmlspecialchars($ag['endereco'] ?? '') ?></td>
              <td class="servicos" data-label="Serviços">
                <?php 
                  $servicos = array_map('trim', explode(',', $ag['servicos'] ?? ''));
                  foreach ($servicos as $servico) {
                    if ($servico) {
                      echo '<span class="chip-servico">' . htmlspecialchars($servico) . '</span>';
                    }
                  }
                ?>
              </td>
              <td><?= nl2br(htmlspecialchars($ag['observacoes'] ?? '')) ?></td>
              <td><?= htmlspecialchars($ag['criado_em'] ?? '') ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <div style="text-align:center;">
    <a href="../index.php" class="voltar-btn">← Voltar para Home</a>
  </div>
</div>

