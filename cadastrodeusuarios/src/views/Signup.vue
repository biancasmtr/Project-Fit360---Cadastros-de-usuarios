<template>
  <div>
    <form class="form-horizontal">
      <fieldset>
        <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de Cliente</div>

          <div class="panel-body">
            <div class="form-group">

            <div class="col-md-11 control-label">
            <p class="help-block"><h11>*</h11> Campo Obrigatório </p>
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-2 control-label" for="Nome">Nome <h11>*</h11></label>
            <div class="col-md-8">
            <input id="Nome" name="Nome" placeholder="" class="form-control input-md" required="" type="text">
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-2 control-label" for="Nome">CPF <h11>*</h11></label>
              <div class="col-md-2">
              <input id="cpf" name="cpf" placeholder="Apenas números" class="form-control input-md" required="" type="text" maxlength="11" pattern="[0-9]+$">
              </div>

              <label class="col-md-1 control-label" for="Nome">Nascimento<h11>*</h11></label>
              <div class="col-md-2">
              <input id="dtnasc" name="dtnasc" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="text" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
              </div>

            <!-- Multiple Radios (inline) -->

              <label class="col-md-1 control-label" for="radios">Sexo <h11>*</h11></label>
                <div class="col-md-4">
                  <label required="" class="radio-inline" for="radios-0" >
                    <input name="sexo" id="sexo" value="feminino" type="radio" required>
                  Feminino
                  </label>
                  <label class="radio-inline" for="radios-1">
                    <input name="sexo" id="sexo" value="masculino" type="radio">
                  Masculino
                  </label>
                </div>
              </div>

          <!-- Prepended text-->
          <div class="form-group">
              <label class="col-md-2 control-label" for="prependedtext">Telefone <h11>*</h11></label>
              <div class="col-md-2">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                  <input id="prependedtext" name="prependedtext" class="form-control" placeholder="XX XXXXX-XXXX" required="" type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                OnKeyPress="formatar('## #####-####', this)">
                </div>
              </div>
          </div>


          <!-- Prepended text-->
          <div class="form-group">
            <label class="col-md-2 control-label" for="prependedtext">Email <h11>*</h11></label>
              <div class="col-md-5">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input id="prependedtext" name="prependedtext" class="form-control" placeholder="email@email.com" required="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
                </div>
              </div>
          </div>

          <!-- Button (Double) -->
          <div class="form-group">
            <label class="col-md-2 control-label" for="Cadastrar"></label>
              <div class="col-md-8">
                <button id="Cadastrar" name="Cadastrar" class="btn btn-success" type="Submit">
                  <router-link to="home">Cadastrar</router-link>
                  </button>
                <button id="Cancelar" name="Cancelar" class="btn btn-danger" type="Reset">Cancelar</button>
              </div>
          </div>

          </div>
        </div>

      </fieldset>
    </form>

  </div>

</template>

<script>
export default {

    data() {
        return {

        }
    },
    methods: {
      /*formatar(mascara, documento){
      var i = documento.value.length;
      var saida = mascara.substring(0,1);
      var texto = mascara.substring(i);

      if (texto.substring(0,1) != saida){
        documento.value += texto.substring(0,1);
      }
      }
    },
    idade (){
      var data=document.getElementById("dtnasc").value;
      var dia=data.substr(0, 2);
      var mes=data.substr(3, 2);
      var ano=data.substr(6, 4);
      var d = new Date();
      var ano_atual = d.getFullYear(),
          mes_atual = d.getMonth() + 1,
          dia_atual = d.getDate();

          ano=+ano,
          mes=+mes,
          dia=+dia;

      var idade=ano_atual-ano;

      if (mes_atual < mes || mes_atual == mes_aniversario && dia_atual < dia) {
          idade--;
      }
  return idade;
  },

  exibe(i) {
    document.getElementById(i).readOnly= true;
  },

  desabilita(i){

     document.getElementById(i).disabled = true;
    },

  habilita(i)
    {
        document.getElementById(i).disabled = false;
    },

    showhide()
 {
       var div = document.getElementById("newpost");

       if(idade()>=18){

      div.style.display = "none";
  }
  else if(idade()<18) {
      div.style.display = "inline";
    }*/
  }
}
</script>

<style scoped>
  h1 {
    color:red;
}

#logo {
        width:50%;
        height:50%;
}

.panel-heading{
    font-size:150%;
}

.panel {
  width: 60%;
  margin: 0 auto;
  margin-top: 5%;
}

</style>
