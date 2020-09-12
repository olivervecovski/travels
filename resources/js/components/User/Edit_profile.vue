<template>
  <div>
    <editgeneral />
    <editimage />
    <editpassword />
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