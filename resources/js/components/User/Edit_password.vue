<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h3>Password</h3>

        <div class="form-group">
          <input type="password" class="form-control" placeholder="New password" v-model="form.password">
          <span class="text-danger" v-if="errors.password">{{errors.password[0]}}</span>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Confirm new password" v-model="form.password_confirmation">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Current password" v-model="form.current_password">
          <span class="text-danger" v-if="errors.current_password">{{errors.current_password[0]}}</span>
        </div>

        <button class="btn btn-outline-success" @click="edit">Save</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        password: null,
        password_confirmation: null,
        current_password: null
      },
      errors: {}
    }
  },
  methods: {
    edit() {
      this.$store.dispatch('edit_password', this.form)
      .then(response => {
        this.errors = {};
        this.form = {};
        this.$toasted.success(response.data.message, {
          icon: 'fa-check',
          duration: 3000,
          action : {
            text : 'Close',
            onClick : (e, toastObject) => {
                toastObject.goAway(0);
            }
          },
        })
      })
      .catch(err => {
        this.errors = {};
        err = err.response.data;
        if(err.errors) {
          this.errors = err.errors;
        } else {
          this.errors.current_password = ['Incorrect password'];
        }
        
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
    }
  },
}
</script>

<style>

</style>