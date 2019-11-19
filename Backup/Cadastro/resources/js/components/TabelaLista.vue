<template>
    <div>
        <div class="form-inline" >

            <a v-if="criar && !modal" :href="criar">Criar</a>
            <modal-link v-if="criar && modal" tipo="link" nome="adicionar" titulo="Criar" css=""></modal-link>

            <div class="form-group">
                <input type="search" class="form-control" placeholder="buscar" v-model="buscar">
            </div>
        </div>

        <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th style="cursor:pointer" v-on:click="ordenaColuna(index)" v-for="(titulo,index) in titulos" :key="titulo">{{titulo}}</th>

          <th v-if="detalhe || editar || deletar">Ação</th>
        </tr>
      </thead>
      <tbody>

    <!-- Listando os itens na lista -->
        <tr v-for="(item,index) in lista" :key="index">
          <td>{{item.id}}</td>
          <td>{{item.name}}</td>
          <td>{{item.email}}</td>
          <td>{{item.id_empresa}}</td>

    <!-- Carregando os elementos do menu de opções com token -->
          <td v-if="detalhe || editar || deletar">
            <form v-bind:id="index" v-if="deletar && token" v-bind:action="deletar + item.id" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" v-bind:value="token">

    <!-- Opção Detalhe do menu -->
              <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe | </a>
              <modal-link v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo=" Detalhe⠀|" css=""></modal-link>
   
    <!-- Opção Editar do menu -->
              <a v-if="editar && !modal" v-bind:href="editar"> Editar | </a>
              <modal-link v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo="link" nome="editar" titulo="⠀Editar⠀|" css=""></modal-link>
    
    <!-- Opção Deletar do menu -->
              <a href="#" v-on:click="executaForm(index)">⠀Deletar</a>
            </form>

    <!-- Carregando os elementos do menu de opções sem token  -->

    <!-- Opção Detalhe do menu -->
            <span v-if="!token">
              <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe | </a>
              <modal-link v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo=" Detalhe |" css=""></modal-link>
    
    <!-- Opção Editar do menu -->
              <a v-if="editar && !modal" v-bind:href="editar"> Editar | </a>
              <modal-link v-if="editar && modal" tipo="link" v-bind:item="item" v-bind:url="editar" nome="editar" titulo=" Editar | " css=""></modal-link>
              <a v-if="deletar" v-bind:href="deletar"> Deletar</a>
            </span>

    <!-- Opção Deletar do menu -->
            <span v-if="token && !deletar">
              <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe | </a>
              <modal-link v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo=" Detalhe |" css=""></modal-link>
    
    <!-- Opção Editar do menu -->
              <a v-if="editar && !modal" v-bind:href="editar"> Editar</a>
              <modal-link v-if="editar && modal" tipo="link" v-bind:item="item" v-bind:url="editar" nome="editar" titulo=" Editar" css=""></modal-link>
            </span>

          </td>
        </tr>
      </tbody>
    </table>
</div>
</template>

<script>
export default {
    data() {
        return{
            buscar: '',
            ordemAux: this.ordem || "asc",
            ordemAuxCol: this.ordemcol || 0
        }
    },
    methods: {
        executaForm(index) {
            document.getElementById(index).submit();
        },
        ordenaColuna(coluna) {
            this.ordemAuxCol = coluna;
            if (this.ordemAux.toLowerCase() == "asc") {
                this.ordemAux = 'desc';
            } else {
                this.ordemAux = 'asc';
            }
        }
    },
    computed: {
        lista: function() {
            let ordem = this.ordemAux;
            let ordemcol = this.ordemAuxCol;

            ordem = ordem.toLowerCase();
            ordemcol = parseInt(ordemcol);

            function ordenar() {
                if (ordem == "asc") {
                this.itens.sort(function(a,b) {
                if (Object.values(a)[ordemcol] > Object.values(b)[ordemcol]) { return 1; }
                if (Object.values(a)[ordemcol] < Object.values(b)[ordemcol]) { return -1; }
                return 0;
                });
            } else {

                this.itens.sort(function(a,b){
                    if (Object.values(a)[ordemcol] < Object.values(b)[ordemcol]) { return 1; }
                    if (Object.values(a)[ordemcol] > Object.values(b)[ordemcol]) { return -1; }
                    return 0;
                });
            }
            }
            
            if (this.buscar) {
                return this.itens.filter(res => {
                    res = Object.values(res);
                    for(let k = 0; k < res.length; k++){
                        if((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0) {
                            return true;
                        }
                }
                });
            }
            return this.itens;
        }
    },
    props:['titulos','itens','criar','detalhe','editar','deletar','token','ordem','ordemcol','modal','url'],
}
</script>

<style scoped>
    form {
        display: flex;
        width: 100%;
    }

    form a {
        margin-right: 5% !important;
    }

    .form-inline {
        width: 100%;
    }

    .form-inline .form-group {
        float: right;

    }

    .form-inline a {
        float: left;
        padding-right: 75%;
        margin-right: 5px;
        margin-top: 5px;
    }

    .form-group input {
        margin-bottom: 5px;
    }

    .form-group {
        padding-left: 75%;
    }

</style>
