<template>
  <div class="row">

    <div class="col-md-3">
      <div class="center">
        <img :src="user.avatar" alt="" class="avatar-full rounded-circle">
      </div>
      <div class="center">
        <div class="text-center my-2">{{user.name}}</div>
      </div>
      <button class="btn btn-block btn-default" v-if="user.id == $store.getters.user.id">Edit profile</button>
    </div>

    <div class="col-md-6">
      <triplist :trips="user.trips" />
    </div>

  </div>
</template>

<script>
import triplist from '../Trips/TripList';
export default {
  components: {
    triplist,
  },
  data() {
    return {
      user: {},
      trips: {}
    }
  },
  beforeCreate () {
    this.$store.dispatch('getUserProfile', this.$route.params.id)
    .then(response => {
      this.user = response;
      console.log(this.user)
    })
    .catch(err => {
      
    });
   
  },
}
</script>

<style>

</style>