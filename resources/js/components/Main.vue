<template>
  <div>
    <navbar></navbar>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import navbar from './Navbar/Navbar.vue';
export default {
  components: {
    navbar,
  },
  beforeCreate () {
    let token = localStorage.getItem('token');
    if(token) {
      this.$store.dispatch('authUser');
    };
  },
}
</script>

<style>

</style>