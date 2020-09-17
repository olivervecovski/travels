<template>
    <select name="country" id="country">
      <option value="">Where are you going?</option>
      <option v-for="country in countries" :key="country.countryName" :value="country.countryName">{{country.countryName}}</option>
    </select>
</template>

<script>
import countries from '../../Helpers/Countries.json';
export default {
  data() {
    return {
      countries: countries
    }
  },
}
</script>

<style>

</style>