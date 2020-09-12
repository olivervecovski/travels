<template>
  <div>
    <h3>Edit profile</h3>
    <div class="profile-edit">
      <span>
        <editgeneral />
        <editpassword />
      </span>
      <span>
        <editimage />
      </span>
    </div>
  </div>
</template>

<script>
import editgeneral from './Edit_general';
import editimage from './Edit_image';
import editpassword from './Edit_password';
export default {
  components: {
    editgeneral,
    editimage,
    editpassword
  },
}
</script>

<style>

</style>