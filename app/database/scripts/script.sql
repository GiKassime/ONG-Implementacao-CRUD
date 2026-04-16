-- Garante a criação e uso do banco
CREATE DATABASE IF NOT EXISTS db_caonectados;
USE db_caonectados;

-- 1. Criação da tabela Pai (Comum a todos)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(150) NOT NULL UNIQUE,
    cep VARCHAR(10)
);

-- 2. Criação da tabela Filha (Específica da ONG)
CREATE TABLE IF NOT EXISTS ongs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    cnpj VARCHAR(18) NOT NULL UNIQUE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- 3. Inserindo dados fictícios para testes

-- ONG 1: Amigos dos Pets
INSERT INTO usuarios (nome, telefone, email, cep) 
VALUES ('ONG Amigos dos Pets', '11999998888', 'contato@amigospets.org', '01001-000');
-- LAST_INSERT_ID() pega automaticamente o ID do usuário criado na linha de cima!
INSERT INTO ongs (usuario_id, cnpj) VALUES (LAST_INSERT_ID(), '12.345.678/0001-99');

-- ONG 2: Patinhas Felizes
INSERT INTO usuarios (nome, telefone, email, cep) 
VALUES ('Patinhas Felizes', '21988887777', 'ajude@patinhasfelizes.com.br', '20000-000');
INSERT INTO ongs (usuario_id, cnpj) VALUES (LAST_INSERT_ID(), '98.765.432/0001-11');

-- ONG 3: CãoNectados Resgate
INSERT INTO usuarios (nome, telefone, email, cep) 
VALUES ('CãoNectados Resgate', '41977776666', 'resgate@caonectados.org', '80000-000');
INSERT INTO ongs (usuario_id, cnpj) VALUES (LAST_INSERT_ID(), '55.555.555/0001-00');

-- ONG 4: Abrigo Esperança
INSERT INTO usuarios (nome, telefone, email, cep) 
VALUES ('Abrigo Esperança', '31966665555', 'doacoes@abrigoesperanca.org.br', '30000-000');
INSERT INTO ongs (usuario_id, cnpj) VALUES (LAST_INSERT_ID(), '11.222.333/0001-44');