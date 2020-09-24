<template>
  <div class="profile-page">
    <div class="profile-left-pane">
      <div class="profile-image">
        <img :src="user.image" alt="" class="avatar-full">
      </div>
      {{user.name}}
      <button
        v-if="$store.getters.user.id" @click="isEditing = !isEditing">
        {{ !isEditing ? "Edit profile" : "View profile" }}
      </button>
    </div>

    <div class="profile-right-pane">
      <triplist v-if="!isEditing" :trips="user.trips" />
      <editProfile v-else />
    </div>
  </div>
</template>

<script>
import triplist from '../Trips/TripList';
import editProfile from './Edit_profile';
import User from '../../Helpers/User';

export default {
  components: {
    triplist,
    editProfile
  },
  data() {
    return {
      user: {
        image: '',
        trips: []
      },
      isEditing: true
    }
  },
  async created () {
    const user = await User.getProfile(this.$route.params.id);
    if(user){
      this.user.image = user.data.user_profile.avatar
      this.user.trips = user.data.user_profile.trips
    }
  },
}
</script>

<style>

</style>