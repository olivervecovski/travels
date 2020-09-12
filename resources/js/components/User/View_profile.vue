<template>
  <div class="row">

    <div class="col-md-3">
      <div class="center">
        <img :src="user.avatar" alt="" class="avatar-full rounded-circle">
      </div>
      <div class="center">
        <div class="text-center my-2">{{user.name}}</div>
      </div>
      <button class="btn btn-block btn-default" 
      v-if="user.id == $store.getters.user.id && !$store.getters.isEditing" @click="$store.dispatch('profile_editing')">
        Edit profile
      </button>
      <button class="btn btn-block btn-default" v-if="$store.getters.isEditing"
       @click="$store.dispatch('profile_editing')">
        View profile</button>
    </div>

    <div class="col-md-9 col-lg-6" v-if="!$store.getters.isEditing">
      <triplist :trips="user.trips" />
    </div>

    <div class="col-md-9 col-lg-6" v-else>
      <editProfile />
    </div>

  </div>
</template>

<script>
import triplist from '../Trips/TripList';
import editProfile from './Edit_profile';
export default {
  components: {
    triplist,
    editProfile
  },
  data() {
    return {
      user: {},
      trips: {},
    }
  },
  beforeCreate () {
    this.$store.dispatch('get_user_profile', this.$route.params.id)
    .then(response => {
      this.user = response;
      console.log(this.user)
    })
    .catch(err => {
      
    });
   
  },
  computed: {
    name() {
      return this.data 
    }
  },
}
</script>

<style>

</style>