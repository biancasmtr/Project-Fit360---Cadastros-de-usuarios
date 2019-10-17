<template>
    <div>
        <h2 class="title is-2">Home</h2>
        <contatos-lista />
        <router-view> </router-view>
    </div>
</template>

<script>

import ContatosLista from '../components/contatos/ContatosLista.vue'
export default {
    name: "home",
    data() {
        return {

        }
    }, 
    components: {
        ContatosLista,
    }
}
</script>

<style>
    @import "~bulma/css/bulma.css";

    
</style>