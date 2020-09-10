<template>
  <div>
    <Trip v-for="trip in trips" :trip="trip" :key="trip.id"></Trip>
  </div>
</template>

<script>
import Trip from './Trip';
export default {
  props: {
    trips: {},
  },
  components: {
    Trip,
  },
}
</script>

<style>

</style>