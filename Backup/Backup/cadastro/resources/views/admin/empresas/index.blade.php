@extends('layouts.app')
@extends('layouts.topo')
@section('content')

  <painel titulo="Lista de Empresas">

    <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
    
    <!-- BUTTON CADASTRAR NOVAS EMPRESAS -->
      <button 
        type="button" 
        class="btn btn-outline-success" 
        data-toggle="modal" 
        data-target="#adicionar"
        style="margin-bottom: 2%;">
          Criar
      </button>
    <!-- FIM BUTTON CADASTRAR NOVAS EMPRESAS -->

    <!-- MENSAGENS DE ERRO -->
      <div>
        @if($errors->all())
          <div class="alert alert-danger" role="alert" >
            @foreach ($errors->all() as $key => $value)
              <li style="color:red;">{{$value}}</li>
            @endforeach  
          </div>
        @endif
      </div>
    <!-- FIM MENSAGENS DE ERRO -->

    <!-- MENSAGENS DE SUCESSO -->
      <div>
        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
          </div>
        @endif
      </div>
    <!-- FIM MENSAGENS DE SUCESSO -->

    <!-- MENSAGENS DE DELETE -->
      @include('flash::message')
    <!-- FIM MENSAGENS DE DELETE -->

  </painel>

  <!-- CARREGAR LISTA DE EMPRESAS -->
    <tabela-lista-emp
      v-bind:titulos="['Id','Nome ','Endereço','CNPJ','Telefone']"
      v-bind:itens='@json($listaModelo)' 
      ordem="asc" ordemcol="0"
      criar="#criar" detalhe="/admin/empresas/" editar="/admin/empresas/" 
      token="{{ csrf_token() }}"
      modal="sim">

    </tabela-lista-emp>
  <!-- FIM CARREGAR LISTA DE EMPRESAS -->

  <!-- DELETE CONFIRM MODAL --> 
    <div id="DeleteModal" class="modal fade text-danger" role="dialog">
      <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" style="margin-left: 90%;">&times;</button>
            </div>
            <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <p class="text-center text-dark" style="font-size: 16px;">Tem certeza que deseja excluir essa empresa?</p>
            </div>
            <div class="modal-footer">
              <center>
                <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Sim, Deletar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </center>
            </div>
          </div>
        </form>
      </div>
    </div>
  <!-- FIM DELETE CONFIRM MODAL -->

  <!-- MODAL ADICIONAR -->
    <modal nome="adicionar" titulo="Adicionar" id="adicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
      <formulario id="formAdicionar" css="" action="{{route('empresas.store')}}" method="post" enctype="" token="{{ csrf_token() }}" id="formu" onclick="chamada()">
        <div class="form-group">
          <label for="cnpj">Digite o CNPJ: </label>
          <input type="number" class="form-contr-cnpj" id="cnpj" name="cnpj" placeholder="CNPJ" value="{{old('cnpj')}}">
          <button class="btn btn-secondary" id="pesquisar" type="button" name="pesqui">Pesquisar</button>
        </div>
        <div class="form-group">
          <label for="razao_social">Nome Fantasia</label>
          <input type="text" class="form-control" id="nome" name="razao_social" placeholder="Nome" value="{{old('razao_social')}}">
        </div>
        <div class="form-group">
          <label for="endereco">Endereço</label>
          <input type="text" class="form-control" id="logradouro" name="endereco" placeholder="Endereço" value="{{old('endereco')}}">
        </div>
        <div class="form-group">
          <label for="telefone">Telefone</label>
          <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(xx) xxxxx-xxxx" value="{{old('telefone')}}">
        </div>
      </formulario>
      <span slot="botoes">
        <button form="formAdicionar" class="btn btn-info">Adicionar</button>
      </span>
    </modal>
  <!-- FIM MODAL ADICIONAR -->

  <!-- MODAL EDITAR -->
    <modal nome="editar" titulo="Editar" id="editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <formulario id="formEditar" :action="'/admin/empresas/' + $store.state.item.id_empresa" method="put" token="{{ csrf_token() }}">
        <input type="hidden" name="id_empresa" id="id_empresa" value="">
        <div class="form-group">
          <label for="razao_social">Nome </label>
          <input type="text" class="form-control" id="razao_social" name="razao_social" v-model="$store.state.item.razao_social" placeholder="Nome" >
        </div>
        <div class="form-group">
          <label for="endereco">Endereco</label>
          <input type="text" class="form-control" id="endereco" name="endereco" v-model="$store.state.item.endereco" placeholder="Endereço">
        </div>
        <div class="form-group">
          <label for="cnpj">CNPJ</label>
          <input type="text" class="form-control" id="cnpj" name="cnpj" v-model="$store.state.item.cnpj" placeholder="CNPJ">
        </div>
        <div class="form-group">
          <label for="telefone">Telefone</label>
          <input type="text" class="form-control" id="telefone" name="telefone" v-model="$store.state.item.telefone" placeholder="Telefone">
        </div>
      </formulario>
      <span slot="botoes">
        <button form="formEditar" class="btn btn-info">Atualizar</button>
      </span>
    </modal>
  <!-- FIM MODAL EDITAR -->
  
  <!-- MODAL DETALHES -->
    <modal nome="detalhe" titulo="Detalhes" >
      <div class="form-group">
        <p class="det">ID:</p>
        <p class="form-control-detalhes">@{{$store.state.item.id_empresa}}</p>
      </div>
      <div class="form-group">
        <p class="det">Empresa:</p>
        <p class="form-control-detalhes">@{{$store.state.item.razao_social}}</p>
      </div>
      <div class="form-group">
        <p class="det">Endereço:</p>
        <p class="form-control-detalhes">@{{$store.state.item.endereco}}</p>
      </div>
      <div class="form-group">
        <p class="det">CNPJ:</p>
        <p class="form-control-detalhes">@{{$store.state.item.cnpj}}</p>
      </div>
      <div class="form-group">
        <p class="det">Telefone:</p>
        <p class="form-control-detalhes"> @{{$store.state.item.telefone}}</p>
      </div>
      <div class="card" style="width: 32rem;" >
        <div class="card-header">
          Funcionários da empresa: 
        </div>
        <li class="list-group-item" class="card-body" v-for="usuario in $store.state.item.usuarios"> 
          @{{ usuario.name}} 
        </li>
      </div>
    </modal>
  <!-- FIM MODAL DETALHES -->

@endsection

<script type="text/javascript">

  function formSubmit() {
    $("#deleteForm").submit();
  }

  function chamada() {
    $(document).ready(function(){
      $('#pesquisar').on('click', function(e) {
        e.preventDefault();
        var cnpj = $('#cnpj').val().replace(/[^0-9]/g, '');
        $.ajax({
          url:'https://www.receitaws.com.br/v1/cnpj/' + cnpj,
          method:'GET',
          dataType: 'jsonp', 
          complete: function(xhr){
            response = xhr.responseJSON;
            if(response.status == 'OK') {
              $('#nome').val(response.nome);
              $('#logradouro').val(response.logradouro);
              $('#telefone').val(response.telefone);
            } 
          }
        });
      });
    });
  }  
</script>

<style scoped>

  .form-inline {
      width: 100%;
      display: flex;
      width: 97%;
      margin: auto;
  }

</style>