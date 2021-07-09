#QUERY BANCO DE DADOS
```sql
CREATE DATABASE crmall;
USE crmall;

CREATE TABLE Endereco(
	idEndereco INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cep VARCHAR(18),
    endereco VARCHAR(200),
    numero varchar(5) default 'S/N',
    complemento VARCHAR(200),
    bairro VARCHAR(40),
    cidade VARCHAR(40),
    estado CHAR(2)
);

CREATE TABLE Cliente (
	idCliente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idEndereco INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    dataNascimento DATE,
    sexo CHAR(1),
    dataCadastro timestamp DEFAULT CURRENT_TIMESTAMP(),
    dataAtualizado timestamp DEFAULT NULL,
    FOREIGN KEY(idEndereco) REFERENCES Endereco(idEndereco)
);
```