<template>
    <div>
        <h3 class="title is-3">Contatos Component</h3>
        <div class="box">
            <ul class="" v-if="contatos.length > 0">
                <contatos-lista-item
                class="list-group-item"
                v-for="contato in contatos"
                :key="contato.id"
                :contato="contato" />
            </ul>
            <p v-else> Nenhum contato cadastrado!</p>
        </div>
            
        <a class="button is-link" @click="voltar">Voltar</a>
        
    </div>
</template>

<script>
import ContatosListaItem from './ContatosListaItem.vue'

export default {
    components: {
        ContatosListaItem,
    },
    data() {
        return {
            contatos: [
                {id: 1, nome: 'Bianca', email: 'bia@gmail.com'},
                {id: 2, nome: 'Marcelo', email: 'marcelo@hotmail.com'},
                {id: 3, nome: 'Hosana', email: 'hosana@bol.com'}
            ]
        }
    },
    methods: {
        voltar(event){
        this.$router.back();
        }
    }
}
</script>
<style scoped>
    .box {
        width: 50%;
        display: flex;
        margin-bottom: 2%;
    }

</style>