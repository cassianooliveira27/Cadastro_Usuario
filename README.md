Sistema de Cadastro de Usuário

Este documento descreve um sistema simples de cadastro de usuários, desenvolvido com HTML, CSS e PHP, com validações no front-end e no back-end e integração com banco de dados MySQL.

Funcionalidades

O sistema permite o cadastro de usuários contendo os seguintes dados: nome, email, senha e uma mensagem opcional. Possui validações no formulário (front-end) e também no servidor (back-end). As senhas são criptografadas utilizando a função password_hash e os dados são armazenados em um banco de dados MySQL.

Tecnologias Utilizadas

O projeto foi desenvolvido utilizando as seguintes tecnologias: HTML5, CSS3, PHP e MySQL.

Estrutura do Projeto

O projeto está organizado da seguinte forma: uma pasta principal chamada Cadastro_Usuario, contendo o arquivo index.html responsável pelo formulário, o arquivo cadastro.php que realiza o processamento e validação dos dados, e uma pasta css contendo o arquivo styles.css para a estilização da aplicação.

Como Executar o Projeto

Primeiramente, é necessário instalar um servidor local como XAMPP, WAMP ou Laragon. Em seguida, deve-se acessar o phpMyAdmin e executar o script SQL para criar o banco de dados e a tabela de usuários. Após isso, a pasta do projeto deve ser colocada dentro do diretório htdocs do servidor local. Por fim, basta iniciar os serviços Apache e MySQL e acessar o projeto pelo navegador através do endereço http://localhost/Cadastro_Usuario/
.

Script SQL

CREATE DATABASE cadastro_db;

USE cadastro_db;

CREATE TABLE usuarios (
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100),
email VARCHAR(100),
senha VARCHAR(255),
mensagem TEXT
);

Validações Implementadas

No front-end, o sistema valida se o nome possui no mínimo 3 caracteres, se o email é obrigatório e pertence ao domínio Gmail, se a senha possui no mínimo 6 caracteres e se a mensagem respeita o limite de 250 caracteres. No back-end, é realizada a sanitização dos dados com a função htmlspecialchars, validação do formato do email com expressão regular, verificação do tamanho dos campos e criptografia da senha.

Possíveis Melhorias

Como melhorias futuras, podem ser implementados um sistema de login, controle de sessões, melhorias na interface visual, aumento da responsividade e integração com frameworks modernos.

Observações

O sistema aceita apenas endereços de email do domínio Gmail. As senhas são armazenadas de forma segura utilizando hash. Este projeto é indicado para fins educacionais e para prática de integração entre front-end e back-end.

Autores

Desenvolvido pelos alunos Cassiano e Joaquim.
