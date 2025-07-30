-- Criação da tabela de agendamentos para o novo fluxo
CREATE TABLE IF NOT EXISTS agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    placa VARCHAR(20),
    data DATE NOT NULL,
    horario VARCHAR(10) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    observacoes TEXT,
    servicos TEXT NOT NULL, -- Armazena os serviços selecionados em formato texto (ex: "Lavagem Simples, Enceramento")
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
