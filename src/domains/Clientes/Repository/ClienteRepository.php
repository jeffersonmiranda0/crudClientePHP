<?php
namespace App\Domains\Clientes\Repository;

use App\Config\Conexao;
use PDO;

class ClienteRepository {

    private PDO $conn;
    
    public function __construct()
    {
        $this->conn = (new Conexao())->exec();
    }

    public function listarClientes()
    {
        $sql = "SELECT cliente.idCliente, cliente.nome, date_format(cliente.dataNascimento, '%d/%m/%Y') as dataNascimento, cliente.sexo,
                        endereco.idEndereco, endereco.cep, endereco.endereco, endereco.numero,
                        endereco.complemento, endereco.bairro, endereco.estado, endereco.cidade
                FROM Cliente
                JOIN Endereco ON Cliente.idEndereco = Endereco.idEndereco";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listaClientePorID(int $id)
    {
        $sql = "SELECT cliente.idCliente, cliente.nome, cliente.dataNascimento, cliente.sexo,
                        endereco.idEndereco, endereco.cep, endereco.endereco, endereco.numero,
                        endereco.complemento, endereco.bairro, endereco.estado, endereco.cidade
                FROM Cliente
                JOIN Endereco ON Cliente.idEndereco = Endereco.idEndereco
                WHERE cliente.idCliente = :idCliente";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':idCliente', $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() <= 0) throw new \Exception('Não foi possível identificar o cliente');

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}