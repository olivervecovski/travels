<template>
  <div class="container">
    <div class="m-auto col-sm-12 col-lg-6">
      <div class="card">
        <div class="card-header bg-dark"><div class="text-center"><img src="../../../images/travelslogo.png" alt="" class="form-logo"></div></div>
        <div class="card-body">
          <p>Enter your user account's verified email address and we will send you a password reset link.</p>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Enter your email address" v-model="form.email">
          </div>
          <button class="btn btn-block btn-form mb-4" @click="sendreset">
            <span v-if="!loading">Send password reset email</span>
            <SyncLoader :color="'#60b0f196'" v-else/>
          </button>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
import SyncLoader from 'vue-spinner/src/SyncLoader';
export default {
  components: {
    SyncLoader,
  },
  data() {
    return {
      form: {
        email : null
      },
      loading: false
    }
  },
  methods: {
    sendreset() {
      this.loading = true;
      this.$store.dispatch('forgotPassword', this.form)
      .then(res => {
        if(res.success) {
          this.loading = false;
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
          this.$router.push('/')
        } else {
          this.loading = false;
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
        }
      });
    }
  },
}
</script>

<style>

</style>