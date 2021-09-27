<template>
  <!-- https://www.bootdey.com/snippets/view/User-Profile-with-tabs -->
  <div id="user-profile-2" 
  class="container user-profile mt-2 bg-white"
    style="box-shadow: 0px 2px 15px 2px rgba(0, 0, 0, 0.2)">
    <div class="tabbable">
      <div class="tab-content no-border padding-24">
        <div id="home" class="tab-pane in active">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 center">
              <h4 class="blue">
                <span class="middle">{{ nameComplete }}</span>

                <span
                  v-if="online.online == true"
                  class="label label-purple arrowed-in-right"
                >
                  <i
                    class="ace-icon fa fa-circle smaller-80 align-middle"
                    style="color: #90ee90"
                  ></i>
                  online
                </span>
                <span v-else class="label label-purple arrowed-in-right">
                  <i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
                  offline
                </span>
              </h4>
              <span class="profile-picture">
                <img
                  :src="user.avatar"
                  width="300"
                  height="300"
                  alt="avatar"
                  style="
                    background-color: blue;
                    border-radius: 50%;
                    box-shadow: 1px 1px 3px black;
                  "
                />
              </span>

              <div class="space space-4"></div>

              <button
                v-if="follow == false"
                href="#"
                class="btn btn-sm btn-block btn-success my-2"
                @click="likeDislike(user.id_user)"
              >
                <i class="ace-icon fa fa-plus-circle bigger-120"></i>
                <span class="bigger-110"> Follow as a friend</span>
              </button>

              <button
                v-else
                class="btn btn-sm btn-block btn-primary my-2"
                @click="likeDislike(user.id_user)"
              >
                <i class="ace-icon fa fa-heart bigger-120"></i>
                <span class="bigger-110"> Following</span>
              </button>

              <div class="space-20"></div>

              <div class="row">
                <div class="col-xs-12 col-sm">
                  <div class="widget-box transparent">
                    <div class="widget-header widget-header-small">
                      <h4 class="widget-title smaller">
                        <i class="ace-icon fa fa-check-square-o bigger-110"></i>
                        Little About Me
                      </h4>
                    </div>

                    <div class="widget-body">
                      <div class="widget-main">
                        <p>
                          {{ user.bio }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div v-if="history" class="row">
                <div class="col-xs-12 col-sm">
                  <div class="widget-box transparent">
                    <div class="widget-header widget-header-small">
                      <h4 class="widget-title smaller">
                        <i class="ace-icon fa fa-check-square-o bigger-110"></i>
                        History
                      </h4>
                    </div>

                    <div class="widget-body">
                      <div class="widget-main">
                        <p>
                          {{ history.description }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->

            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="profile-user-info">
                <div class="profile-info-row">
                  <div class="profile-info-name">Username</div>

                  <div class="profile-info-value">
                    <span>{{ nameComplete }}</span>
                  </div>
                </div>

                <div
                  v-if="from.city != '' && from.country != ''"
                  class="profile-info-row"
                >
                  <div class="profile-info-name">From</div>

                  <div class="profile-info-value">
                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                    <span>{{ from.city }}</span>
                    <span>{{ from.country }}</span>
                  </div>
                </div>

                <div class="profile-info-row">
                  <div class="profile-info-name">Age</div>

                  <div class="profile-info-value">
                    <span>{{ age }}</span>
                  </div>
                </div>

                <div class="profile-info-row">
                  <div class="profile-info-name">Joined</div>

                  <div class="profile-info-value">
                    <span>{{ joined }}</span>
                  </div>
                </div>

                <div v-if="online.online == false" class="profile-info-row">
                  <div class="profile-info-name">Last Online</div>

                  <div class="profile-info-value">
                    <span>{{ online.time }} ago</span>
                  </div>
                </div>
              </div>

              <div v-if="enterprise != null">
                <hr />
                <div class="profile-user-info">
                  <div class="profile-info-row">
                    <div class="profile-info-name">Enterprise</div>
                    <ul
                      class="profile-info-value text-justify"
                      style="list-style:none;"
                    >
                      <li><b>Name: </b> {{ enterprise.fantasy_name }}</li>
                      <li v-if="user.phone">
                        <b>Phone: </b> {{ user.phone }}
                        <a
                          class="btn btn-info btn-sm"
                          :href="'tel:' + user.phone"
                          ><i class="fas fa-phone-alt"></i> call</a
                        >
                      </li>
                      <li><b>Description: </b> {{ enterprise.description }}</li>
                      <li><b>Sell for:</b> {{ enterprise.enterprise_type }}</li>
                    </ul>
                  </div>

                  <div v-if="address != null">
                    <div class="profile-info-name">
                      Address
                    </div>
                    <ul
                      class="profile-info-value text-justify"
                      style="list-style:none;"
                    >
                      <li><b>Address: </b> {{ address.street }}</li>
                      <li><b>Number: </b> {{ address.number }}</li>
                      <li v-if="address.complement != ''">
                        <b>Complement: </b> {{ address.complement }}
                      </li>
                      <li><b>District:</b> {{ address.district }}</li>
                      <li><b>City:</b> {{ address.city }}</li>
                      <li><b>State:</b> {{ address.state }}</li>
                      <li><b>Country:</b> {{ address.country }}</li>
                    </ul>
                  </div>
                </div>
              </div>
              <hr />
              <div v-if="social_networks">
                <div class="hr hr-8 dotted font-weight-bold">Find me in</div>

                <div
                  v-for="sn in social_networks"
                  :key="sn.id_social_network"
                  class="profile-user-info"
                >
                  <div class="profile-info-row">
                    <!-- <div class="profile-info-name">
                      <i :class="sn.icon" aria-hidden="true"></i>
                    </div> -->
                    <div class="profile-info-value">
                      <a :href="sn.link" target="_blank">{{ sn.name }}</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /#home -->
      </div>
    </div>
  </div>
</template>

<script>
import api from "../service/api";
export default {
  data: () => ({
    user: {},
    online: "",
    history: "",
    social_networks: "",
    follow: Boolean,
    from: {
      city: "",
      country: "",
    },
    address: null,
    enterprise: null,
  }),

  computed: {
    nameComplete() {
      return this.user.name + " " + this.user.lastname;
    },

    age() {
      var birthday = this.user.birthday;

      var currentDate = new Date();
      var currentYear = currentDate.getFullYear();
      var yearMounthDay = birthday.split("-");
      var day = yearMounthDay[2];
      var mounth = yearMounthDay[1];
      var year = yearMounthDay[0];

      var age = currentYear - year;
      var currentMounth = currentDate.getMonth() + 1;
      //Se mes atual for menor que o nascimento, nao fez aniversario ainda;
      if (currentMounth < mounth) {
        age--;
      } else {
        //Se estiver no mes do nascimento, verificar o dia
        if (currentMounth == mounth) {
          if (new Date().getDate() < day) {
            //Se a data atual for menor que o dia de nascimento ele ainda nao fez aniversario
            age--;
          }
        }
      }
      return age;
    },

    joined() {
      var created = this.user.created.split(" ");

      var time = created[1];
      var date = created[0];

      return date;
    },
  },

  methods: {
    async getStatusOnline(id) {
      var { data } = await api.get(`session/show.php?id=${id}`);
      console.log(data)
      this.online = data;      
    },

    // Seguir/Desseguir usuário
    async likeDislike(id) {
      await api.get(`user/follow.php?id=${id}`);
      this.getFollow(id);
    },

    // Verifica se você segue esse usuário
    async getFollow(id) {
      var follow = await api.get(`user/getFollow.php?id=${id}`);
      this.follow = follow.data;
    },
  },

  async created() {
    const id = this.$route.params.id;

    const user = await api.get(`user/show.php?id=${id}`);
    const history = await api.get(`history/show.php?id=${id}`);
    const social_networks = await api.get(`social-network/index.php?id=${id}`);

    if (user.data.user.businessman == 1 && user.data.user.id_enterprise != "") {
      const enterprise = await api.get(
        `enterprise/show.php?id=${user.data.user.id_enterprise}`
      );
      this.enterprise = enterprise.data;

      if (
        enterprise.data.id_address != "" &&
        enterprise.data.id_address != null
      ) {
        const address = await api.get(
          `address/show.php?id=${enterprise.data.id_address}`
        );
        this.address = address.data;
      }
    }

    this.user = user.data.user;
    this.from.city = user.data.user.city;
    this.from.country = user.data.user.country;
    this.history = history.data.history;
    this.social_networks = social_networks.data;

    if (this.social_networks.empty == true) {
      this.social_networks = false;
    }

    var { data } = await api.get(`session/show.php?id=${id}`);    
    this.online = data;

    this.getFollow(id);

    this.getStatusOnline(id);

    setInterval(() => {
      this.getStatusOnline(id);
    }, 100000);
  },
};
</script>

<style>
.align-center,
.center {
  text-align: center !important;
}

.profile-user-info {
  display: table;
  width: 98%;
  width: calc(100% - 24px);
  margin: 0 auto;
}

.profile-info-row {
  display: table-row;
}

.profile-info-name,
.profile-info-value {
  display: table-cell;
  border-top: 1px dotted #d5e4f1;
}

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
  padding: 6px 4px 6px 6px;
}

.profile-info-value > span + span:before {
  display: inline;
  content: ",";
  margin-left: 1px;
  margin-right: 3px;
  color: #666;
  border-bottom: 1px solid #fff;
}

.profile-info-value > span + span.editable-container:before {
  display: none;
}

.profile-info-row:first-child .profile-info-name,
.profile-info-row:first-child .profile-info-value {
  border-top: none;
}

.profile-user-info-striped {
  border: 1px solid #dcebf7;
}

.profile-user-info-striped .profile-info-name {
  color: #336199;
  background-color: #edf3f4;
  border-top: 1px solid #f7fbff;
}

.profile-user-info-striped .profile-info-value {
  border-top: 1px dotted #dcebf7;
  padding-left: 12px;
}

/* .profile-picture {
  border: 1px solid #ccc;
  background-color: #fff;
  padding: 4px;
  display: inline-block;
  max-width: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15);
} */
</style>
