<template>
  <div v-if="loaded">
    <div class="container sticky-top sticky-offset-logo">
        <img src="../../images/travelslogo.png" alt="" class="navbar-logo">
    </div>
    <navbar />
    <div class="container">
      <router-view></router-view>
      <div class="floating-ab" tooltip="Go to top" title="Go to top" @click="scroll"><fa icon="arrow-up" /></div>
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
  methods: {
    scroll() {
      window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth'
      });
    }
  },
}
</script>

<style>

</style>