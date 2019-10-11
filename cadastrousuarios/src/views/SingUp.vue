<template>

<div class="container">
    <div class="box">
        <article class="media">

            <h3 class="title is-3">Formulário de Cadastro</h3>
            <div class="field">
                <label class="label">Nome</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Digite seu nome">
                </div>
                </div>

            <div class="field">
                <label class="label">Sobrenome</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Digite seu sobrenome">
                </div>
            </div>

            <div class="control has-icons-left has-icons-right">
                 <label class="label">E-mail</label>
            <input class="input" type="email" placeholder="Email">
            <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
            </span>
            <span class="icon is-small is-right">
                <i class="fas fa-check"></i>
            </span>
            </div>

            <div class="field">
                <label class="label">Telefone</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Digite seu e-mail">
                </div>
            </div>

                <div class="field is-grouped">
                <div class="control">
                    <button class="button is-success" v-html="enviar"></button>
                </div>
                <div class="control">
                    <button class="button is-text" v-html="cancelar" is-light></button>
                </div>
            </div>
        </article>
    </div>
</div>


</template>


<script>
export default {
    name: 'SingUp',
    data() {
        return {
            enviar: '<a href="/#/home">Entrar</a>',
            cancelar: '<a href="/#/signup">Acesse</a>'
        }
    }, 
    methods: {

    },
}
</script>


<style scoped>
    
    
    .container {
        margin: 0 auto;
        margin-top: 2%; 
        width: 50%;
    }

    .box {
        width: 100%;
        display: flex;

    }

    .media {
        display: block;
        width: 100%;
        margin: 0 auto;
        margin-left: 10%;
        margin-right: 10%;
    }

    control p.control button {
        background: red;
    }

    .control p{
        margin-left: 10%;
        margin-right: 10%px;
    }

    .control p.control {
        width: 100%;
        display: inline-block;
        margin: 0px;
        margin-left: 40%;
    }

    .control p.cadastro {
        width: 75%;
        margin-top: 2%;
        padding: 3%;
        display: block;
        float: right;
        margin-bottom: 2%;
        margin: 0px;
        font-size: 12px;
    }

    .field .label {
        display: flex;
        float: left;
    }

    label.label {
        width: 100%;
        display: inline-block;
        margin-top: 2%;
    }

    input {
        width: 100%;
        display: inline-block;
    }

    .control.has-icons-left .input {
        padding-left: 2% !important;
    }

    .field .is-grouped {
        display: inline-flex;
        float: left;
        margin-top: 3%;
    }

    .control button a {
        text-decoration: none;
                background: red;
    }

    .button {
        float: left;
    }

    @media screen and (max-width: 600px) {
        .box[data-v-2d1abf44] {
        width: 148%;
        margin-left: -20%;
        }
    }

</style>
