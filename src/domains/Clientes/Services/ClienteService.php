<?php


namespace App\Domains\Clientes\Services;

use App\Config\Conexao;
use App\Domains\Clientes\Models\ClienteModel;
use App\Domains\Clientes\Repository\ClienteRepository;
use PDO;

class ClienteService { 
    private PDO $conn;
    private ClienteModel $cliente;
    public function __construct(Array $dados)
    {
        $this->conn = (new Conexao())->exec();
        $this->setDadosCliente($dados);
    }

    public function setDadosCliente(array $dados){
        $this->cliente = new ClienteModel();
        $this->cliente->setIdCliente(isset($dados['idCliente']) ? $dados['idCliente'] : 0);
        $this->cliente->setNome(isset($dados['nome']) ? $dados['nome'] : '');
        $this->cliente->setDataNascimento(isset($dados['dataNascimento']) ? $dados['dataNascimento'] : '');
        $this->cliente->setSexo(isset($dados['sexo']) ? $dados['sexo'] : '');
        $this->cliente->setCep(isset($dados['cep']) ? $dados['cep'] : '');
        $this->cliente->setEndereco(isset($dados['endereco']) ? $dados['endereco'] : '');
        $this->cliente->setNumero(isset($dados['numero']) ? $dados['numero'] : '');
        $this->cliente->setComplemento(isset($dados['complemento']) ? $dados['complemento'] : '');
        $this->cliente->setBairro(isset($dados['bairro']) ? $dados['bairro'] : '');
        $this->cliente->setCidade(isset($dados['cidade']) ? $dados['cidade'] : '');
        $this->cliente->setEstado(isset($dados['estado']) ? $dados['estado']: '');
    }


    public function inserirCliente()
    {
        $this->inserirEnderecoCliente();

        $sql = "INSERT INTO Cliente (nome, dataNascimento, sexo, idEndereco) VALUES (:nome, :dataNascimento, :sexo, :idEndereco)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nome', $this->cliente->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':dataNascimento', $this->cliente->getDataNascimento(), PDO::PARAM_STR);
        $stmt->bindValue(':sexo', $this->cliente->getSexo(), PDO::PARAM_STR);
        $stmt->bindValue(':idEndereco', $this->cliente->getIdEndereco(), PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() <= 0) throw new \Exception('Ocorreu um erro não foi possível inserir o registro');

        return true;
    }


    public function inserirEnderecoCliente()
    {
        $sql = "INSERT INTO Endereco (cep, endereco, numero, complemento, bairro, estado, cidade) 
                VALUES (:cep, :endereco, :numero, :complemento, :bairro, :estado, :cidade)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':cep', $this->cliente->getCep(), PDO::PARAM_STR);
        $stmt->bindValue(':endereco', $this->cliente->getEndereco(), PDO::PARAM_STR);
        $stmt->bindValue(':numero', $this->cliente->getNumero(), PDO::PARAM_STR);
        $stmt->bindValue(':complemento', $this->cliente->getComplemento(), PDO::PARAM_STR);
        $stmt->bindValue(':bairro', $this->cliente->getBairro(), PDO::PARAM_STR);
        $stmt->bindValue(':estado', $this->cliente->getEstado(), PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $this->cliente->getCidade(), PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() <= 0) throw new \Exception('Ocorreu um erro não foi possível inserir o endereço do cliente');

        $this->cliente->setIdEndereco($this->conn->lastInsertId());
    }



    public function atualizarRegistro()
    {
        if($this->cliente->getIdCliente() <= 0) throw new \Exception('Cliente não foi Identificado');

        $clienteRep = new ClienteRepository();
        $clienteRep->listaClientePorID($this->cliente->getIdCliente());

        /**
         * NÃO É MUITO RECOMENDADO ESSE TIPO DE UPDATE, POIS PODE PERDER PERFORMANCE COM O TEMPO
         * POREM VAI RESOLVER O PROBLEMA NESTE MOMENTO
         */
        $sql = "UPDATE Cliente
                JOIN Endereco ON Cliente.idEndereco = Endereco.idEndereco
                SET Cliente.nome        = :nome,
                    Cliente.dataNascimento = :dataNascimento,
                    Cliente.sexo        = :sexo,
                    Endereco.cep        = :cep,
                    Endereco.endereco   = :endereco,
                    Endereco.numero     = :numero,
                    Endereco.complemento = :complemento,
                    Endereco.bairro     = :bairro,
                    Endereco.estado     = :estado,
                    Endereco.cidade     = :cidade
                WHERE cliente.idCliente = :idCliente";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':idCliente', $this->cliente->getIdCliente(), PDO::PARAM_INT);
        $stmt->bindValue(':nome', $this->cliente->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':dataNascimento', $this->cliente->getDataNascimento(), PDO::PARAM_STR);
        $stmt->bindValue(':sexo', $this->cliente->getSexo(), PDO::PARAM_STR);
        $stmt->bindValue(':cep', $this->cliente->getCep(), PDO::PARAM_STR);
        $stmt->bindValue(':endereco', $this->cliente->getEndereco(), PDO::PARAM_STR);
        $stmt->bindValue(':numero', $this->cliente->getNumero(), PDO::PARAM_STR);
        $stmt->bindValue(':complemento', $this->cliente->getComplemento(), PDO::PARAM_STR);
        $stmt->bindValue(':bairro', $this->cliente->getBairro(), PDO::PARAM_STR);
        $stmt->bindValue(':estado', $this->cliente->getEstado(), PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $this->cliente->getCidade(), PDO::PARAM_STR);
        $stmt->execute();
    }



    public function removeUsuario(int $idCliente)
    {
        $this->cliente->setIdCliente($idCliente);

        if($this->cliente->getIdCliente() <= 0) throw new \Exception('Cliente não foi Identificado');

        $clienteRep = new ClienteRepository();
        $clienteRep->listaClientePorID($this->cliente->getIdCliente());

        /**
         * NÃO É MUITO RECOMENDADO ESSE TIPO DE DELETE, POIS PODE PERDER PERFORMANCE COM O TEMPO
         * POREM VAI RESOLVER O PROBLEMA NESTE MOMENTO
         */
        $sql = "DELETE Cliente, Endereco 
                FROM Cliente
                JOIN Endereco ON Cliente.idEndereco = Endereco.idEndereco
                WHERE cliente.idCliente = :idCliente";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':idCliente', $this->cliente->getIdCliente(), PDO::PARAM_INT);
        $stmt->execute();
    }
}