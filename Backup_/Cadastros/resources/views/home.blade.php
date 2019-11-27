@extends('layouts.app')
@extends('layouts.topo')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <painel titulo="Dashboard">
                    <migalhas :lista="{{$listaMigalhas}}"></migalhas>
                    <div class="row">
                        <caixa
                        qtd='quantidade: {{$totalUsuarios}}'
                        titulo="Usuários"
                        url="{{route('usuarios.index')}}"
                        icone="ion ion-person-stalker"
                        style="background-color:  #003333"></caixa>
                    </div>
                    <div class="row">
                        <caixa
                        qtd='quantidade: {{$totalEmpresas}}'
                        titulo="Empresas"
                        url="{{route('empresas.index')}}"
                        icone="ion ion-person"
                        style="background-color: #55552b"></caixa>
                    </div>
                </painel>
            </div>
        </div>
    </div>

@endsection
