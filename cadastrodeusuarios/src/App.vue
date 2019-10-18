<template>

  <router-view>  <login @do-sign-in="doSignIn"/></router-view>

</template>

<script>


export default {
  name: 'app',
    components: {

    },
    methods: {
      doSignIn(obj) {
      window.console.log(obj);
    }
    }
}
</script>

