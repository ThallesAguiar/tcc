<template>
  <MglMap :accessToken="accessToken" :mapStyle="mapStyle">
    <MglNavigationControl position="top-right" />
    <MglGeolocateControl
      position="top-right"
      :trackUserLocation="true"
      :showUserLocation="false"
    />
    <MglMarker :coordinates="myCoordinates">
      <div slot="marker">
        <img
          style="border-radius: 50%; width: 50px; height: 50px"
          :src="user.avatar"
        />
      </div>

      <MglPopup anchor="bottom">
        <button type="button" class="btn btn-link" @click="visitProfile()">
        {{ user.nome+' '+user.sobrenome }}
        </button>
      </MglPopup> 
    </MglMarker>
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
  MglMarker,
} from "vue-mapbox";

export default {
  components: {
    MglMap,
    MglNavigationControl,
    MglGeolocateControl,
    MglFullscreenControl,
    MglPopup,
    MglMarker,
  },
  data() {
    return {
      accessToken:
        "pk.eyJ1Ijoic29jaWFsbWF0ZSIsImEiOiJja3E5bGdpcHEwNXMzMnBzMTZpeTRrZDk5In0.0ru5SvtMtBqp8gMH8Zh3vQ",
      mapStyle: "mapbox://styles/mapbox/streets-v11",
      myCoordinates: JSON.parse(localStorage.getItem("coordinates")),
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
          console.log(coord);
          this.myCoordinates = coord;
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
      
      this.getCoordinatesCurrent();

      try {
        const coordsCurrent = await api.put(
          `coordinates/update.php`,
          {
            id_user: id,
            lat: this.myCoordinates[1],
            lng: this.myCoordinates[0],
          },
          {
            headers: {
              "Access-Control-Allow-Origin": "*",
              "Access-Control-Allow-Headers": "*",
              Authorization: localStorage.getItem("token"),
            },
          }
        );
        console.log(coordsCurrent.data.coordenadas);
      } catch (error) {}
    },

    visitProfile(){
      console.log("visitar perfil");
    }
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
    
    setInterval(function () {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const { latitude, longitude } = position.coords;

          const coord = Object.values({ longitude, latitude });

          if (!localStorage.getItem("coordinates"))
            localStorage.setItem("coordinates", JSON.stringify(coord));
          console.log(coord);
          this.myCoordinates = coord;
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
    }, 30000);
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
