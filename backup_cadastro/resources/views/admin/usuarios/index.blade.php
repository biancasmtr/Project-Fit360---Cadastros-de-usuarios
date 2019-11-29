@extends('layouts.app')
@extends('layouts.topo')
@section('content')

  <painel titulo="Lista de Usuários">
    <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>

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

    <!-- BUTTON CADASTRAR NOVOS USUÁRIOS -->
      <button 
        type="button" 
        class="btn btn-outline-success" 
        data-toggle="modal" 
        data-target="#adicionar">
          Criar
      </button>
    <!-- FIM BUTTON CADASTRAR NOVOS USUÁRIOS -->

  </painel>

  <!-- CARREGAR LISTA DE USUÁRIOS -->
    <tabela-lista
      v-bind:titulos="['Id','Nome','Email','Empresa']"
      v-bind:itens='@json($listaModelo)'
      ordem="asc" ordemcol="0"
      criar="#criar" detalhe="/admin/usuarios/" editar="/admin/usuarios/" deletar="/admin/usuarios/" 
      token="{{ csrf_token() }}"
      modal="sim">
    </tabela-lista>
    {{-- {{$listaModelo->links()}} --}}
    
  <!-- FIM CARREGAR LISTA DE USUÁRIOS -->

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
              <p class="text-center text-dark" style="font-size: 16px;">Tem certeza que deseja excluir esse usuário?</p>
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
    <modal nome="adicionar" titulo="Adicionar">
      <formulario id="formAdicionar" css="" action="{{route('usuarios.store')}}" method="post" token="{{ csrf_token() }}">
        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{old('name')}}">
        </div>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}">
        </div>
        <div class="form-group">
          <label for="password">senha</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Senha" value="{{old('password')}}">
        </div>
        <div class="input">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha">
        </div>
        <div class="input">
          <select class="select" name="id_empresa" id="id_empresa">
            <option selected="true" disabled="disabled">Selecione sua empresa</option>
            @foreach(App\Empresa::all() as $empresa)
              <option value="{{ $empresa->id_empresa }}">{{ $empresa->razao_social }}</option>
            @endforeach
          </select>
        </div>
      </formulario>
      <span slot="botoes">
        <button form="formAdicionar" class="btn btn-info">Adicionar</button>
      </span>
    </modal>
  <!-- FIM MODAL ADICIONAR -->

  <!-- MODAL EDITAR -->
    <modal nome="editar" titulo="Editar">
      <formulario id="formEditar" css="" :action="'/admin/usuarios/' + $store.state.item.id" method="put" token="{{ csrf_token() }}">
        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control" id="name" name="name" v-model="$store.state.item.name" placeholder="Nome">
        </div>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" class="form-control" id="email" name="email" v-model="$store.state.item.email" placeholder="E-mail">
        </div>
        <div class="form-group">
          <label for="password">Atualizar Senha</label>
          <input type="password" class="form-control" id="senha" name="senha" v-model="$store.state.item.password" placeholder="Nova Senha">
        </div>
        <div class="input">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirmar Senha">
        </div>
        <div class="input">
          <label for="select" class="selectt">Empresa</label>
          <select class="select" name="id_empresa" id="id_empresa" class="input" v-model="$store.state.item.id_empresa">
            @foreach(App\Empresa::all() as $empresa)
              <option  value="{{ $empresa->id_empresa }}">{{ $empresa->razao_social }}</option>
            @endforeach
          </select>
        </div>
      </formulario>
      <span slot="botoes">
        <button form="formEditar" class="btn btn-info">Atualizar</button>
      </span>
    </modal>
  <!-- FIM MODAL EDITAR -->

  <!-- MODAL DETALHES -->
    <modal nome="detalhe" titulo="Detalhes">
      <div class="form-group">
        <p class="det">ID:</p>
        <p class="form-control-detalhes">@{{$store.state.item.id}}</p>
      </div>
      <div class="form-group">
        <p class="det">Nome:</p>
        <p class="form-control-detalhes">@{{$store.state.item.name}}</p>
      </div>
      <div class="form-group">
        <p class="det">E-mail:</p>
        <p class="form-control-detalhes">@{{$store.state.item.email}}</p>
      </div>
      <div class="form-group">
        <p class="det">Empresa:</p>
        <div class="input">
          <select class="select" name="id_empresa" id="id_empresa" class="input" v-model="$store.state.item.id_empresa" style="-webkit-appearance: listbox; width: 75%; !important " disabled>
            @foreach(App\Empresa::all() as $empresa)
              <option  value="{{ $empresa->id_empresa }}">{{ $empresa->razao_social }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </modal>
  <!-- FIM MODAL DETALHES -->
@endsection

<script type="text/javascript">

  function formSubmit() {
    $("#deleteForm").submit();
  }

</script>

<style scoped>
  
  .modal-backdrop {
    opacity: 0.2 !important;
    background-color: #000 !important;
  }
  
</style>