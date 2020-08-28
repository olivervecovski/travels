<template>
  <div v-if="loaded">
    <navbar></navbar>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
  <div v-else class="loading-page">
    <div>
      <RingLoader :loading="true" :color="'#343a40'" :size="'100px'" class="m-auto"></RingLoader>
    </div>
  </div>
</template>

<script>
import RingLoader from 'vue-spinner/src/RingLoader'
import navbar from './Navbar/Navbar.vue';
import trips from './Trips/TripList'
export default {
  components: {
    navbar,
    RingLoader,
  },
  beforeCreate () {
    this.$store.dispatch('initialize');
  },
  created() {
    document.title = "Travels";
  },
  computed: {
    loaded() {
      return this.$store.getters.loaded
    }
  },
}
</script>

<style>

</style>