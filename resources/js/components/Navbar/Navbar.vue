<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4" id="nav-bar">
    <div class="container">
      <router-link to='/' class="navbar-brands">
        <img src="../../../images/travelslogo.png" alt="" class="navbar-logo">
      </router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <div v-if="!$store.getters.isLoggedIn" class="form-inline">
            <li :class="{'nav-item': true, 'active' : ($route.name == 'Login')}" >
              <router-link to="/signin" class="nav-link">Sign in</router-link>
            </li>
            <li :class="{'nav-item': true, 'active' : ($route.name == 'Register')}">
              <router-link to="/signup" class="nav-link">Sign up</router-link>
            </li>
          </div>
          
          <div class="form-inline" v-else>
            <li class="nav-item mr-2"><router-link to="/new-trip" class="btn btn-outline-success">New trip</router-link></li>
            <li class="nav-item dropdown" v-if="$store.getters.isLoggedIn">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img :src="$store.getters.user.avatar" alt="" class="avatar-small rounded-circle mr-1">
                {{ $store.getters.user.name }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <router-link class="dropdown-item" :to="'/profile/' + $store.getters.user.id">My profile</router-link>
                <a class="dropdown-item" href="#">My trips</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" @click="logout()" >Log out</a>
              </div>
            </li>
          </div>
          
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import User from "../../Helpers/User"
export default {
  methods: {
    logout() {
      this.$store.dispatch('logout')
      .then(response => {
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
      })
    }
  },
}
</script>

<style>

</style>