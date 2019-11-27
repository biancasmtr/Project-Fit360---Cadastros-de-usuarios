<template>
  <div>
    <table class="table table-striped table-hover">
      <tbody>
        <tr v-for="item in lista" :key="item">
          <td v-for="i in item" :key="i">{{i}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
    data() {
        return{
        }
    },
    
    computed: {
        lista: function() {
            return this.itens;
        }
    },
    props:['itens','url'],
}
</script>

