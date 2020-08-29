<template>
  <div>
    <Trip v-for="trip in trips" :trip="trip" :key="trip.id"></Trip>
  </div>
</template>

<script>
import Trip from './Trip';
export default {
  components: {
    Trip,
  },
  computed: {
    trips() {
      return this.$store.getters.trips;
    }
  },
}
</script>

<style>

</style>