<template>
  <div>
    <trip-form />
    <!-- COVER IMAGE FÖR TRIP-->
    <country-form />
  </div>
</template>

<script>

import countryForm from './New_country_form';
import tripForm from './New_trip_form';
export default {
  components: {
    tripForm,
    countryForm
  },
}
</script>

<style>

</style>