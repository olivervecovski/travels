<template>
  <div>
    <div class="loading-page">
      <div>
        <RingLoader :loading="true" :color="'#343a40'" :size="'100px'" class="m-auto"></RingLoader>
      </div>
    </div>
  </div>
</template>

<script>
import RingLoader from 'vue-spinner/src/RingLoader'
export default {
  components: {
    RingLoader,
  },
  created () {
    this.$store.dispatch('loginWithProvider', this.$route.params.provider, this.$route.query)
    .then(response => {
      if(response.success) {
        this.$toasted.success(response.message, {
          icon: 'fa-check',
          duration: 3000,
          action : {
            text : 'Close',
            onClick : (e, toastObject) => {
                toastObject.goAway(0);
            }
          },
        })
      }
      else {
        this.$toasted.error(response.message, {
          icon: 'fa-times',
          duration: 5000,
          action : {
            text : 'Close',
            onClick : (e, toastObject) => {
                toastObject.goAway(0);
            }
          },
        })
      }

      this.$router.push('/');
    })
    .catch(err => {
      console.log(err);
    })
  },
}
</script>

<style>

</style>