document.addEventListener('DOMContentLoaded', function() {
  // Elementos do DOM
  const form = document.querySelector('.form-agendamento');
  const etapas = document.querySelectorAll('.etapa');
  const botoesAvancar = document.querySelectorAll('.btn-avancar');
  const botoesVoltar = document.querySelectorAll('.btn-voltar');
  const passos = document.querySelectorAll('.passo');
  const checkboxes = document.querySelectorAll('input[name="servicos"]');
  
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
      const servicosSelecionados = document.querySelectorAll('input[name="servicos"]:checked').length;
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
        duracaoTotal += parseInt(checkbox.dataset.duracao);
        valorTotal += parseFloat(checkbox.value);
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
      
      // Validação final
      const data = document.querySelector('input[name="data"]');
      const horario = document.querySelector('select[name="horario"]');
      
      if (!data.value || !horario.value) {
        alert('Por favor, selecione uma data e horário');
        return;
      }
      
      // Monta mensagem de confirmação
      let mensagem = 'Agendamento realizado com sucesso!\n\n';
      mensagem += 'Serviços: ' + (resumoServicos ? resumoServicos.textContent : '') + '\n';
      mensagem += 'Duração estimada: ' + (resumoDuracao ? resumoDuracao.textContent : '') + '\n';
      mensagem += 'Valor total: ' + (resumoTotal ? resumoTotal.textContent : '');
      
      alert(mensagem);
      
      // Aqui você pode adicionar o código para enviar os dados do formulário
      // form.submit(); // Descomente para enviar o formulário
      
      // Opcional: Resetar o formulário após envio
      // form.reset();
      // etapaAtual = 1;
      // mostrarEtapa(etapaAtual);
      // atualizarResumo();
    });
  }
});