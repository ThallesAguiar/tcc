<template>
  <div>
    <!-- <div
      class="row "
      style="z-index:1; position: absolute; top:10%; margin:auto; width:100%;"
    >
      <div class="col"></div>
      <div class="col-8 col-md-4">
        <div class="input-group mb-3">
          <input
            type="text"
            class="form-control"
            placeholder="Search for ..."
            aria-label="Search for ..."
            aria-describedby="button-addon2"
          />
          <div class="input-group-append">
            <button class="btn btn-info" type="button" id="button-addon2">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="col"></div>
    </div> -->
    <transition name="slide" mode="out-in">
      <div
        v-if="loading"
        class="row align-items-center"
        style="
          position: absolute;
          left: 10px;
          z-index: 8;
          width: 100%;
          height: 90vh;
          background-color: rgba(0, 0, 0, 0.2);
        "
      >
        <img
          src="../assets/loading.gif"
          alt="Searching users"
          class="img-fluid"
          style="margin: auto"
        />
      </div>
    </transition>
    <button
      type="button"
      style="z-index: 7; width: 50px; position: absolute; top: 150px; right: 5px"
      class="btn btn-light"
      @click="activeSearchUsers()"
    >
      <i class="fa fa-users"></i>
      <i class="fa fa-search fa-sm"></i>
    </button>

    <MglMap
      :accessToken="accessToken"
      :mapStyle="mapStyle"
      :center="myCoordinates"
      hash
    >
      <MglGeolocateControl
        position="top-right"
        :trackUserLocation="true"
        :showUserLocation="false"
      />

      <!-- Usuario logado -->
      <MglMarker :coordinates="myCoordinates">
        <div slot="marker" style="z-index: 5">
          <div>
            <img
              style="border-radius: 50%; width: 50px; height: 50px"
              :src="user.avatar"
            />
          </div>
        </div>

        <MglPopup anchor="bottom">
          <button type="button" class="btn btn-link">
            {{ nameComplete }}
          </button>
        </MglPopup>
      </MglMarker>
      <!-- ./Usuario logado -->

      <!-- Markers -->
      <MglMarker
        v-for="marker in markers"
        :key="marker.id_user"
        :coordinates="[marker.lng, marker.lat]"
      >
        <div slot="marker" style="z-index: 1">
          <div>
            <img
              style="border-radius: 50%; width: 50px; height: 50px"
              :src="marker.avatar"
            />
          </div>
        </div>

        <MglPopup anchor="bottom">
          <button
            type="button"
            class="btn btn-link nav-link"
            @click="visitProfile(marker.id_user)"
          >
            {{ marker.nameComplete }} <br />
            <small>{{ marker.distance + " " + unit + " away" }}</small>
          </button>
        </MglPopup>
      </MglMarker>
      <!-- ./Markers -->
    </MglMap>
  </div>
</template>

<script>
import api from "../service/api";
import Mapbox from "mapbox-gl";
import "mapbox-gl/dist/mapbox-gl.css";
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
      markers: [],
      unit: "",
      range: "",
      loading: false,
    };
  },

  methods: {
    async updateCoordinatesUser(id) {
      setInterval(async function() {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const { latitude, longitude } = position.coords;

            const coord = Object.values({ longitude, latitude });

            // if (!localStorage.getItem("coordinates"))
            localStorage.setItem("coordinates", JSON.stringify(coord));
            // console.log(coord);
            this.myCoordinates = coord;
            console.log(this.myCoordinates);
          },
          (err) => {
            console.log(err);
          },
          {
            timeout: 100000,
            enableHighAccuracy: true, //pega a localização via GPS
            maximumAge: 1000, //como se fosse um cache, pra guardar a localização do GPS
          }
        );

        try {
          const coordsCurrent = await api.put(`coordinates/update.php`, {
            id_user: id,
            lat: this.myCoordinates[1],
            lng: this.myCoordinates[0],
          });

          // console.log(coordsCurrent.data);
        } catch (error) {}
      }, 300000);
    },

    visitProfile(id) {
      this.$router.push(`/friend/${id}`);
    },

    async searchUsers() {
      this.loading = true;
      const { id_user } = this.user;
      const lat = this.myCoordinates[1];
      const lng = this.myCoordinates[0];
      const range = localStorage.getItem("range")
        ? localStorage.getItem("range")
        : 10;
      const unit = localStorage.getItem("unit")
        ? localStorage.getItem("unit")
        : "kilometres";

      try {
        const usersForRange = await api.get(
          `search/index.php?id=${id_user}&lat=${lat}&lng=${lng}&range=${range}&unit=${unit}`
        );
        // console.log(usersForRange);
        this.markers = usersForRange.data.markers;
        this.unit = usersForRange.data.unit;
        this.range = usersForRange.data.range;
      } catch (error) {
        console.log(error);
      }

      // setTimeout(() => {
      this.loading = false;
      // }, 2000);
    },

    activeSearchUsers() {
      this.searchUsers();

      setInterval(() => {
        this.searchUsers();
      }, 500000);
    },
  },

  computed: {
    enterprise() {
      if (JSON.parse(localStorage.getItem("enterprise")) != null)
        return JSON.parse(localStorage.getItem("enterprise"));
      else return false;
    },

    nameComplete() {
      const user = JSON.parse(localStorage.getItem("user"));
      return user.name + " " + user.lastname;
    },
  },

  created() {
    this.mapbox = Mapbox;
    this.user = JSON.parse(localStorage.getItem("user"));

    this.updateCoordinatesUser(this.user.id_user);

    // coordenadas
    navigator.geolocation.getCurrentPosition(
      (position) => {
        const { latitude, longitude } = position.coords;

        const coord = Object.values({ longitude, latitude });

        localStorage.setItem("coordinates", JSON.stringify(coord));
      },
      (err) => {
        console.log(err);
      },
      {
        enableHighAccuracy: true, //pega a localização via GPS
        maximumAge: 1000, //como se fosse um cache, pra guardar a localização do GPS
      }
    ); //. coordenadas
  },
};
</script>

<style>
.mgl-map-wrapper {
  height: 90vh;
}
body {
  margin: 0;
  padding: 0;
}
</style>
