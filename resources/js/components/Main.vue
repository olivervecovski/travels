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
  data () {
    return {
      message: 'This is the home component!'
    };
  }
}
</script>

<style>

</style>