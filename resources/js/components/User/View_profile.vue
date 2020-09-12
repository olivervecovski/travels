<template>
  <div class="profile-page">
    <div class="profile-left-pane">
      <div class="profile-image">
        <img :src="user.avatar" alt="" class="avatar-full">
      </div>
      {{user.name}}
      <button
        v-if="user.id == $store.getters.user.id" @click="isEditing = !isEditing">
        {{ !isEditing ? "Edit profile" : "View profile" }}
      </button>
    </div>

    <div class="profile-right-pane">
      <!-- SKA VARA v-if="!isEditing"  !!!!!!!!!!! -->
      <triplist v-if="isEditing" :trips="user.trips" />
      <editProfile v-else />
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
      isEditing: false
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