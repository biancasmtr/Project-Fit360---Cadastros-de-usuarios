<template>
<div class="container">
    <div class="box">

        <article class="media">
            <h3 class="title is-3">Login</h3>

            <div class="field">
                <p class="control has-icons-left has-icons-right">
                    <input class="input" type="email" placeholder="Email">
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                    </span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="password" placeholder="Password">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </p>
            </div>

            <div class="field">
                <div class="control">
                    <p class="control">
                        <button class="button is-success" v-html="sucess">
                        Login
                        </button>
                    </p>
                    <p class="control cadastro">
                         Não possui cadastro? <a v-html="html"></a>
                    </p>
                </div>
            </div>
        </article>
    </div>
</div>

   
</template>

<script>
export default {
    name: "login",
    data() {
        return {
            sucess: '<a href="/#/home">Entrar</a>',
            html: '<a href="/#/singup">Acesse</a>'
        }
    }, 
    methods: {

    },
}
</script>

<style scoped>

@import "~bulma/css/bulma.css";

    .container {
        margin: 0 auto;
        margin-top: 2%; 
        width: 40%;
    }

    .box {
        width: 80%;
        display: flex;
    }

    .media {
        display: block;
        margin: 0 auto;
        margin-left: 10%;
        margin-right: 10%;
        text-align: center;
    }

    .control p{
        margin-left: 10%;
        margin-right: 10%;

    }

    .control p.control {
        width: 100%;
        display: inline-block;
        margin: 0px;
        margin-left: 40%;
    }

    .control p.cadastro {
        display: block;
        width: 100%;
        margin-top: 3%;
        padding: 3%;
        margin-left: 40%;
        padding-left: 20%;
        margin-bottom: 2%;
        margin: 0px;
        font-size: 12px;
    }

        @media screen and (max-width: 600px) {
        .box[data-v-26084dc2] {
        width: 175%;
        margin-left: -40%;
        }

        .media[data-v-26084dc2] {
            margin-left: 10%;
        }
    }

</style>