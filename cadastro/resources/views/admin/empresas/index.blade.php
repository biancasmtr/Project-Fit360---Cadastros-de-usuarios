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
  v-bind:titulos="['Id','Nome ','Endereço','CNPJ','Telefone']"
  v-bind:itens="{{json_encode($listaModelo)}}"
  ordem="asc" ordemcol="0"
  criar="#criar" detalhe="/admin/empresas/show/{id_empresa}" editar="/admin/empresas/" 
  token="{{ csrf_token() }}"
  modal="sim"></tabela-lista>

</painel>

  <!-- MODAL ADICIONAR -->
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
  <!-- FIM MODAL ADICIONAR -->

  <!-- MODAL EDITAR -->
  <modal nome="editar" titulo="Editar">
    <formulario id="formEditar" css="" :action="'/admin/empresas/' + $store.state.item.id_empresa" method="put" token="{{ csrf_token() }}">
    <div class="form-group">
      <label for="razao_social">Nome </label>
      <input type="text" class="form-control" id="razao_social" name="razao_social" v-model="$store.state.item.razao_social" placeholder="Nome">
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
    <p>ID: @{{$store.state.item.id_empresa}}</p>
    <p>Nome: @{{$store.state.item.razao_social}}</p>
    <p>Endereço: @{{$store.state.item.endereco}}</p>
    <p>CNPJ: @{{$store.state.item.cnpj}}</p>
    <p>Telefone: @{{$store.state.item.telefone}}</p>

    <div class="card" style="width: 29rem;">
      <div class="card-header">
        Funcionários da empresa: 
      </div>
      <ul class="list-group list-group-flush">

        @foreach($usuarios as $usuario)
          <li class="list-group-item" class="card-body"> {{ $usuario->name}} </li>
        @endforeach

        
      </ul>
    </div>
  </modal>
  <!-- FIM MODAL DETALHES -->
@endsection
