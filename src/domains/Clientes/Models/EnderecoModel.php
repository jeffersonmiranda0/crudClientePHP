<?php
namespace App\Domains\Clientes\Models;

class EnderecoModel {
    private int $idEndereco;
    private string $cep;
    private string $endereco;
    private string $numero;
    private string $complemento;
    private string $bairro;
    private string $estado;
    private string $cidade;

    public function setIdEndereco(int $idEndereco)
    {
        $this->idEndereco = $idEndereco;
    }

    public function setCep(string $cep)
    {
        $this->cep = $cep;
    }

    public function setEndereco(string $endereco)
    {
        $this->endereco = $endereco;
    }

    public function setNumero(string $numero)
    {
        $this->numero = $numero;
    }

    public function setComplemento(string $complemento)
    {
        $this->complemento = $complemento;
    }

    public function setBairro(string $bairro)
    {
        $this->bairro = $bairro;
    }

    public function setCidade(string $cidade)
    {
        $this->cidade = $cidade;   
    }

    public function setEstado(string $estado)
    {
        $this->estado = $estado;
    }


    

    public function getIdEndereco() : int
    {
        return $this->idEndereco;
    }

    public function getCep() : string
    {
        return $this->cep;
    }

    public function getEndereco() : string
    {
        return $this->endereco;
    }

    public function getNumero() : string
    {
        return $this->numero;
    }

    public function getComplemento() : string
    {
        return $this->complemento;
    }

    public function getBairro() : string
    {
        return $this->bairro;
    }

    public function getCidade() : string
    {
        return $this->cidade;   
    }

    public function getEstado() : string
    {
        return $this->estado;
    }
}