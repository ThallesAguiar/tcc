<template>
  <MglMap :accessToken="accessToken" :mapStyle="mapStyle">
    <MglNavigationControl position="top-right" />
    <MglGeolocateControl
      position="top-right"
      :trackUserLocation="true"
      :showUserLocation="true"
    />
    <MglPopup :coordinates="myCoordinates">
      <span>Hello world!</span>
    </MglPopup>
  </MglMap>
</template>

<script>
import api from "../service/api";
import Mapbox from "mapbox-gl";
import {
  MglMap,
  MglNavigationControl,
  MglGeolocateControl,
  MglFullscreenControl,
  MglPopup,
} from "vue-mapbox";

export default {
  components: {
    MglMap,
    MglNavigationControl,
    MglGeolocateControl,
    MglFullscreenControl,
    MglPopup,
  },
  data() {
    return {
      accessToken:
        "pk.eyJ1Ijoic29jaWFsbWF0ZSIsImEiOiJja3E5bGdpcHEwNXMzMnBzMTZpeTRrZDk5In0.0ru5SvtMtBqp8gMH8Zh3vQ",
      mapStyle: "mapbox://styles/mapbox/streets-v11",
      myCoordinates: JSON.parse(localStorage.getItem("coordinates")),
      // myCoordinates: [0, 0],
      user: {},
    };
  },

  methods: {
    getCoordinatesCurrent() {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const { latitude, longitude } = position.coords;

          const coord = Object.values({ longitude, latitude });

          if (!localStorage.getItem("coordinates"))
            localStorage.setItem("coordinates", JSON.stringify(coord));
        },
        (err) => {
          console.log(err);
        },
        {
          timeout: 30000,
          enableHighAccuracy: true, //pega a localização via GPS
          maximumAge: 1000, //como se fosse um cache, pra guardar a localização do GPS
        }
      );
    },
    async updateCoordinatesUser(id) {
      // setInterval(function(){ alert("Hello"); }, 30000);
      this.getCoordinatesCurrent();

      // console.log(id);
      // console.log(this.myCoordinates);
      try {
        const coordsCurrent = await api.put(`coordinates/update.php`, {
          id_user: id,
          lat: this.myCoordinates[1],
          lng: this.myCoordinates[0],
        },{
          headers: {
            "Access-Control-Allow-Origin": "*",
            "Access-Control-Allow-Headers": "*",
            "Authorization": localStorage.getItem("token")
          }
        });
        console.log(coordsCurrent);
        // localStorage.setItem("coordinates", coordsCurrent.data.coordinates);
      } catch (error) {}
    },
  },

  computed: {
    enterprise() {
      if (JSON.parse(localStorage.getItem("enterprise")) != null)
        return JSON.parse(localStorage.getItem("enterprise"));
      else return false;
    },
  },

  created() {
    this.mapbox = Mapbox;
    this.user = JSON.parse(localStorage.getItem("user"));

    this.updateCoordinatesUser(this.user.id_usuario);
    // this.getCoordinatesCurrent();
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
