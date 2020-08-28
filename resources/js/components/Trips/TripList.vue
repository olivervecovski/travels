<template>
  <div>
    <div class="col-md-12 row-space-3-bottom" v-for="trip in trips" :key="trip.id">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <img src="../../../images/placeholder.jpg" alt="" class="list-trip-img">
          </div>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    trips() {
      return this.$store.getters.trips;
    }
  },
}
</script>

<style>

</style>