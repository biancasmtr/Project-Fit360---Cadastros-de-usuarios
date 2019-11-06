@extends('layouts.app')
@extends('layouts.topo')
@section('content')

<painel titulo="Lista de Usuários">
  <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
  <div>
    @if($errors->all())
    <div class="alert alert-danger" role="alert" >
      @foreach ($errors->all() as $key => $value)
        <li style="color:red;">{{$value}}</li>
      @endforeach  
    </div>
    @endif
  </div>
    
  <tabela-lista
  v-bind:titulos="['Id','Nome','Email','Empresa']"
  v-bind:itens="{{$listaModelo}}"
  ordem="asc" ordemcol="0"
  criar="#criar" detalhe="/admin/usuarios/" editar="/admin/usuarios/" deletar="/admin/usuarios/" 
  token="{{ csrf_token() }}"
  modal="sim"></tabela-lista>

</painel>

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

    <select class="select" name="id_empresa" id="id_empresa" v-model="$store.state.item.id_empresa" class="input">
      <option selected="true" disabled="disabled">Selecione sua empresa</option>
      @foreach(App\Empresa::all() as $empresa)
        <option value="{{ $empresa->id_empresa }}">{{ $empresa->razao_social }}</option>
      @endforeach
    </select>

    </formulario>
  <span slot="botoes">
    <button form="formEditar" class="btn btn-info">Atualizar</button>
  </span>
  </modal>
  <!-- FIM MODAL EDITAR -->

<!-- MODAL DETALHES -->
<modal nome="detalhe" titulo="Detalhes">
  <p>ID: @{{$store.state.item.id}}</p>
  <p>Nome: @{{$store.state.item.name}}</p>
  <p>E-mail: @{{$store.state.item.email}}</p>
  <p>Empresa: @{{$store.state.item.id_empresa}}</p>
</modal>
<!-- FIM MODAL DETALHES -->

@endsection
