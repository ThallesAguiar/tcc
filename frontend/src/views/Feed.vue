<template>
  <div class="container">
    <div class="row">
      <div class="col-xs-4 mt-4">
        <img
          :src="user.avatar"
          width="150"
          height="150"
          alt="avatar"
          style="background-color: blue; border-radius:50%; box-shadow: 1px 1px 3px black;"
        />
        <img v-if="user.gender == 'F'" src="../assets/chapeu-prenda.png" width="130" style="position: relative; left:-55%; top:-50%; z-index: 0; transform: rotate(350deg);"  alt="chapeu">
        <img v-if="user.gender == 'M'" src="../assets/chapeu-gaucho.png" width="110" style="position: relative; left:-55%; top:-50%; z-index: 0; transform: rotate(350deg);"  alt="chapeu">
        <!-- <img v-if="user.gender == 'M'" src="../assets/lenco-gaucho.png" width="120" style="position: relative; left:-55%; top:65%; z-index: -1"  alt="lenco"> -->
      </div>
      <div class="col">
        <div style="background-color: rgba(0,0,0,0.4)" class="mt-5 p-2 font-weight-bold text-white rounded">
          <h2>{{ user.name +" "+ user.lastname }}</h2>
          <br>
        <small>{{user.email}}</small>
        </div>
      </div>

      <div class="col-12 mt-3">
        <div class="p-3 rounded text-white" style="background-color: rgba(0,0,0,0.6)">
          Meus desassossegos sentam na varanda, pra matear saudade nesta solidão.
        </div>
      </div>
      
    </div>
  </div>
</template>

<script>
import api from '../service/api';

export default {
  data: () => ({
    hat: true
  }),

  computed: {
    user() {
      return JSON.parse(localStorage.getItem("user"));
    },
  },
};
</script>

<style></style>
