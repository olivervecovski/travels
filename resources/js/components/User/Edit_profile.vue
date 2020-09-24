<template>
  <div>
    <h3>Edit profile</h3>
    <div class="profile-edit">
      <span>
        <div>
          <input placeholder="Name" type="text" id="name" v-model="name">
          <textarea placeholder="Description" v-model="description"></textarea>
        </div>
        <div>
          <input :class="{'input-danger' : errors.current_password}"
            type="password"
            placeholder="Current password"
            v-model="current_password">

          <span class="text-danger"
            v-if="errors.current_password">
            {{errors.current_password[0]}}
          </span>

          <input :class="{'input-danger' : errors.password}"
            type="password"
            placeholder="New password"
            v-model="password">

          <span class="text-danger"
            v-if="errors.password">
            {{errors.password[0]}}
          </span>

          <input type="password"
            placeholder="Confirm new password"
            v-model="password_confirmation">

          <button class="btn btn-outline-success" @click="save_user_profile()">
            Save
          </button>
        </div>
      </span>
      <span class="profile-edit-image">
        <div v-show="imageData && imageData.length > 0" class="img-box">
          <div class="profile-cover" @click="$refs.fileUpload.click()"><fa icon="images"/></div>
          <img class="avatar-full" :src="imageData"/>
        </div>

        <div v-show="!imageData" class="custom-file">
          <input type="file"
            @change="previewImage"
            class="custom-file-input"
            id="profile-image"
            ref="fileUpload">
          <label class="custom-file-label">
            {{ imageData ? "Change picture" : "Chose profile picture"}}
          </label>
        </div>
      </span>
    </div>
  </div>
</template>

<script>
import User from '../../Helpers/User';

export default {
  data() {
    return {
      name: this.$store.getters.user.name,
      description: this.$store.getters.user.description,
      id: this.$store.getters.user.id,
      imageData: null,
      image: null,
      password: null,
      password_confirmation: null,
      current_password: null,
      errors: {},
    }
  },
  created () {
  },
  methods: {
    previewImage(e) {
      const file = e.target.files[0];
      this.imageData = URL.createObjectURL(file);
      this.image = file;
    },
    async save_user_profile(){
      console.log(this.image)
      User.editProfile({
        name: this.name,
        description: this.description,
        image: new FormData().append('image', this.image),
        password: this.password,
        password_confirmation: this.password_confirmation,
        current_password: this.current_password
      })
    }
  },
}
</script>

<style>

</style>