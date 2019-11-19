@extends('layouts.app')
@extends('layouts.topo')
@section('content')

<painel titulo="Lista de Empresas">
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
  
  <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#adicionar">
    Criar
  </button>
</painel>

<!-- LISTA DE EMPRESAS -->
<div class="form-inline">
  <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Empresa</th>
            <th>Endereco</th>
            <th>CNPJ</th>
            <th>Telefone</th>
            <th width="280px">Ação</th>
        </tr> 
    </thead>
    <tbody>
      @foreach ($listaModelo as $item)
      <tr>
        <td id="{{ $item->id_empresa }}">{{ $item->id_empresa }}</td>
        <td>{{ $item->razao_social }}</td>
        <td>{{ $item->endereco }}</td>
        <td>{{ $item->cnpj}}</td>
        <td>{{ $item->telefone}}</td>
        <td>
          <div class="form-group">
            <!-- button detalhes -->
            <a 
              href="#" 
              class="btn btn-outline-primary"
              data-toggle="modal" 
              data-target="#detalhes"
              data-idempresadet="{{ $item->id_empresa }}" 
              data-razao_socialdet="{{ $item->razao_social }}" 
              data-enderecodet="{{ $item->endereco }}" 
              data-cnpjdet="{{ $item->cnpj }}" 
              data-telefonedet="{{ $item->telefone }}" 
              onclick="detalhesModal()">
                <i class="fa fa-search-plus"></i> 
            </a>

            <!-- button editar -->
            <a 
              href="#" 
              class="btn btn-outline-info"
              data-toggle="modal" 
              data-target="#editar"
              data-idempresa="{{ $item->id_empresa }}" 
              data-razao_social="{{ $item->razao_social }}" 
              data-endereco="{{ $item->endereco }}" 
              data-cnpj="{{ $item->cnpj }}" 
              data-telefone="{{ $item->telefone }}" 
              onclick="chamarmodal()">
                <i class="fa fa-edit"></i>
            </a>

            <!-- button deletar -->
            <a 
              href="javascript:;" 
              class="btn btn-outline-danger"
              data-toggle="modal" 
              onclick="deleteData({{$item->id_empresa}})" 
              data-target="#DeleteModal">
                <i class="fa fa-trash"></i> 
            </a>
        </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- FIM LISTA DE EMPRESAS -->

<!-- DELETE CONFIRM MODAL --> 
  <div id="DeleteModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
      <!-- Modal content-->
      <form action="" id="deleteForm" method="post">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
              <button type="button" class="close" data-dismiss="modal" style="margin-left: 90%;">&times;</button>
          </div>
          <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <p class="text-center text-dark" style="font-size: 20px;">Tem certeza que deseja excluir essa empresa?</p>
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
<modal nome="editar" titulo="Editar" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <formulario id="formEditar" :action="'empresas/update/' + {{ $item->id_empresa }}" method="put" token="{{ csrf_token() }}">
    <div class="form-group">
      <label for="razao_social">Nome </label>
      <input type="text" class="form-control" id="razao_social" name="razao_social"  placeholder="Nome" razao_social="{{ $item->razao_social }}">
    </div>
    <div class="form-group">
      <label for="endereco">Endereco</label>
      <input type="text" class="form-control" id="endereco" name="endereco" endereco="{{ $item->endereco }}" placeholder="Endereço">
    </div>
    <div class="form-group">
      <label for="cnpj">CNPJ</label>
      <input type="text" class="form-control" id="cnpj" name="cnpj" cnpj="{{ $item->cnpj }}" placeholder="CNPJ">
    </div>
    <div class="form-group">
      <label for="telefone">Telefone</label>
      <input type="text" class="form-control" id="telefone" name="telefone" telefone="{{ $item->telefone }}" placeholder="Telefone">
    </div>
  </formulario>
  <span slot="botoes">
    <button form="formEditar" class="btn btn-info">Atualizar</button>
  </span>
</modal>
<!-- FIM MODAL EDITAR -->

<!-- MODAL DETALHES -->
<modal nome="Detalhes" titulo="Detalhes" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <formulario id="formDetalhes" action="{{route('empresas.index')}}" method="get" >
    <div class="form-group-detalhes">
      <label class="label-detalhes" for="razao_socialdet">Nome </label>
      <input type="text" class="form-control-detalhes" id="razao_socialdet" name="razao_socialdet"  placeholder="Nome" razao_socialdet="{{ $item->razao_social }}" disabled>
    </div>
    <div class="form-group-detalhes">
      <label class="label-detalhes" for="enderecodet">Endereco</label>
      <input type="text" class="form-control-detalhes" id="enderecodet" name="enderecodet" enderecodet="{{ $item->endereco }}" placeholder="Endereço" disabled>
    </div>
    <div class="form-group-detalhes">
      <label class="label-detalhes" for="cnpjdet">CNPJ</label>
      <input type="text" class="form-control-detalhes" id="cnpjdet" name="cnpjdet" cnpjdet="{{ $item->cnpj }}" placeholder="CNPJ" disabled>
    </div>
    <div class="form-group-detalhes">
      <label class="label-detalhes" for="telefonedet">Telefone</label>
      <input type="text" class="form-control-detalhes" id="telefonedet" name="telefonedet" telefonedet="{{ $item->telefone }}" placeholder="Telefone" disabled>
    </div>
  </formulario>

</modal>




<modal nome="detalhe" titulo="Detalhes" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <formulario id="formDetalhes" :action="'empresas/index/' + {{ $item->id_empresa }}" method="get">
    <p>ID: {{ $item->id_empresa }}</p>
    <p>Empresa: {{ $item->razao_social }}</p>
    <p>Endereço: {{ $item->endereco }}</p>
    <p>CNPJ: {{ $item->cnpj }}</p>
    <p>Telefone: {{ $item->telefone }}</p>

    <div class="card" style="width: 29rem;">
      <div class="card-header">
        Funcionários da empresa: 
      </div>
    <li class="list-group-item" class="card-body" v-for="usuario in $store.state.item.usuarios"> 
        @{{usuario.name}} 
      </li>
    </div>  
  </formulario>
</modal>
<!-- FIM MODAL DETALHES -->

@endsection

<script type="text/javascript">
  function deleteData(id_empresa) {
    var id_empresa = id_empresa;
    var url = '{{ route("empresas.destroy", ":id_empresa") }}';
    url = url.replace(':id_empresa', id_empresa);
    $("#deleteForm").attr('action', url);
  }

  function formSubmit() {
    $("#deleteForm").submit();
  }

  function chamarmodal() {
    $('#editar').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 

      var idempresa = button.data('idempresa') 
      var razao_social = button.data('razao_social') 
      var endereco = button.data('endereco') 
      var cnpj = button.data('cnpj') 
      var telefone = button.data('telefone') 

      var modal = $(this)
      modal.find('.modal-body #razao_social').val(razao_social)
      modal.find('.modal-body #endereco').val(endereco)
      modal.find('.modal-body #cnpj').val(cnpj)
      modal.find('.modal-body #telefone').val(telefone) 
    })
  }

  function detalhesModal() {
    $('#detalhes').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 

      var idempresadet = button.data('idempresadet') 
      var razao_socialdet = button.data('razao_socialdet') 
      var enderecodet = button.data('enderecodet') 
      var cnpjdet = button.data('cnpjdet') 
      var telefonedet = button.data('telefonedet') 

      var modal = $(this)
      modal.find('.modal-body #razao_socialdet').val(razao_socialdet)
      modal.find('.modal-body #enderecodet').val(enderecodet)
      modal.find('.modal-body #cnpjdet').val(cnpjdet)
      modal.find('.modal-body #telefonedet').val(telefonedet) 
    })
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