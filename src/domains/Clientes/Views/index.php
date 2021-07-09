<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/git/jquery-3.x-git.js"></script>
</head>
<body>
    <div class="container">
        <h1>CRUD BASICO CLIENTE(s)</h1>
        <div class="card">
            <div class="card-header">Listagem</div>
            <div class="card-body">

            </div>
            <div class="card-footer">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCliente">Inserir registro</button>
            </div>
        </div>

        <?php if(count($clientes) > 0) { ?>
          <h3 class="text-primary mt-5">Listagem de Clientes</h3>
          <table class="table table-striped table-bordered">
            <tr>
              <th>idCliente</th>
              <th>Dados Cliente</th>
              <th>CEP</th>
              <th>Endereco</th>
              <th>Cidade</th>
              <th>Estado</th>
              <th>Opções</th>
            </tr>
            <?php foreach($clientes as $cliente){ ?>
            <tr>
              <td class="text-center" style="vertical-align: middle;"><?=$cliente['idCliente']?></td>
              <td style="vertical-align: middle;">
              <p class="m-0">Nome: <strong><?=$cliente['nome']?></strong></p>
              <p class="m-0">Data Nascimento: <strong><?=$cliente['dataNascimento']?></strong></p>
              <p class="m-0">Sexo: <strong><?=$cliente['sexo'] === 'M' ? 'MASCULINO' : 'FEMININO'?></strong></p>
              </td>
              <td style="vertical-align: middle;"><?=$cliente['cep']?></td>
              <td style="vertical-align: middle;"><?=$cliente['endereco']?> - Nº <?=$cliente['numero']?></td>
              <td style="vertical-align: middle;"><?=$cliente['cidade']?></td>
              <td style="vertical-align: middle;"><?=$cliente['estado']?></td>
              <td class="text-center" style="vertical-align: middle;">
                <button class="btn btn-warning" onclick="cliente.getCliente(<?=$cliente['idCliente']?>)">Editar</button>
                <button class="btn btn-danger" onclick="cliente.removeCliente(<?=$cliente['idCliente']?>)">Excluir</button>
              </td>
            </tr>
            <?php } ?>
          </table>

        <?php } ?>
    </div>
  
  <!-- Modal -->
  <div class="modal fade" id="modalCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalClienteLabel">Cadastrar Cliente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4>Dados Pessoais</h4>
            <input type="hidden" class="form-control" id="idCliente" placeholder="">
            <div class="row">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="nome" class="form-control" id="nome" placeholder="Informe seu nome">
                        <label for="nome">Informe seu nome</label>
                      </div>
                </div>
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="dataNascimento" placeholder="Informe seu nome">
                        <label for="dataNascimento">Informe seu nome</label>
                      </div>
                </div>
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <select class="form-control" id="sexo">
                            <option value="">Selecione...</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                        <label for="sexo">Informe seu Sexo</label>
                      </div>
                </div>
            </div>

            <hr />
            
            <h4>Endereço</h4>
            <div class="row">
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <input type="cep" class="form-control" id="cep" placeholder="Informe seu CEP">
                        <label for="cep">Informe seu CEP</label>
                      </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="endereco" class="form-control" id="endereco" placeholder="Informe seu endereço">
                        <label for="endereco">Informe seu endereço</label>
                      </div>
                </div>
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <input type="numero" class="form-control" id="numero" placeholder="Numero">
                        <label for="numero">Numero</label>
                      </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="complemento" class="form-control" id="complemento" placeholder="Complemento">
                        <label for="complemento">Complemento</label>
                      </div>
                </div>
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <input type="bairro" class="form-control" id="bairro" placeholder="Bairro">
                        <label for="bairro">Bairro</label>
                      </div>
                </div>
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <input type="estado" class="form-control" id="estado" placeholder="Estado" readonly>
                        <label for="estado">Estado</label>
                      </div>
                </div>
                <div class="col-3">
                    <div class="form-floating mb-3">
                        <input type="cidade" class="form-control" id="cidade" placeholder="Cidade" readonly>
                        <label for="cidade">Cidade</label>
                      </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="gravarRegistro">Salvar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
        </div>
      </div>
    </div>
  </div>
  <script src="/src/domains/Clientes/Views/Cliente.js"></script>
</body>
</html>