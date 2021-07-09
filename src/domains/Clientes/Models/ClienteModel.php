<?php
namespace App\Domains\Clientes\Models;

use App\Domains\Clientes\Models\EnderecoModel;

class ClienteModel extends EnderecoModel{
    private int $idCliente;
    private string $nome;
    private string $dataNascimento;
    private string $sexo;

    public function setIdCliente(int $idCliente)
    {
        $this->idCliente = $idCliente;
    }

    public function setNome(String $nome)
    {
        $this->nome = $nome;
    }

    public function setDataNascimento(string $dataNascimento){
        $this->dataNascimento = $dataNascimento;
    }

    public function setSexo(String $sexo)
    {
        $this->sexo = $sexo;
    }

    public function getIdCliente() : int
    {
        return $this->idCliente;
    }

    public function getNome() : string
    {
        return $this->nome;
    }

    public function getDataNascimento() : string
    {
        return $this->dataNascimento;
    }

    public function getSexo() : string
    {
        return $this->sexo;
    }
}