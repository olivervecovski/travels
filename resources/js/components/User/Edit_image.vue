<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h3>Image</h3>
        <div class="input-group mb-3">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="profile-image" @change="previewImage">
            <label class="custom-file-label" for="profile-image">Change profile picture</label>
          </div>
        </div>
        <div class="image-preview" v-show="imageData && imageData.length > 0">
            <img class="avatar-full" :src="imageData"/>
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
        image: null
      },
      imageData: this.$store.getters.user.image
    }
  },
  methods: {
    edit() {
      const data = new FormData();
      data.append('image', this.form.image);
      this.$store.dispatch('edit_profile_image', data)
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
      })
      
    },
    previewImage(e) {
      const file = e.target.files[0];
      this.imageData = URL.createObjectURL(file);
      this.form.image = file;
    }
  },
}
</script>

<style>

</style>