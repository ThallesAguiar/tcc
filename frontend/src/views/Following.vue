<template>
  <div
    class="container mt-2 bg-white"
    style="box-shadow: 0px 2px 15px 2px rgba(0, 0, 0, 0.2)"
  >
    <span class="h6 font-weight-bold">following ({{ youFollow.total }})</span>
    <div class="row">
      <div id="friends">
        <div class="profile-users">
          <div
            class="memberdiv"
            v-for="following in youFollow.users"
            :key="following.id_user"
          >
            <router-link :to="'/friend/' + following.id_user">
              <div class="user">
                <img :src="following.avatar" alt="Following's avatar" />
                <div class="body">
                  <div class="name">
                    {{ following.nameComplete }}
                  </div>
                </div>
              </div>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "../service/api";
export default {
  data: () => ({
    youFollow: "",
  }),

  methods: {
    async following() {
      var following = await api.get(`user/following.php`);
      // console.log("following", following.data);
      this.youFollow = following.data;
    },
  },

  created() {
    this.following();
  },
};
</script>

<style scoped>
.profile-info-name {
  text-align: right;
  padding: 6px 10px 6px 4px;
  font-weight: 400;
  color: #667e99;
  background-color: transparent;
  width: 110px;
  vertical-align: middle;
}

.profile-info-value {
  /* padding: 6px 4px 6px 6px; */
  padding: 6px 121px 6px 0px;
}

.profile-info-row:first-child .profile-info-name,
.profile-info-row:first-child .profile-info-value {
  border-top: none;
}

.profile-users .user img {
  padding: 2px;
  border-radius: 100%;
  border: 1px solid #aaa;
  max-width: none;
  width: 64px;
  -webkit-transition: all 0.1s;
  -o-transition: all 0.1s;
  transition: all 0.1s;
}

.profile-users .user img:hover {
  -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.33);
  box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.33);
}

.profile-users .memberdiv {
  display: inline-block;
  /* background-color: #fff; */
  width: 150px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  border: none;
  text-align: center;
  margin: 0 8px 24px;
}
</style>
