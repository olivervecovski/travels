<template>
<div>
  <div class="row  row-space-3">
    <div class="col-md-3">
      <Sidebar></Sidebar>
    </div>

    <div class="col-md-6">
      <TripList :trips="$store.getters.trips" />
    </div>
  </div>
  
</div>
   
</template>
<script>
import TripList from './Trips/TripList';
import Sidebar from './Navbar/Sidebar'
export default {
  components: {
    TripList,
    Sidebar
  },
  data () {
    return {
    };
  },
  created() {
    document.title = "Travels";
  },
};
</script>