<template>
  <div class="container">
    <div class="m-auto col-sm-12 col-lg-6">
      <div class="card">
        <div class="card-header bg-dark"><div class="text-center"><img src="../../../images/travelslogo.png" alt="" class="form-logo"></div></div>
        <div class="card-body">
          <div class="form-group">
            <input type="password" class="form-control" placeholder="New password" v-model="form.password">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirm new password" v-model="form.password_confirmation">
          </div>
          <button class="btn btn-block btn-form mb-4" @click="reset">
            <span v-if="!loading">Reset password</span>
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
        password : null,
        password_confirmation: null,
        token: null,
        email: null
      },
      loading: false,
      beforeLoad: true
    }
  },
  methods: {
    reset() {
      this.form.token = this.$route.query.token;
      this.form.email = this.$route.query.email;
      this.loading = true;
      this.$store.dispatch('resetPassword', this.form)
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
  beforeCreate () {
    let beforeForm = {
      email: this.$route.query.email
    }
    this.$store.dispatch('checkPasswordToken', beforeForm)
    .then(res => {
      this.beforeLoad = false;
    })
    .catch(err =>{
      this.$toasted.error(err.message, {
        icon: 'fa-times',
        duration: 5000,
        action : {
          text : 'Close',
          onClick : (e, toastObject) => {
              toastObject.goAway(0);
          }
        },
      })
    })
  },
}
</script>

<style>

</style>