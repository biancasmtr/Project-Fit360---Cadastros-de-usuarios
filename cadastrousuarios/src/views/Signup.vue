<template>

<div class="container">
    <div class="box">
        <form @submit.prevent="enviar">
            <article class="media">

                <h3 class="title is-3">Formulário de Cadastro</h3>
                <div class="field">
                    <label class="label">Nome</label>
                    <div class="control">
                        <input class="input" 
                        type="text" 
                        placeholder="Digite seu nome" 
                        v-model.trim.lazy="usuario.nome">
                    </div>
                    </div>

                <div class="field">
                    <label class="label">Sobrenome</label>
                    <div class="control">
                        <input class="input" 
                        type="text" 
                        placeholder="Digite seu sobrenome"
                        v-model.trim.lazy="usuario.sobrenome">
                    </div>
                </div>

                <div class="control has-icons-left has-icons-right">
                    <label class="label">E-mail</label>
                    <input class="input" 
                    type="email" 
                    placeholder="Email"
                    v-model.trim.lazy="usuario.email">
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                    </span>
                </div>
                <br>

                <div class="box genero">
                    <div class="control">
                        <label class="label">Gênero</label>
                    <label class="radio">
                        <input type="radio" v-model="usuario.genero" value="Feminino">
                        Feminino
                    </label>
                    <label class="radio">
                        <input type="radio" v-model="usuario.genero" value="Masculino">
                        Masculino
                    </label>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Telefone</label>
                    <div class="control">
                        <input 
                        type="number" 
                        class=" input form-control phone-ddd-mask" placeholder="(00) 0000-0000"
                        v-model.number.trim.lazy="usuario.telefone">
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                       <!-- <button class="button is-link" 
                        v-html="envia"
                        @click="enviar"></button> -->

                        <router-link class="button is-link" 
                        to="/home"
                        type="submit">Cadastrar</router-link>
                    </div>

                    <div class="control">
                        <button class="button is-warning" 
                        type="reset">Resetar</button>
                    </div>

                    <div class="control">
                        <router-link class="button is-light" 
                        to="/login">Cancelar</router-link>
                    </div>

                </div>
            </article>
        </form>
    </div>
</div>


</template>


<script>
export default {
    name: 'Signup',
    data() {
        return {
            usuario: {
                nome: '',
                sobrenome: '',
                email: '',
                telefone:'',
                genero:''
            }
        }
    }, 
    methods: {
        enviar(event) {
            const formularioEnviado = Object.assign({}, this.usuario)
            console.log('Formulário Enviado!', formularioEnviado)
        },
        /*signUp() {
            firebase.auth().createUserWithEmailAndPassword(
                this.usuario.nome, 
                this.usuario.sobrenome, 
                this.usuario.email,
                this.usuario.telefone,
                this.usuario.genero ).then(
                (user) => {
                    this.$router.replace('home')
                },
                (err) => {
                    alert('Aconteceu algo inesperado. ' + erro.message)
                }
            )
        }*/
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

    .box.genero {
        display: inline-block;
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
        width: 20%;
        display: inline-block;
        margin-top: 2%;
    }

    input {
        /* width: 100%; */
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
