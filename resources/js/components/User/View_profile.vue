<template>
  <div class="row">
    <div class="col-md-3">
      <div class="center">
        <img :src="user.avatar" alt="" class="avatar-full">
      </div>
      <div class="card">
        <div class="card-header text-center">{{user.name}}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {}
    }
  },
  beforeCreate () {
    this.$store.dispatch('getUserProfile', this.$route.params.id)
    .then(response => {
      this.user = response;
    })
    .catch(err => {
      
    });
  },
}
</script>

<style>

</style>