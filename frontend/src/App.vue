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
    setInterval(async function () {
      const { id_user } = localStorage.getItem("user")
        ? JSON.parse(localStorage.getItem("user"))
        : "";
      await api.put(`session/update.php?id=${id_user}`);
      console.log("ta on");
    }, 100000);
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
