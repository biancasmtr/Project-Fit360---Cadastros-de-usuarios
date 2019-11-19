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
                        :key="index"> {{titulo}} 
                    </th>

                    <th v-if="detalhe || editar || deletar">Ação</th>
                </tr>
            </thead>
            <tbody>
                <!-- Listando os itens na lista -->
                <tr v-for="(item,index) in lista" :key="index">
                    <td>{{item.id_empresa}}</td>
                    <td>{{item.razao_social}}</td>
                    <td>{{item.endereco}}</td>
                    <td>{{item.cnpj}}</td>
                    <td>{{item.telefone}}</td>

                    <!-- Carregando os elementos do menu de opções com token -->
                    <td v-if="detalhe || editar || deletar">
                        <form 
                            v-if="deletar && token" 
                            :id="index" 
                            :action="deletar + item.id_empresa" 
                            method="post"
                            >
                            
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" :value="token">
                           
                            <a v-if="detalhe && !modal" :href="detalhe">Detalhe | </a>
                            <modal-link 
                                v-if="detalhe && modal" 
                                :item="item" 
                                :url="detalhe" 
                                tipo="link" 
                                nome="detalhe" 
                                titulo=" Detalhe⠀|">
                            </modal-link>

                            <a v-if="editar && !modal" v-bind:href="editar"> Editar | </a>
                            <modal-link 
                                v-if="editar && modal" 
                                :item="item" 
                                :url="editar" 
                                tipo="link" 
                                nome="editar" 
                                titulo="⠀Editar⠀|">
                            </modal-link>
                            
                            <a href="#" 
                            v-on:click="executaForm(index)"
                            @click="confirmDelete()"
                            >⠀<i class="fa fa-trash"></i></a>
                        </form>

                        <!-- Carregando os elementos do menu de opções sem token  -->
                        <!-- Opção Detalhe do menu -->
                        <span v-if="!token">
                            <a v-if="detalhe && !modal" :href="detalhe">Detalhe | </a>
                            <modal-link 
                                v-if="detalhe && modal" 
                                :item="item" 
                                :url="detalhe" 
                                tipo="link" 
                                nome="detalhe" 
                                titulo=" Detalhe | ">
                            </modal-link>
                            
                            <a v-if="editar && !modal" :href="editar"> Editar | </a>
                            <modal-link 
                                v-if="editar && modal" 
                                tipo="link" 
                                :item="item" 
                                :url="editar" 
                                nome="editar" 
                                titulo=" Editar | ">
                            </modal-link>
                            <a v-if="deletar" :href="deletar" @click="confirmDelete"> Deletar</a>
                        </span>

                        
                        <span v-if="token && !deletar">
                            <a v-if="detalhe && !modal" :href="detalhe">Detalhe | </a>
                            <modal-link 
                                v-if="detalhe && modal" 
                                :item="item" 
                                :url="detalhe" 
                                tipo="link" 
                                nome="detalhe" 
                                titulo=" Detalhe | ">
                            </modal-link>
                            
                            <a v-if="editar && !modal" :href="editar"> Editar</a>
                            <modal-link 
                                v-if="editar && modal" 
                                tipo="link" 
                                :item="item" 
                                :url="editar" 
                                nome="editar" 
                                titulo=" Editar">
                            </modal-link>
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
        },
        confirmDelete() {
            swal({
                title: "Deseja excluir essa empresa?",
                text: "Após confirmada essa ação não pode ser desfeita!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    swal("Empresa apagada com sucesso!", {
                    icon: "success",
                    });
                } else {
                    swal("Empresa não apagada!");
                }
                });
        },
    },
    computed: {
        lista: function() {
            let ordem = this.ordemAux;
            let ordemcol = this.ordemAuxCol;

            ordem = ordem.toLowerCase();
            ordemcol = parseInt(ordemcol);
            
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
