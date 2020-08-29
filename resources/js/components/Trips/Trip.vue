<template>
  <div class="col-md-12 row-space-3-bottom">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <img src="../../../images/placeholder.jpg" alt="" class="list-trip-img">
          </div>
            {{trip.start_date}}
            {{trip.description}}
        </div>
      </div>
    </div>
</template>

<script>
export default {
  props: {
    trip: {
      type: Object,
    },
  },
}
</script>

<style>

</style>