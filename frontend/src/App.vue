<template>
  <div id="app">
    <transition name="slide" mode="out-in">
    <router-view />
    </transition>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  // created() {
  //   axios.interceptors.request.use(
  //     async (config) => {
  //       const token = await localStorage.getItem("token");
  //       config.headers.Authorization = `${token}`;
        
  //       console.log(config);
  //       return config;
  //     },
  //     (error) => {
  //       return Promise.reject(error);
  //     }
  //   );
  // },
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
