<template>
  <div>
    <input placeholder="Name" type="text" id="name" v-model="form.name">
    <textarea placeholder="Description" rows="3" v-model="form.description"></textarea>
    <!-- <button class="btn btn-outline-success" @click="edit">Save</button> -->
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