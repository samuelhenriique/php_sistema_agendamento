# # 📅 Sistema de Agendamento em PHP

Este é um sistema simples de agendamento de serviços, desenvolvido em **PHP**, com **MySQL** no backend e design moderno e responsivo com **HTML, CSS e JavaScript**.

## 🚀 Funcionalidades

- 📋 Cadastro de agendamentos com nome, telefone, serviço, data e horário.
- 🗓️ Listagem de agendamentos por data.
- 🔍 Filtro por serviço, status e nome do cliente.
- ✏️ Edição e exclusão de agendamentos.
- ✅ Status do agendamento: Pendente, Confirmado, Cancelado.
- ⏰ Validação de horários disponíveis com intervalo de 40 minutos (das 08:00 às 18:00).
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
├── 📁 css/
│ └── style.css
├── 📁 js/
│ └── script.js
├── 📁 includes/
│ ├── conexao.php
│ └── funcoes.php
├── 📁 pages/
│ └── listar_agendamentos.php
├── agendar.php
├── index.php
├── editar.php
├── excluir.php
└── README.md


## ⚙️ Configuração

1. Clone o repositório:
   ```bash
   git clone https://github.com/samuelhenriique/php_sistema_agendamento.git
   
2. Importe o banco de dados banco.sql no seu MySQL (caso exista).

3.Configure a conexão com o banco em includes/conexao.php:
$conn = new mysqli('localhost', 'usuario', 'senha', 'banco_de_dados');

4. Rode o projeto com um servidor local (ex: XAMPP, WAMP ou PHP embutido):
php -S localhost:8000

📌 Melhorias Futuras
Login e autenticação de administradores

Dashboard com estatísticas

Confirmação automática por e-mail ou WhatsApp

Exportação para Excel/PDF


