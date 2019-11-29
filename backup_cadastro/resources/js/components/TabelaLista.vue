<template>
    <div>
        <div class="form-inline" >
            <a v-if="criar && !modal" :href="criar">Criar</a>
            <modal-link 
                v-if="criar && modal" 
                tipo="link" 
                nome="adicionar" 
                titulo="Criar">
            </modal-link>

            <div class="form-group">
                <input type="search" class="form-control" placeholder="buscar" v-model="buscar">
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th 
                        style="cursor:pointer" 
                        @click="ordenaColuna(index)" 
                        v-for="(titulo,index) in titulos" 
                        :key="titulo">{{titulo}}
                    </th>
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

                    <td v-if="detalhe || editar">
                        <form 
                            :id="index" 
                            v-if="deletar && token" 
                            :action="deletar + item.id" 
                            method="post">

                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" :value="token">

                            <modal-link 
                                v-if="detalhe && modal" 
                                :item="item" 
                                :url="detalhe" 
                                tipo="link" 
                                nome="detalhe" 
                                titulo=" Detalhe⠀|" 
                                style="margin-left: 3%;">
                                    <i class="fa fa-search-plus" ></i> 
                            </modal-link>

                            <modal-link 
                                v-if="editar && modal" 
                                :item="item" 
                                :url="editar" 
                                tipo="link" 
                                nome="editar" 
                                titulo="⠀Editar⠀|" 
                                style="margin-left: 3%;">
                                    <i class="fa fa-edit"></i>
                            </modal-link>
                            <a 
                                href="javascript:;" 
                                class="btn btn-outline-danger"
                                data-toggle="modal" 
                                @click="deleteData(item.id)" 
                                data-target="#DeleteModal"
                                style="margin-left: 3%;">
                                    <i class="fa fa-trash"></i> 
                            </a>
                        </form>
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
        },
        deleteData(id) {
            var id = id;
            var url = 'usuarios/destroy/:id';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        },
    },
    computed: {
        lista: function() {
            let lista = this.itens.data;

            let ordem = this.ordemAux;
            let ordemcol = this.ordemAuxCol;

            ordem = ordem.toLowerCase();
            ordemcol = parseInt(ordemcol);

            if (ordem == "asc") {
                lista.sort(function(a,b) {
                if (Object.values(a)[ordemcol] > Object.values(b)[ordemcol]) { return 1; }
                if (Object.values(a)[ordemcol] < Object.values(b)[ordemcol]) { return -1; }
                return 0;
                });
            } else {
                lista.sort(function(a,b){
                    if (Object.values(a)[ordemcol] < Object.values(b)[ordemcol]) { return 1; }
                    if (Object.values(a)[ordemcol] > Object.values(b)[ordemcol]) { return -1; }
                    return 0;
                });
            }
            
            if (this.buscar) {
                return lista.filter(res => {
                    res = Object.values(res);
                    for(let k = 0; k < res.length; k++){
                        if((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >= 0) {
                            return true;
                        }
                    }
                });
            }
            return lista;
        }
    },
    props:[ 'titulos',
            'itens',
            'criar',
            'detalhe',
            'editar',
            'deletar',
            'token',
            'ordem',
            'ordemcol',
            'modal',
            'url'],
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
