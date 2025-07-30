# # 📅 Sistema de Agendamento em PHP

Este é um sistema simples de agendamento de serviços, desenvolvido em **PHP**, com **MySQL** no backend e design moderno e responsivo com **HTML, CSS e JavaScript**.

## 🚀 Funcionalidades

- 📋 Cadastro de agendamentos com nome, telefone, serviço, data e horário.
- 🗓️ Listagem de agendamentos por data.
- 🔍 Filtro por serviço, status e nome do cliente.
- ✏️ Edição e exclusão de agendamentos.
- ✅ Status do agendamento: Pendente, Confirmado, Cancelado.
- ⏰ Validação de horários disponíveis com intervalo de 60 minutos (das 08:00 às 18:00).
- 📱 Layout responsivo para celular e desktop.

## 💻 Tecnologias Utilizadas

- PHP (puro)
- MySQL
- HTML5 & CSS3
- JavaScript (com validações no cliente)
- Bootstrap (para o layout)
- Font Awesome (ícones)


## 📦 Estrutura do Projeto

📁 agendamento/
├── 📁 admin/
│   ├── cadastrar_servico.php
│   ├── editar_agendamento.php
│   ├── excluir_agendamento.php
│   ├── listar_agendamentos.php
│   └── painel.php
├── 📁 assets/
│   ├── agendamentos.css
│   ├── form.css
│   └── style.css
├── 📁 cliente/
│   ├── agendar.php
│   └── confirmacao.php
├── 📁 config/
│   └── db.php
├── 📁 includes/
│   ├── footer.php
│   └── header.php
├── 📁 servicos/
│   └── cadastrar.php
├── banco.sql
├── index.php
├── script.js
└── README.md


## ⚙️ Configuração

1. Clone o repositório:
   ```bash
   git clone https://github.com/samuelhenriique/php_sistema_agendamento.git
   
2. Importe o banco de dados banco.sql no seu MySQL (caso exista).


3. Configure a conexão com o banco em `config/db.php`:
```php
$conn = new PDO('mysql:host=localhost;dbname=agendamento_db', 'usuario', 'senha');
```


4. Rode o projeto com um servidor local (ex: XAMPP, WAMP ou PHP embutido):
```bash
php -S localhost:8000
```


## 📌 Melhorias Futuras
- Login e autenticação de administradores
- Dashboard com estatísticas
- Confirmação automática por e-mail ou WhatsApp
- Exportação para Excel/PDF

---

# FR Lavação - Sistema de Agendamento

Bem-vindo ao sistema de agendamento online da FR Lavação! Este projeto permite que clientes agendem serviços de lavagem automotiva de forma prática, rápida e moderna.

## Funcionalidades
- Agendamento online de serviços
- Seleção de múltiplos serviços
- Resumo do agendamento em tempo real
- Interface responsiva e moderna
- Confirmação visual e navegação intuitiva

## Telas do Sistema

### Tela Inicial
![Tela Inicial](assets/readme/tela-inicial.png)

### Seleção de Serviços
![Seleção de Serviços](assets/readme/servicos.png)

### Agendamento
![Agendamento](assets/readme/agendamento.png)

### Listagem de Agendamentos (Admin)
![Listagem de Agendamentos](assets/readme/listagem.png)

> **Observação:** As imagens acima são exemplos. Para adicionar suas próprias capturas de tela, salve-as na pasta `assets/readme/` e atualize os nomes dos arquivos conforme necessário.

## Como Executar
1. Clone este repositório
2. Configure o banco de dados MySQL usando o arquivo `banco.sql`
3. Ajuste as configurações de conexão em `config/db.php`
4. Inicie um servidor local (XAMPP, WAMP, etc.) e acesse `index.php`

## Estrutura do Projeto
```
index.php
assets/
  style.css
  form.css
  readme/
    tela-inicial.png
    servicos.png
    agendamento.png
    listagem.png
cliente/
admin/
config/
includes/
servicos/
```

## Licença
Este projeto é de uso livre para fins de estudo e aprimoramento.

---
Desenvolvido por FR Lavação 🚗💦


