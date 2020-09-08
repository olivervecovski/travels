<template>
  <div class="container">
    <div class="col-md-6 m-auto">
      <div class="card">
        <div class="card-header bg-dark"><div class="text-center"><img src="../../../images/travelslogo.png" alt="" class="form-logo"></div></div>
        <div class="card-body">
          <div class="form-group">
            <input type="text" :class="{'form-control': true, 'border-danger' : errors.name}"
             placeholder="Name" v-model="form.name">
            <span class="text-danger" v-if="errors.name">{{errors.name[0]}}</span>
          </div>
          <div class="form-group">
            <input type="email" :class="{'form-control': true, 'border-danger' : errors.email}"
             placeholder="Email" v-model="form.email">
            <span class="text-danger" v-if="errors.email">{{errors.email[0]}}</span>
          </div>
          <div class="form-group">
            <input type="password" :class="{'form-control': true, 'border-danger' : errors.password}"
             placeholder="Password" v-model="form.password">
            <span class="text-danger" v-if="errors.password">{{errors.password[0]}}</span>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirm password" v-model="form.password_confirmation">
          </div>
          <button class="btn btn-block btn-form" @click="signup('')" >
            <span v-if="!loading">Sign up</span> 
            <SyncLoader :color="'#60b0f196'" v-else/>
          </button>
          <h5 class="line-word my-4"><span>OR</span></h5>
          <button class="btn btn-block mb-4 btn-google" @click="signup('google')"><fa class="mr-4" :icon="['fab', 'google']"></fa>Sign up with Google</button>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
import User from "../../Helpers/User"
import SyncLoader from 'vue-spinner/src/SyncLoader';
export default {
  components: {
    SyncLoader,
  },
  data() {
    return {
      errorMessage: null,
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null
      },
      errors: {},
      loading: false
    }
  },
  methods: {
    signup(provider) {
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
        this.$store.dispatch('signup', this.form)
        .then(response => {
          if(response.success) {
            this.errors = {};
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
            this.errors = response.errors;
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