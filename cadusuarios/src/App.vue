<template>

  <router-view></router-view>

</template>

<script>
 import Login from './views/Login'

export default {
  name: 'app',
  components: {
    Login,
  },
  methods: {
    doSignIn(obj) {
      // fingir que há uma chamada AJAX
      window.console.log(obj);
    }
  }
}
</script>

