<template>
  <div class="container">
    <div class="row">
      <div class="col-4 mt-4">
        <img v-if="user.genero == 'F'" src="../assets/chapeu-prenda.png" width="120" style="position: absolute; left:-10px; top:-30px; transform: rotate(340deg);"  alt="chapeu">
        <img
          :src="user.avatar"
          width="100"
          height="100"
          alt="avatar"
          style="border-radius:50%; box-shadow: 1px 1px 3px black;"
        />
        <img v-if="user.genero == 'M'" src="../assets/lenco-gaucho.png" width="100" style="position: absolute; left:10px; top:65px; z-index: -1"  alt="lenco">
      </div>
      <div class="col-8 text-left">
        <div class="mt-4 font-weight-bold h4">
          {{ user.nome + user.sobrenome }}
        </div>
        <small>{{user.biografia}}</small>
      </div>

      <!-- <div class="col-12 mt-2">
        <p>
        {{user.biografia}}
        </p>
      </div> -->

      <div class="col-12 mt-3">
        <div class="p-3 rounded text-white" style="background-color: rgba(0,0,0,0.6)">
          Meus desassossegos sentam na varanda, pra matear saudade nesta solidão.
        </div>
      </div>
      
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({}),

  computed: {
    user() {
      return JSON.parse(localStorage.getItem("user"));
    },
  },
};
</script>

<style></style>
