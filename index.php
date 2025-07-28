<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lavacar - Sistema de Agendamento</title>
  <link rel="stylesheet" href="assets/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
  <!-- Tela Principal -->
  <main class="tela-central">

    <h1>Bem-vindo à FR Lavação!</h1>

    <p>Sua plataforma prática para agendar a lavagem do seu carro com rapidez e conforto.</p>

    <div class="botoes-home">
      <a href="#agendar" class="btn-agendar">Agendar Agora</a>
      <a href="#servicos" class="btn-servicos">Conheça os Serviços</a>
    </div>

  </main>
  <!-- Tela Principal -->

  <!-- Seção de Serviços -->
  <section id="servicos" class="servicos">
    <h2 class="titulo-servicos">Nossos Serviços</h2>
    <div class="cards-servicos">

      <div class="card-servico">
        <div class="icone">🚿</div>
        <h3>Lavagem Simples</h3>
        <p>Lavagem externa com jato de pressão, sabão neutro e secagem rápida.</p>
        <button class="preco" disabled>R$ 30,00</button>
      </div>

      <div class="card-servico">
        <div class="icone">🧽</div>
        <h3>Lavagem Completa</h3>
        <p>Interior e exterior, incluindo bancos, painéis e aspiração.</p>
        <button class="preco" disabled>R$ 50,00</button>
      </div>

      <div class="card-servico">
        <div class="icone">🪑</div>
        <h3>Higienização Interna</h3>
        <p>Limpeza profunda dos estofados, carpetes e ar-condicionado.</p>
        <button class="preco" disabled>R$ 80,00</button>
      </div>

      <div class="card-servico">
        <div class="icone">🛞</div>
        <h3>Limpeza de Rodas</h3>
        <p>Remoção de sujeira e graxa das rodas, deixando com brilho renovado.</p>
        <button class="preco" disabled>R$ 25,00</button>
      </div>

      <div class="card-servico">
        <div class="icone">🧴</div>
        <h3>Enceramento</h3>
        <p>Proteção e brilho duradouro com cera automotiva de alta qualidade.</p>
        <button class="preco" disabled>R$ 60,00</button>
      </div>

      <div class="card-servico">
        <div class="icone">🫧</div>
        <h3>Lavagem de Motor</h3>
        <p>Limpeza cuidadosa do compartimento do motor, com segurança e eficiência.</p>
        <button class="preco" disabled>R$ 40,00</button>
      </div>

    </div>
  </section>
    <!-- Seção de Serviços -->

  <!-- Seção Por Que Escolher -->
<section class="porque-escolher">

  <h2>Nossos Diferenciais</h2>

  <div class="diferenciais">
    <div class="diferencial-item">
      <div class="icon-circle">
        <i class='bx bx-calendar-check'></i>
      </div>

      <strong>Agendamento Fácil</strong>

      <p>Sistema online prático e intuitivo para marcar seu horário</p>
    </div>

    <div class="diferencial-item">
      <div class="icon-circle">
        <i class='bx bx-leaf'></i>
      </div>

      <strong>Produtos Ecológicos</strong>

      <p>Utilizamos apenas produtos biodegradáveis e seguros</p>

    </div>

    <div class="diferencial-item">
      <div class="icon-circle">
        <i class='bx bx-user-circle'></i>
      </div>

      <strong>Atendimento Personalizado</strong>
      <p>Cada cliente recebe atenção especial e cuidado individual</p>
    </div>
  </div>
</section>
  <!-- Seção Por Que Escolher -->

  <!-- Tela de Agendamento -->
<section id="agendar" class="agendamento container">
  <h2>Agendar Serviço</h2>
  <p class="subtitulo">Complete o agendamento em poucos passos</p>

  <!-- Barra de Progresso -->
  <div class="progresso">
    <div class="passo passo-ativo" data-step="1">
      <div class="circulo">1</div>
      <span>Serviços</span>
    </div>
    <div class="linha"></div>
    <div class="passo" data-step="2">
      <div class="circulo">2</div>
      <span>Dados</span>
    </div>
    <div class="linha"></div>
    <div class="passo" data-step="3">
      <div class="circulo">3</div>
      <span>Agendamento</span>
    </div>
  </div>

  <!-- Formulário de Agendamento -->
  <form class="form-agendamento">
    <!-- Etapa 1 - Serviços -->
    <div class="etapa etapa-ativa" data-step="1">
      <h3 class="titulo-servicos">Escolha os Serviços</h3>

      <div class="servicos-lista">
        <!-- Linha 1 -->
        <div class="servicos-linha">
          <!-- Lavagem Simples -->
          <label class="servico-card">
            <input type="checkbox" name="servicos" value="30" data-duracao="30">
            <div class="servico-conteudo">
              <h4>Lavagem Simples</h4>
              <p>Lavagem externa com jato de pressão</p>
              <div class="servico-info">
                <span class="duracao">30 min</span>
                <span class="preco">R$ 30</span>
              </div>
            </div>
          </label>

          <!-- Lavagem Completa -->
          <label class="servico-card">
            <input type="checkbox" name="servicos" value="50" data-duracao="60">
            <div class="servico-conteudo">
              <h4>Lavagem Completa</h4>
              <p>Interior e exterior completo</p>
              <div class="servico-info">
                <span class="duracao">60 min</span>
                <span class="preco">R$ 50</span>
              </div>
            </div>
          </label>
        </div>

        <!-- Linha 2 -->
        <div class="servicos-linha">
          <!-- Higienização Interna -->
          <label class="servico-card">
            <input type="checkbox" name="servicos" value="80" data-duracao="90">
            <div class="servico-conteudo">
              <h4>Higienização Interna</h4>
              <p>Limpeza profunda dos estofados</p>
              <div class="servico-info">
                <span class="duracao">90 min</span>
                <span class="preco">R$ 80</span>
              </div>
            </div>
          </label>

          <!-- Limpeza de Rodas -->
          <label class="servico-card">
            <input type="checkbox" name="servicos" value="25" data-duracao="20">
            <div class="servico-conteudo">
              <h4>Limpeza de Rodas</h4>
              <p>Remoção de sujeira das rodas</p>
              <div class="servico-info">
                <span class="duracao">20 min</span>
                <span class="preco">R$ 25</span>
              </div>
            </div>
          </label>
        </div>

        <!-- Linha 3 -->
        <div class="servicos-linha">
          <!-- Enceramento -->
          <label class="servico-card">
            <input type="checkbox" name="servicos" value="60" data-duracao="45">
            <div class="servico-conteudo">
              <h4>Enceramento</h4>
              <p>Proteção e brilho duradouro</p>
              <div class="servico-info">
                <span class="duracao">45 min</span>
                <span class="preco">R$ 60</span>
              </div>
            </div>
          </label>

          <!-- Lavagem de Motor -->
          <label class="servico-card">
            <input type="checkbox" name="servicos" value="40" data-duracao="30">
            <div class="servico-conteudo">
              <h4>Lavagem de Motor</h4>
              <p>Limpeza do compartimento do motor</p>
              <div class="servico-info">
                <span class="duracao">30 min</span>
                <span class="preco">R$ 40</span>
              </div>
            </div>
          </label>
        </div>
      </div>

      <!-- Resumo dos Serviços Selecionados -->
      <div class="resumo-simples">
        <h4>Resumo do Agendamento</h4>
        <div class="resumo-linha">
          <span>Serviços:</span>
          <strong id="resumo-parcial-servicos">Nenhum selecionado</strong>
        </div>
        <div class="resumo-linha">
          <span>Tempo estimado:</span>
          <strong id="resumo-parcial-duracao">0 min</strong>
        </div>
        <div class="resumo-linha">
          <span>Valor total:</span>
          <strong id="resumo-parcial-total">R$ 0,00</strong>
        </div>
      </div>

      <div class="botoes-navegacao">
        <button type="button" class="btn-voltar" disabled>Anterior</button>
        <button type="button" class="btn-avancar">Próximo</button>
      </div>
    </div>

    <!-- Etapa 2 - Dados -->
    <div class="etapa" data-step="2">
      <h3>Seus Dados</h3>

      <div class="dados-grid">
        <label>
          Nome Completo *
          <input type="text" name="nome" placeholder="Seu nome completo" required />
        </label>

        <label>
          Telefone *
          <input type="tel" name="telefone" placeholder="(11) 99999-9999" required />
        </label>

        <label>
          Email *
          <input type="email" name="email" placeholder="seu@email.com" required />
        </label>

        <label>
          Modelo do Carro *
          <input type="text" name="modelo" placeholder="Ex: Honda Civic 2020" required />
        </label>

        <label>
          Placa do Veículo
          <input type="text" name="placa" placeholder="ABC-1234" />
        </label>
      </div>

      <div class="botoes-navegacao">
        <button type="button" class="btn-voltar" disabled>Anterior</button>
        <button type="button" class="btn-avancar" id="avancarParaDados">Próximo</button>
      </div>
    </div>

    <!-- Etapa 3 - Agendamento -->
    <!-- Etapa 3 - Data/Horário e Finalização -->
    <div class="etapa etapa-agendamento" data-step="3">
      <h3>Data e Horário</h3>
      
      <div class="agendamento-grid">
        <div class="agendamento-group">
          <label>
            <strong>Data *</strong>
            <input type="date" name="data" required class="input-data" />
          </label>
        </div>
        
        <div class="agendamento-group">
          <label>
            <strong>Horário *</strong>
            <select name="horario" required class="input-horario">
              <option value="" disabled selected>Selecione um horário</option>
              <option value="08:00">08:00</option>
              <option value="09:00">09:00</option>
              <option value="10:00">10:00</option>
              <!-- Mais horários podem ser adicionados aqui -->
            </select>
          </label>
        </div>
      </div>
      
      <div class="agendamento-group endereco-group">
        <label>
          <strong>Endereço para Atendimento *</strong>
          <input 
            type="text" 
            name="endereco" 
            placeholder="Rua, número, bairro, cidade" 
            required 
            class="input-endereco" 
          />
        </label>
      </div>
      
      <div class="agendamento-group">
        <label>
          <strong>Observações:</strong>
          <textarea 
            name="observacoes" 
            placeholder="Informações adicionais sobre o serviço..." 
            class="input-observacoes"
          ></textarea>
        </label>
      </div>
      
      <div class="resumo-final">
        <h4>Resumo do Agendamento</h4>
        <div class="resumo-linha">
          <span>Serviços:</span>
          <span id="resumo-servicos">1 selecionado(s)</span>
        </div>
        <div class="resumo-linha">
          <span>Duração estimada:</span>
          <span id="resumo-duracao">30 minutos</span>
        </div>
        <div class="resumo-linha total">
          <span>Total:</span>
          <strong id="resumo-total">R$ 30,00</strong>
        </div>
      </div>
      
      <div class="botoes-finalizar">
        <button type="button" class="btn-voltar">Anterior</button>
        <button type="submit" class="btn-finalizar">Finalizar Agendamento</button>
      </div>
    </div>
  </form>
</section>
  <!-- Tela de Agendamento -->  

  <div class="menu">
    <a href="cliente/agendar.php">📅 Agendar Serviço</a>
    <a href="admin/listar_agendamentos.php">📋 Listar Agendamentos</a>
    <a href="admin/cadastrar_servico.php">➕ Cadastrar Serviço</a>
    <a href="admin/listar_servicos.php">🛠️ Gerenciar Serviços</a>
  </div>

  <script src="script.js"></script>
</body>
</html>
<!-- Comentário de teste para novo commit -->
