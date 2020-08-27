<template>
  <div>
    <div class="col-md-12">
      <div class="col-md-6 m-auto" v-for="trip in trips" :key="trip.id">
        <div class="col-md-4">
          <img src="../../../images/placeholder.jpg" alt="" width="100%;">
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
  created () {
    console.log(this.$store.getters.trips);
  },
}
</script>

<style>

</style>