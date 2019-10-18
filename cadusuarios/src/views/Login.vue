<template>
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading"><h3>Login</h3></div>
        <div class="panel-body">

        <form class="form-horizontal"
        action="#"
        method="post"
        @submit.prevent="submit">

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label" >E-mail</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" placeholder="E-mail" required v-model="email">

            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword3" placeholder="Senha" required v-model="senha">

            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox" v-model="checked" > Lembrar
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default" @do-sign-in="doSignIn"> <!-- @click="login" -->
                Entrar
              </button>
              <button type="submit" class="btn btn-default" @click.prevent="submitForm()">
                <router-link to="signup">  Cadastre-se</router-link>
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>

  </div>

</template>
<script>
export default {
  name: 'login',
  data() {
    return {
      email: '',
      senha: '',
      checked: '',
    }
  },
  methods: {
      login() {
        this.$router.replace("home");
      },
      submit() {
        this.emit('do-sign-in',this.$data);
      },
      doSignIn(obj) {
      // fingir que há uma chamada AJAX
      window.console.log(obj);
    }
  }
}

</script>

<style scoped>
 .container {
    width: 40%;
    margin: 0 auto;
    margin-top: 5%;
  }

  .panel-heading h3 {
    text-align: center;
  }

  .form-horizontal {
    display: inline-block;
    margin-left: 20%;
  }

  .form-group {
    display: flex;
  }

  label {
    width: 30%;
    margin-right: -5%;
  }

</style>
