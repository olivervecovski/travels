<template>
  <div class="col-md-12 mb-2">
    <div class="card">
      
      <div class="card-body">
        <h3>General</h3>
        <div class="form-group">
          <input type="text" class="form-control" id="name" v-model="form.name">
        </div>
        <div class="form-group">
          <textarea class="form-control" placeholder="Description" rows="3" v-model="form.description"></textarea>
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
        name: this.$store.getters.user.name,
        description: this.$store.getters.user.description
      }
    }
  },
  methods: {
    edit() {
      this.$store.dispatch('edit_general_settings', this.form)
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
      });
    }
  },
}
</script>

<style>

</style>