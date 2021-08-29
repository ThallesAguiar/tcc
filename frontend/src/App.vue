<template>
  <div id="app">
    <transition name="slide" mode="out-in">
      <router-view />
    </transition>
  </div>
</template>

<script>
import api from "./service/api";
export default {
  created() {
    const login = localStorage.getItem("login");
    // console.log(login)

    if(login == 'true'){
      setInterval(async function () {
        const { id_user } = JSON.parse(localStorage.getItem("user"));
        // console.log(id_user)
        await api.put(`session/update.php?id=${id_user}`);
        console.log('Voce esta logado')
      }, 300000);
    }
  },
};
</script>

<style>
#app {
  font-family: Roboto, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
