<template>
  <MglMap :accessToken="accessToken" :mapStyle="mapStyle" />
</template>

<script>
import Mapbox from "mapbox-gl";
import { MglMap } from "vue-mapbox";

export default {
  components: {
    MglMap,
  },
  data() {
    return {
      accessToken:
        "pk.eyJ1Ijoic29jaWFsbWF0ZSIsImEiOiJja2NmZHFiMGEwMWQ5MndsaWVzaGxjMHB6In0.Lp8pyQ2bmdw9rnSzkEtTdA",
      mapStyle: "mapbox://styles/mapbox/streets-v11",
    };
  },

  created() {
    this.mapbox = Mapbox;
  },
};
</script>

<style>
.mgl-map-wrapper {
  height: 100vh;
}
body {
  margin: 0;
  padding: 0;
}
</style>
