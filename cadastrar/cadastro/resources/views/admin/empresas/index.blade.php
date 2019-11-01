@extends('layouts.app')
@extends('layouts.topo')
@section('content')

<painel titulo="Lista de Empresas">
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
  v-bind:titulos="['Id','Razão Social','Endereço','CNPJ','Telefone']"
  v-bind:itens="{{$listaModelo}}"
  ordem="desc" ordemcol="1"
  criar="#criar" detalhe="/admin/empresas/" editar="/admin/empresas/" deletar="/admin/empresas/" 
  token="{{ csrf_token() }}"
  modal="sim"></tabela-lista>

</painel>

    <modal nome="adicionar" titulo="Adicionar">
      <formulario id="formAdicionar" css="" action="{{route('empresas.store')}}" method="post" enctype="" token="{{ csrf_token() }}">
  
        <div class="form-group">
          <label for="razao_social">Razão Social</label>
          <input type="text" class="form-control" id="razao_social" name="razao_social" placeholder="Nome" value="{{old('razao_social')}}">
        </div>
        <div class="form-group">
          <label for="endereco">Endereço</label>
          <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" value="{{old('endereco')}}">
        </div>
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="number" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" value="{{old('cnpj')}}">
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="number" class="form-control" id="telefone" name="telefone" placeholder="(xx) xxxxx-xxxx" value="{{old('telefone')}}">
        </div>
  
      </formulario>
      <span slot="botoes">
        <button form="formAdicionar" class="btn btn-info">Adicionar</button>
      </span>
    </modal>

    <modal nome="editar" titulo="Editar">
      <formulario id="formEditar" css="" :action="'/admin/usuarios/' + $store.state.item.id" method="put" enctype="multipart/form-data" token="{{ csrf_token() }}">
  
        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" class="form-control" id="name" name="name" v-model="$store.state.item.name" placeholder="Nome">
        </div>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" class="form-control" id="email" name="email" v-model="$store.state.item.email" placeholder="E-mail">
        </div>
        <div class="form-group">
            <label for="password">senha</label>
            <input type="password" class="form-control" id="password" name="password" v-model="$store.state.item.password">
        </div>

      </formulario>
      <span slot="botoes">
        <button form="formEditar" class="btn btn-info">Atualizar</button>
      </span>
    </modal>
    <modal nome="detalhe" titulo="Detalhes">
      <p>@{{$store.state.item.id}}</p>
      <p>@{{$store.state.item.razao_social}}</p>
      <p>@{{$store.state.item.endereco}}</p>
      <p>@{{$store.state.item.cnpj}}</p>
      <p>@{{$store.state.item.telefone}}</p>
    </modal>

@endsection
