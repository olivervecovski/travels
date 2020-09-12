<template>
  <div class="profile-edit-image">
    <div>
      <div v-show="imageData && imageData.length > 0" class="img-box">
        <div class="profile-cover" @click="$refs.fileUpload.click()">
          <fa icon="images"/>
        </div>
        <img class="avatar-full" :src="imageData"/>
      </div>
      <div v-show="!imageData" class="custom-file">
        <input type="file" class="custom-file-input" id="profile-image" @change="previewImage" ref="fileUpload">
        <label class="custom-file-label" for="profile-image">
          {{ imageData ? "Change picture" : "Chose profile picture"}}
        </label>
      </div>
      <!-- <button v-if="imageData" class="btn btn-outline-success" @click="edit">Save</button> -->
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