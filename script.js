// Menu mobile header
document.addEventListener('DOMContentLoaded', function () {
  var btnMenu = document.querySelector('.menu-mobile-btn');
  var menuMobile = document.getElementById('menuMobile');
  if (btnMenu && menuMobile) {
    btnMenu.addEventListener('click', function () {
      menuMobile.classList.toggle('open');
    });
    // Fecha menu ao clicar em qualquer link
    menuMobile.querySelectorAll('a').forEach(function(link) {
      link.addEventListener('click', function() {
        menuMobile.classList.remove('open');
      });
    });
  }
});
// Scroll suave para seções ao clicar nos botões principais da home
document.addEventListener('DOMContentLoaded', function () {
  // Botão seta para scroll
  var btnSeta = document.querySelector('.btn-seta-scroll');
  if (btnSeta) {
    btnSeta.addEventListener('click', function (e) {
      var destino = document.querySelector('.form-agendamento');
      if (destino) {
        e.preventDefault();
        destino.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  }
  // Botão "Agendar agora"
  var btnAgendar = document.querySelector('.btn-agendar');
  if (btnAgendar) {
    btnAgendar.addEventListener('click', function (e) {
      var destino = document.querySelector('#form-agendamento, .form-agendamento');
      if (destino) {
        e.preventDefault();
        destino.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  }
  // Botão "Conheça nossos serviços"
  var btnServicos = document.querySelector('.btn-servicos');
  if (btnServicos) {
    btnServicos.addEventListener('click', function (e) {
      var destino = document.querySelector('#servicos, .servicos');
      if (destino) {
        e.preventDefault();
        destino.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  }
});
document.addEventListener('DOMContentLoaded', function() {
  // Elementos do DOM
  const form = document.querySelector('.form-agendamento');
  const etapas = document.querySelectorAll('.etapa');
  const botoesAvancar = document.querySelectorAll('.btn-avancar');
  const botoesVoltar = document.querySelectorAll('.btn-voltar');
  const passos = document.querySelectorAll('.passo');
  const checkboxes = document.querySelectorAll('input[name="servicos[]"]');
  
  // Elementos do resumo (etapa 1 e etapa 3)
  const resumoParcialServicos = document.getElementById('resumo-parcial-servicos');
  const resumoParcialDuracao = document.getElementById('resumo-parcial-duracao');
  const resumoParcialTotal = document.getElementById('resumo-parcial-total');
  const resumoServicos = document.getElementById('resumo-servicos');
  const resumoDuracao = document.getElementById('resumo-duracao');
  const resumoTotal = document.getElementById('resumo-total');
  
  let etapaAtual = 1;

  // Inicialização - Mostrar apenas a primeira etapa
  mostrarEtapa(etapaAtual);
  atualizarResumo(); // Atualiza o resumo inicial

  // Event listeners para botões "Próximo"
  botoesAvancar.forEach(botao => {
    botao.addEventListener('click', avancarEtapa);
  });

  // Event listeners para botões "Anterior"
  botoesVoltar.forEach(botao => {
    botao.addEventListener('click', voltarEtapa);
  });

  // Atualizar resumo quando serviços são selecionados
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', atualizarResumo);
  });

  // Função para avançar para próxima etapa
  function avancarEtapa() {
    // Validação antes de avançar
    if (!validarEtapaAtual()) return;
    
    if (etapaAtual < 3) {
      etapaAtual++;
      mostrarEtapa(etapaAtual);
    }
  }

  // Função para voltar para etapa anterior
  function voltarEtapa() {
    if (etapaAtual > 1) {
      etapaAtual--;
      mostrarEtapa(etapaAtual);
    }
  }

  // Função para validar a etapa atual antes de avançar
  function validarEtapaAtual() {
    if (etapaAtual === 1) {
      // Validação para etapa 1 (Serviços)
      const servicosSelecionados = document.querySelectorAll('input[name="servicos[]"]:checked').length;
      if (servicosSelecionados === 0) {
        alert('Por favor, selecione pelo menos um serviço');
        return false;
      }
    } else if (etapaAtual === 2) {
      // Validação para etapa 2 (Dados)
      const camposObrigatorios = document.querySelectorAll('.etapa[data-step="2"] [required]');
      let valido = true;
      
      camposObrigatorios.forEach(campo => {
        if (!campo.value.trim()) {
          campo.style.borderColor = 'red';
          valido = false;
        } else {
          campo.style.borderColor = '';
        }
      });
      
      if (!valido) {
        alert('Por favor, preencha todos os campos obrigatórios');
        return false;
      }
    }
    return true;
  }

  // Função para mostrar etapa específica
  function mostrarEtapa(numeroEtapa) {
    // Esconder todas as etapas
    etapas.forEach(etapa => {
      etapa.classList.remove('etapa-ativa');
    });
    
    // Mostrar etapa atual
    const etapaAtiva = document.querySelector(`.etapa[data-step="${numeroEtapa}"]`);
    if (etapaAtiva) {
      etapaAtiva.classList.add('etapa-ativa');
    }
    
    // Atualizar barra de progresso
    passos.forEach(passo => {
      passo.classList.remove('passo-ativo');
      if (parseInt(passo.dataset.step) <= numeroEtapa) {
        passo.classList.add('passo-ativo');
      }
    });
    
    // Atualizar estado dos botões
    const btnVoltar = etapaAtiva.querySelector('.btn-voltar');
    const btnAvancar = etapaAtiva.querySelector('.btn-avancar');
    
    if (btnVoltar) {
      btnVoltar.disabled = (numeroEtapa === 1);
    }
    
    if (btnAvancar) {
      if (numeroEtapa === 3) {
        btnAvancar.textContent = 'Finalizar';
        btnAvancar.classList.add('btn-finalizar');
        btnAvancar.classList.remove('btn-avancar');
      } else {
        btnAvancar.textContent = 'Próximo';
        btnAvancar.classList.add('btn-avancar');
        btnAvancar.classList.remove('btn-finalizar');
      }
    }
  }

  // Função para atualizar resumo em todas as etapas
  function atualizarResumo() {
    let servicosSelecionados = 0;
    let duracaoTotal = 0;
    let valorTotal = 0;
    let servicosNomes = [];
    
    checkboxes.forEach(checkbox => {
      if (checkbox.checked) {
        servicosSelecionados++;
        // Soma duração
        const duracao = parseInt(checkbox.dataset.duracao);
        if (!isNaN(duracao)) duracaoTotal += duracao;
        // Soma valor usando data-preco
        let valor = 0;
        if (checkbox.dataset.preco) {
          valor = parseFloat(checkbox.dataset.preco.replace(',', '.'));
        }
        if (!isNaN(valor)) valorTotal += valor;
        // Obtém o nome do serviço do elemento h4 dentro do card
        const nomeServico = checkbox.closest('.servico-card').querySelector('h4').textContent;
        servicosNomes.push(nomeServico);
      }
    });
    
    // Atualiza o resumo da primeira etapa (parcial)
    if (resumoParcialServicos) {
      resumoParcialServicos.textContent = servicosSelecionados > 0 
        ? servicosNomes.join(', ') 
        : 'Nenhum selecionado';
    }
    if (resumoParcialDuracao) {
      resumoParcialDuracao.textContent = `${duracaoTotal} min`;
    }
    if (resumoParcialTotal) {
      resumoParcialTotal.textContent = `R$ ${valorTotal.toFixed(2).replace('.', ',')}`;
    }
    
    // Atualiza o resumo da terceira etapa (completo)
    if (resumoServicos) {
      resumoServicos.textContent = servicosSelecionados > 0 
        ? servicosNomes.join(', ') 
        : 'Nenhum serviço selecionado';
    }
    if (resumoDuracao) {
      resumoDuracao.textContent = `${duracaoTotal} min`;
    }
    if (resumoTotal) {
      resumoTotal.textContent = `R$ ${valorTotal.toFixed(2).replace('.', ',')}`;
    }
  }

  // Prevenir envio do formulário (para demonstração)
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      // Coletar dados do formulário
      const nome = form.querySelector('input[name="nome_cliente"]').value;
      const telefone = form.querySelector('input[name="telefone"]').value;
      const email = form.querySelector('input[name="email"]').value;
      const modelo = form.querySelector('input[name="modelo"]').value;
      const placa = form.querySelector('input[name="placa"]').value;
      const data = form.querySelector('input[name="data"]').value;
      const horario = form.querySelector('select[name="horario"]').value;
      const endereco = form.querySelector('input[name="endereco"]').value;
      const observacoes = form.querySelector('textarea[name="observacoes"]').value || 'Nenhuma';

      // Serviços
      let servicosNomes = [];
      let valorTotal = 0;
      let duracaoTotal = 0;
      checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
          const nomeServico = checkbox.closest('.servico-card').querySelector('h4').textContent;
          servicosNomes.push(nomeServico);
          // Pega o valor do serviço do atributo data-preco (corrigido)
          let valor = 0;
          if (checkbox.dataset.preco) {
            valor = parseFloat(checkbox.dataset.preco.replace(',', '.'));
          }
          const duracao = parseInt(checkbox.dataset.duracao);
          if (!isNaN(valor)) valorTotal += valor;
          if (!isNaN(duracao)) duracaoTotal += duracao;
        }
      });

      // Montar mensagem
      let mensagem = '*Novo Agendamento - FR Lavação* ✅%0A%0A';
      mensagem += ' *Cliente:* ' + nome + '  %0A';
      mensagem += ' *Telefone:* ' + telefone + '  %0A';
      mensagem += ' *Email:* ' + email + '  %0A%0A';
      mensagem += ' *Veículo:* ' + modelo + '  %0A';
      mensagem += ' *Placa:* ' + placa + '  %0A%0A';
      mensagem += ' *Serviços:* ' + servicosNomes.join(', ') + '  %0A';
      mensagem += ' *Valor Total:* R$ ' + valorTotal.toFixed(2).replace('.', ',') + '  %0A';
      mensagem += ' *Duração Estimada:* ' + duracaoTotal + ' min  %0A%0A';
      mensagem += ' *Data:* ' + (data ? data.split('-').reverse().join('/') : '') + '  %0A';
      mensagem += ' *Horário:* ' + horario + '  %0A%0A';
      mensagem += ' *Endereço:* ' + endereco + '  %0A';
      mensagem += ' *Observações:* ' + observacoes;

      // Número do WhatsApp (coloque o número desejado no formato 55DDDNUMERO)
      const numeroWhatsapp = '5548999753367';
      const url = 'https://wa.me/' + numeroWhatsapp + '?text=' + mensagem;

      // Abre o WhatsApp e aguarda interação do usuário
      window.open(url, '_blank');

      // Aguarda o usuário voltar para a aba e então envia o formulário e mostra o alerta
      let enviado = false;
      function aoVoltarParaAba() {
        if (!enviado) {
          enviado = true;
          window.removeEventListener('focus', aoVoltarParaAba);
          // Envia o formulário normalmente para o backend
          form.submit();
          // Exibe mensagem de sucesso
          setTimeout(function() {
            alert('Agendamento realizado com sucesso!');
          }, 300);
        }
      }
      window.addEventListener('focus', aoVoltarParaAba);
    });
  }
});