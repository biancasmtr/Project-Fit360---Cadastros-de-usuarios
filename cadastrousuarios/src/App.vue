<template>


 <!-- <login></login> -->
 <SingUp></SingUp> 

</template>

<script>
import Login from './views/Login';
import Home from './views/Home';
import SingUp from './views/SingUp'


export default {
  name: 'app',
  components: {
    Login,
    Home,
    SingUp
  }
}
</script>
