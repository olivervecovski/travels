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
          <button class="btn btn-block btn-form" @click="signup('')" >Sign up</button>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
import User from "../../Helpers/User"
export default {
  data() {
    return {
      errorMessage: null,
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null
      },
      errors: {}
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
        this.$store.dispatch('signup', this.form)
        .then(response => {
          if(response.success) {
            this.errors = {};
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