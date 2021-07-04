<template>
  <div>
    <nav
      class="navbar navbar-expand-lg navbar-dark"
      style="background-color: teal; z-index:9"
    >
      <a class="navbar-brand font-weight-bold" href="#"
        ><img
          src="../assets/cuia-branca.svg"
          width="30"
          style="position: absolute; left:0; top:5px"
          alt="logo"
        />
        Mateship</a
      >

      <button
        to="profile"
        class="navbar-toggler"
        type="button"
        @click="dropdownMenu = !dropdownMenu"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div
        v-if="dropdownMenu"
        class="p-1"
        style="position:absolute; z-index:1; border-radius:4px; top:50px; right:0; background-color: teal; width:100%;"
      >
        <router-link
          v-for="menu in menus"
          :key="menu.name"
          :to="menu.route"
          class="navbar-toggler mx-3 text-white btn btn-link"
          type="button"
        >
          <span :class="menu.icon"></span>
          <br />
          {{ menu.name }}
        </router-link>
      </div>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#"
              >Home <span class="sr-only">(Página atual)</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Destaques</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Preços</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Desativado</a>
          </li>
        </ul>
      </div>
    </nav>

      <router-view></router-view>
  </div>
</template>

<script>
export default {
  data: () => ({
    navbar: false,
    dropdownMenu: false,
    menus: [
      // { name: "feed", route: "/feed", icon: "fa fa-id-badge" },
      {name:"home", route:"/feed", icon:"fa fa-home"},
      { name: "map", route: "/map", icon: "fa fa-globe-americas" },
      { name: "config", route: "/config", icon: "fa fa-cog" },
    ],
  }),
};
</script>

<style>
body{
  background-color: #efef;
}
</style>
