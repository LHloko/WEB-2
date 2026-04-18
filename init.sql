-- BANCO DE DADOS DO ESTACIONAMENTO
CREATE DATABASE IF NOT EXISTS estacionamento
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- USUARIO PARA CONEXAO 
CREATE USER IF NOT EXISTS 'estac_user'@'localhost' IDENTIFIED BY 'estac123';

GRANT ALL PRIVILEGES ON estacionamento.* TO 'estac_user'@'localhost';

FLUSH PRIVILEGES;

USE estacionamento;

-- TABELA DE VAGAS 
CREATE TABLE vaga (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    num_vaga INT NOT NULL UNIQUE
);

-- TABELA DE VEICULOS 
CREATE TABLE veiculo (
    id int AUTO_INCREMENT PRIMARY KEY, 
    placa VARCHAR(8) NOT NULL UNIQUE, 
    modelo VARCHAR(50) NOT NULL
)

-- TABELA DE MOVIMENTAÇÃO 
CREATE TABLE movimentacao (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    data_entrada DATATIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    data_saida DATATIME DEFAULT NULL, 
    valor_pago DECIMAL(10,2) DEFAULT 0,
    id_veiculo INT NOT NULL, 
    id_vaga INT NOT NULL, 

    CONSTRAINT fk_mov_veiculo
        FOREING KEY (id_veiculo) REFERENCES veiculo(id)
        ON DELETE CASCADE, 

    CONSTRAINT fk_mov_vaga 
        FOREING KEY (id_vaga) REFERENCES vaga(id)
        ON DELETE CASCADE
)

-- SET DE VALORES INICIAIS 
INSERT INTO veiculo (placa, modelo) VALUES 
('MTD1234','Civic'), 
('MTD5678','Corolla');

INSERT INTO vaga (id) VALUES 
(1),(2),(3),(4),(5),(6),(7),(8),(9);