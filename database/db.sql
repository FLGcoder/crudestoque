CREATE DATABASE IF NOT EXISTS crud_estoque;
USE crud_estoque;

CREATE TABLE IF NOT EXISTS produtos (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descricao VARCHAR(255) DEFAULT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade INT NOT NULL,
    data_validade DATE NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO produtos (nome, categoria, descricao, preco, quantidade, data_validade) VALUES
('Arroz 5kg', 'Alimentos', 'Arroz branco tipo 1', 24.90, 50, '2027-12-31'),
('Feijao Preto 1kg', 'Alimentos', 'Feijao tipo 1', 8.50, 40, '2027-06-30'),
('Leite Integral 1L', 'Laticinios', 'Leite UHT integral', 4.80, 100, '2026-11-15');