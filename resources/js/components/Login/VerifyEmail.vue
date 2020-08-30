<template>
  <div class="container">
    <div class="m-auto col-sm-12 col-lg-6">
      <div class="card">
        <div class="card-header bg-dark"><div class="text-center"><img src="../../../images/travelslogo.png" alt="" class="form-logo"></div></div>
        <div class="card-body">
          <h5 class="text-center mb-4">Verifying your email</h5>
          <SyncLoader :color="'#60b0f196'" class="text-center"/>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
import SyncLoader from 'vue-spinner/src/SyncLoader'
export default {
  components: {
    SyncLoader,
  },
  created () {
    this.$store.dispatch('verifyEmail', this.$route.query)
      .then(res => {
        if(res.success) {
          this.$toasted.success(res.message, {
            icon: 'fa-check',
            duration: 3000,
            action : {
              text : 'Close',
              onClick : (e, toastObject) => {
                  toastObject.goAway(0);
              }
            },
          })
          this.$router.push('/login')
        } else {
          this.$toasted.error(res.message, {
            icon: 'fa-times',
            duration: 5000,
            action : {
              text : 'Close',
              onClick : (e, toastObject) => {
                  toastObject.goAway(0);
              }
            },
          })
          this.$router.push('/')
        }
      });
  },
}
</script>

<style>

</style>