<template>
  <div class="container">
    <div class="m-auto col-sm-12 col-lg-6">
      <div class="card">
        <div class="card-header bg-dark"><div class="text-center"><img src="../../../images/travelslogo.png" alt="" class="form-logo"></div></div>
        <div class="card-body">
          <h5 class="text-center mb-4">Signing you in with {{provider}}</h5>
          <SyncLoader class="text-center" :color="'#60b0f196'"/>
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
    return;
    this.$store.dispatch('loginWithProvider', {'provider': this.$route.params.provider, 'query': this.$route.query})
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
  computed: {
    provider() {
      let prov = this.$route.params.provider
      return prov.charAt(0).toUpperCase() + prov.slice(1);
    }
  },
}
</script>

<style>

</style>