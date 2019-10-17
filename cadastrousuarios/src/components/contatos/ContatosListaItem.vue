<template>
    <div>
        <li>
            <span> {{ contato.nome }} </span>
            <router-link :to="{ name: 'contato', params: {id: contato.id}}" class="button is-link">Detalhes</router-link>
        <hr>
        </li>
        
    </div>
</template>

<script>
export default {
    props: {
        contato: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>
    li {
    width: 100%;
    display: flex;
    float: left;
    margin-bottom: 2%;

    }

    router-link {
        width: 80%;
        float: right;
    }

    span {
        width: 100px;
        margin-bottom: 2%;
    }
</style>