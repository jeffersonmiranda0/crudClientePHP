<?php

namespace App\Domains\Clientes\Controllers;

use App\Domains\Clientes\Repository\ClienteRepository;
use App\Domains\Clientes\Services\ClienteService;
use Exception;
use PDOException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\PhpRenderer;

class ClienteController {
    
    /**
     * METODO RESPONSÁVEL POR CARREGAR A VIEW
     */
    public function view (Request $req, Response $res){
        $renderer = new PhpRenderer(__DIR__ . "/../Views");

        $cliente = new ClienteRepository();
        $dados = $cliente->listarClientes();

        return $renderer->render($res, 'index.php', ["clientes" => $dados]);
    }

    /**
     * METODO RESPONSÁVEL POR EXECUTAR A INCLSÃO DO REGISTRO
     */
    public function store(Request $req, Response $res)
    {
        try {
            $cliente = new ClienteService($req->getParsedBody());
            $cliente->inserirCliente();

            $res->getBody()->write(json_encode([
                "status" => true,
                "mensagem" => "Registro inserido com sucesso"
            ])); 
        } catch (PDOException $e) {
            $res->getBody()->write(json_encode([
                "status" => false,
                "mensagem" => "Ops ocorreu um erro inesperado"
            ])); 
        } catch (Exception $e) {
            $res->getBody()->write(json_encode([
                "status" => false,
                "mensagem" => $e->getMessage()
            ])); 
        }
        
        return $res;
    }

    /**
     * METODO RESPONSÁVEL POR atualizar registro
     */
    public function update(Request $req, Response $res)
    {
        try {
            $cliente = new ClienteService($req->getParsedBody());
            $cliente->atualizarRegistro();

            $res->getBody()->write(json_encode([
                "status" => true,
                "mensagem" => "Registro inserido com sucesso"
            ])); 
        } catch (PDOException $e) {
            $res->getBody()->write(json_encode([
                "status" => false,
                "mensagem" => "Ops ocorreu um erro inesperado"
            ])); 
        } catch (Exception $e) {
            $res->getBody()->write(json_encode([
                "status" => false,
                "mensagem" => $e->getMessage()
            ])); 
        }
        
        return $res;
    }


    public function show(Request $req, Response $res, $args)
    {   
        try {
            $cliente = new ClienteRepository();
            $dados = $cliente->listaClientePorID((int)$args['idCliente']);

            $res->getBody()->write(json_encode([
                "status" => true,
                "resultSet" => $dados
            ])); 
        } catch (PDOException $e) {
            $res->getBody()->write(json_encode([
                "status" => false,
                "mensagem" => "Ops ocorreu um erro inesperado"
            ])); 
        } catch (Exception $e) {
            $res->getBody()->write(json_encode([
                "status" => false,
                "mensagem" => $e->getMessage()
            ])); 
        }
        
        return $res;
    }

    /**
     * METODO RESPONSÁVEL POR remover registro
     */
    public function destroy(Request $req, Response $res, $args)
    {
        try {
            $cliente = new ClienteService([]);
            $cliente->removeUsuario((int)$args['idCliente']);

            $res->getBody()->write(json_encode([
                "status" => true,
                "mensagem" => "Registro removido com sucesso"
            ])); 
        } catch (PDOException $e) {
            $res->getBody()->write(json_encode([
                "status" => false,
                "mensagem" => "Ops ocorreu um erro inesperado"
            ])); 
        } catch (Exception $e) {
            $res->getBody()->write(json_encode([
                "status" => false,
                "mensagem" => $e->getMessage()
            ])); 
        }
        
        return $res;
    }
}