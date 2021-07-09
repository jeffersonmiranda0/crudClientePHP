class Cliente {
    constructor()
    {
        this.url = '';
        this.urlViacep = 'https://viacep.com.br/ws/';
    }

    buscaCEP = () => {
        let cep = document.querySelector('#cep').value;
        cep = cep.replace('.', '').replace('-', '').replace('/', '');
        fetch(this.urlViacep + cep + '/json', {method : 'GET'})
        .then(response => response.json())
        .then(result => {
          this.renderDadosCep(result);
        })
    }

    renderDadosCep = (dados) => {
        document.querySelector('#endereco').value = dados.logradouro;
        document.querySelector('#bairro').value = dados.bairro;
        document.querySelector('#complemento').value = dados.complemento;
        document.querySelector('#estado').value = dados.uf;
        document.querySelector('#cidade').value = dados.localidade;
    }

    gravarRegistro = () => {
        const dados = {
            idCliente       : document.querySelector('#idCliente').value,
            nome            : document.querySelector('#nome').value,
            dataNascimento  : document.querySelector('#dataNascimento').value,
            sexo            : document.querySelector('#sexo').value,
            cep             : document.querySelector('#cep').value,
            endereco        : document.querySelector('#endereco').value,
            numero          : document.querySelector('#numero').value,
            complemento     : document.querySelector('#complemento').value,
            bairro          : document.querySelector('#bairro').value,
            cidade          : document.querySelector('#cidade').value,
            estado          : document.querySelector('#estado').value,
        }

        let rota  = parseInt(dados.idCliente) > 0 ? 'cliente/atualizar' : 'cliente/salvar';

        $.ajax({
            url : this.url + rota,
            type : 'POST',
            data : dados
        }).done((res) => {
            res = JSON.parse(res);
            if(res.status === true) {

                alert('Registro ' + (parseInt(dados.idCliente) > 0 ? ' ATUALIZADO' : 'INSERIDO') + ' Com sucesso');
                location.reload();
            }
        }).fail(() => {
            alert('Ocorreu um erro inesperado');
        })
    };


    getCliente = (idCliente) => {
        this.resetDadosFormulario();
        $.ajax({
            url : this.url + 'cliente/lista/' + idCliente,
            type : 'POST'
        }).done((res) => {
            let myModal = new bootstrap.Modal(document.getElementById('modalCliente'), {
                keyboard: false
            });
            myModal.show();
            let response = JSON.parse(res);
            console.log(response);
            const cliente = response.resultSet;

            document.querySelector('#idCliente').value          = cliente.idCliente;
            document.querySelector('#nome').value               = cliente.nome;
            document.querySelector('#dataNascimento').value     = cliente.dataNascimento;
            document.querySelector('#sexo').value               = cliente.sexo;
            document.querySelector('#cep').value                = cliente.cep;
            document.querySelector('#endereco').value           = cliente.endereco;
            document.querySelector('#numero').value             = cliente.numero;
            document.querySelector('#complemento').value        = cliente.complemento;
            document.querySelector('#bairro').value             = cliente.bairro;
            document.querySelector('#cidade').value             = cliente.cidade;
            document.querySelector('#estado').value             = cliente.estado;
        });
    } 


    removeCliente = (idCliente) => {
        this.resetDadosFormulario();

        let valid = confirm('Tem certeza que deseja remover o registro?'); 

        if(valid){
            $.ajax({
                url : this.url + 'cliente/remover/' + idCliente,
                type : 'DELETE'
            }).done((res) => {
                let response = JSON.parse(res);
                if(response.status == true){
                    alert('Registro removido com sucesso!')
                    location.reload();
                }
            });
        }
    } 


    resetDadosFormulario = () => {
        document.querySelector('#idCliente').value          = '';
        document.querySelector('#nome').value               = '';
        document.querySelector('#dataNascimento').value     = '';
        document.querySelector('#sexo').value               = '';
        document.querySelector('#cep').value                = '';
        document.querySelector('#endereco').value           = '';
        document.querySelector('#numero').value             = '';
        document.querySelector('#complemento').value        = '';
        document.querySelector('#bairro').value             = '';
        document.querySelector('#cidade').value             = '';
        document.querySelector('#estado').value             = '';
    }
}

const cliente = new Cliente();

document.querySelector('#cep').addEventListener('blur', cliente.buscaCEP);
document.querySelector('#gravarRegistro').addEventListener('click', cliente.gravarRegistro);