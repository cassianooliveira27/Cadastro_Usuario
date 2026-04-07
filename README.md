Sistema de Cadastro de Usuários

Este projeto consiste em um sistema simples de cadastro de usuários, desenvolvido com HTML, CSS e PHP, com validações no front-end e no back-end, e integração com banco de dados MySQL. O sistema permite cadastrar usuários com os seguintes dados: nome, email, senha e uma mensagem opcional. As senhas são criptografadas utilizando a função password_hash, garantindo maior segurança.

Funcionalidades
Cadastro de usuários com nome, email, senha e mensagem opcional.
Validações no front-end (HTML e JavaScript) e no back-end (PHP).
Senhas armazenadas de forma segura utilizando hash.
Exibição de mensagens de erro ou sucesso após o envio do formulário.
Tecnologias Utilizadas
HTML5
CSS3
PHP
JavaScript
MySQL
Estrutura do Projeto

O projeto possui a seguinte organização:

Cadastro_Usuario/
├── cadastro.php - Processamento e validação dos dados
├── conexao.php - Arquivo de conexão com PDO
├── index.html - Formulário de cadastro
├── css/
│ └── styles.css - Estilos da aplicação
└── js/
└── script.js - Função para mostrar/ocultar senha

Como Executar o Projeto
Instale um servidor local como XAMPP, WAMP ou Laragon.
Acesse o phpMyAdmin e execute o script SQL abaixo para criar o banco de dados e a tabela:

CREATE DATABASE IF NOT EXISTS cadastro_db;
USE cadastro_db;

CREATE TABLE IF NOT EXISTS usuarios (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100),
email VARCHAR(100),
senha VARCHAR(255),
mensagem TEXT
);

Coloque a pasta do projeto dentro do diretório htdocs (ou equivalente) do seu servidor local.
Inicie os serviços Apache e MySQL.
Acesse o projeto pelo navegador em: http://localhost/Cadastro_Usuario/
Validações Implementadas

Front-end:

Nome com no mínimo 3 caracteres.
Email obrigatório e apenas do domínio Gmail.
Senha com no mínimo 6 caracteres.
Mensagem com até 250 caracteres.

Back-end:

Sanitização de dados com htmlspecialchars.
Validação do formato de email com expressão regular.
Verificação do tamanho dos campos.
Criptografia da senha com password_hash.
Observações
O sistema aceita apenas endereços de email do domínio Gmail.
Este projeto é indicado para fins educacionais, estudo e prática de integração entre front-end e back-end.
Autores
Cassiano e Joaquim
