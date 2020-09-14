<template>
  <div>
    <input type="text" placeholder="Name" v-model="form.name">
    <textarea placeholder="Description" rows="3" v-model="form.description"></textarea>
    <Datepicker v-model="form.start_date" :hint="'When will this trip start?'" :only-date="true" :format="'YYYY-MM-DD'" :formatted="'YYYY-MM-DD'"/>
    <Datepicker v-model="form.end_date" :hint="'When will this trip end?'" :only-date="true" :format="'YYYY-MM-DD'" :formatted="'YYYY-MM-DD'"/>
    <input type="checkbox" v-model="form.private" > Do you want this trip to be private? Only you will be able to see it
    <button class="btn btn-outline-success" @click="create">Save</button>
  </div>
</template>

<script>
import Datepicker from 'vue-ctk-date-time-picker';
export default {
  components: {
    Datepicker,
  },
  data() {
    return {
      form: {
        name: null,
        description: null,
        start_date: null,
        end_date: null,
        private: null,
        image: null,
      }
    }
  },
  methods: {
    create() {
      this.$store.dispatch('create_trip', this.form).
      then(response => {
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
        } else {
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
      })
    }
  },
}
</script>

<style>

</style>