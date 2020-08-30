<template>
  <div class="container">
    <div class="m-auto col-sm-12 col-lg-6">
      <div class="card">
        <div class="card-header bg-dark"><div class="text-center"><img src="../../../images/travelslogo.png" alt="" class="form-logo"></div></div>
        <div class="card-body">
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" v-model="form.email">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" v-model="form.password">
          </div>
          <router-link to="/forgot-password" class="pull-right mb-4">Forgot password?</router-link>
          <h6 class="text-center text-danger">{{ errorMessage }}</h6>
          
          <button class="btn btn-block btn-form mb-4" @click="login('')">
            <span v-if="!loading">Sign in</span>
            <SyncLoader :color="'#60b0f196'" v-else/>
            </button>
          <h5 class="line-word mb-4"><span>OR</span></h5>
          <button class="btn btn-block mb-4 btn-google" @click="login('google')"><fa class="mr-4" :icon="['fab', 'google']"></fa>Sign in with Google</button>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
import User from '../../Helpers/User';
import SyncLoader from 'vue-spinner/src/SyncLoader';
export default {
  components: {
    SyncLoader,
  },
  data() {
    return {
      form: {
        email: null,
        password: null
      },
      errorMessage: null,
      loading: false
    }
  },
  created() {
    document.title = "Travels - Sign in";
  },
  methods: {
    login(provider) {
      if(provider.length > 0) {
        // social login
        User.socialLogin(provider)
        .then(response => {
          if(response.data.url) {
            window.location.href = response.data.url;
          }
        })
      } else {
        this.loading = true;
        this.$store.dispatch('login', this.form)
        .then(response => {
          if(response.success) {
            this.loading = false;
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
            this.$router.push('/');
          } else {
            this.loading = false;
            this.errorMessage = response.message;
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
          
        });
      }
    }
  },
}
</script>

<style>

</style>