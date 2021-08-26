<template>
  <!-- https://www.bootdey.com/snippets/view/User-Profile-with-tabs -->
  <div id="user-profile-2" class="container-fluid user-profile pt-2">
    <div class="tabbable">
      <div class="tab-content no-border padding-24">
        <div id="home" class="tab-pane in active">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 center">
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

              <router-link
                to="/"
                class="btn btn-sm btn-secondary my-2 mx-2"
                type="button"
              >
                <i class="ace-icon fa fa-sign-out-alt bigger-120"></i>
                <span class="bigger-110"> Logout </span>
              </router-link>

              <button class="btn btn-sm btn-primary my-2 mx-2">
                <i class="ace-icon fa fa-cog bigger-120"></i>
                <span class="bigger-110"> Update </span>
              </button>
            </div>
            <!-- /.col -->

            <div class="col-xs-12 col-sm-12 col-md-6">
              <h4 class="blue">
                <span class="middle">{{ nameComplete }}</span>
              </h4>

              <div class="profile-user-info">
                <!-- <div class="profile-info-row">
                  <div class="profile-info-name">Username</div>

                  <div class="profile-info-value">
                    <span>{{ nameComplete }}</span>
                  </div>
                </div> -->

                <div class="profile-info-row">
                  <div class="profile-info-name">
                    From
                    <div v-if="from != null" class="profile-info-name">
                      <button
                        class="p-1 ml-1 btn btn-warning btn-sm"
                        @click="updateModal(), (typeModal = 'from')"
                      >
                        <i class="fa fa-edit"></i>
                      </button>
                      <button
                        class="p-1 ml-1 btn btn-danger btn-sm"
                        @click="deleteSocialNetwork()"
                      >
                        <i class="fa fa-trash"></i>
                      </button>
                    </div>
                    <div v-else class="profile-info-name">
                      <button
                        type="button"
                        @click="
                          (showModal = true),
                            (typeModal = 'from'),
                            (btn = 'save')
                        "
                        class="btn btn-success btn-sm"
                      >
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                  </div>

                  <div v-if="from != null" class="profile-info-value">
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

                <!-- <div class="profile-info-row">
                  <div class="profile-info-name">Joined</div>

                  <div class="profile-info-value">
                    <span>{{ joined }}</span>
                  </div>
                </div> -->
              </div>

              <div class="my-5">
                <div v-if="social_networks">
                  <div class="hr hr-8 dotted font-weight-bold">Find me in</div>

                  <div
                    v-for="sn in social_networks"
                    :key="sn.id_social_network"
                    class="profile-user-info"
                  >
                    <div class="profile-info-row">
                      <div class="profile-info-name">
                        <button
                          class="p-1 ml-1 btn btn-warning btn-sm"
                          @click="
                            updateModal(sn.id_social_network),
                              (typeModal = 'SN'),
                              (btn = 'update')
                          "
                        >
                          <i class="fa fa-edit"></i>
                        </button>
                        <button
                          class="p-1 ml-1 btn btn-danger btn-sm"
                          @click="
                            deleteSocialNetwork(sn.id_social_network, sn.name)
                          "
                        >
                          <i class="fa fa-trash"></i>
                        </button>
                      </div>

                      <div class="profile-info-value">
                        <i :class="sn.icon"></i>
                        <a :href="sn.link" target="_blank">{{ sn.name }} </a>
                      </div>
                    </div>
                  </div>

                  <div class="profile-info-name">
                    Add
                    <button
                      type="button"
                      @click="
                        (showModal = true), (typeModal = 'SN'), (btn = 'save')
                      "
                      class="btn btn-success btn-sm"
                    >
                      <i class="fa fa-plus"></i>
                    </button>
                  </div>

                  <div class="profile-info-value">...</div>
                </div>
                <div v-else>
                  <div class="hr hr-8 dotted font-weight-bold">
                    Adicione as suas redes sociais
                  </div>

                  <div class="profile-user-info">
                    <div class="profile-info-row">
                      <div class="profile-info-name">
                        Add
                        <button
                          type="button"
                          @click="
                            (showModal = true),
                              (typeModal = 'SN'),
                              (btn = 'save')
                          "
                          class="btn btn-success btn-sm"
                        >
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>

                      <div class="profile-info-value">...</div>
                    </div>
                  </div>
                </div>

                <div class="container mt-5">your friends</div>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="space-20"></div>

          <div class="row">
            <div class="col-xs-12 col-sm-6">
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
            <div class="col-xs-12 col-sm-6">
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
                      {{ history }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /#home -->
      </div>
    </div>

    <!-- MODAL -->
    <transition name="fade">
      <div v-if="showModal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog" role="document">
              <div v-if="typeModal == 'SN'" class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Social Networks</h5>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span
                      aria-hidden="true"
                      @click="(showModal = false), (typeSN = -1)"
                      >&times;</span
                    >
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group my-5">
                    <label for="sn">Select a social network</label>
                    <select
                      id="sn"
                      class="form-control form-control"
                      v-model="typeSN"
                    >
                      <option selected disabled>Select a Social Network</option>
                      <option
                        v-for="network in networks"
                        :key="network.value"
                        :value="network.value"
                      >
                        {{ network.name }}
                      </option>
                    </select>
                  </div>

                  <div v-if="typeSN == 0" class="form-group my-5">
                    <label for="country">Select your country</label>
                    <select
                      id="country"
                      class="custom-select mr-sm-2"
                      v-model="dialCode"
                    >
                      <option disabled selected>
                        Select your code country
                      </option>
                      <option
                        v-for="country in countries"
                        :key="country.name"
                        :value="country.dialCode"
                      >
                        {{ country.dialCode }} - {{ country.name }}
                      </option>
                    </select>
                    <label class="mt-4" for="link_sn"
                      >What's your WhatsApp?</label
                    >
                    <input
                      v-model="link_sn"
                      type="text"
                      class="form-control"
                      id="link_sn"
                      placeholder="(DDD) (Number)"
                    />
                  </div>

                  <div v-if="typeSN == 1" class="form-group my-5">
                    <label for="link_sn">cole aqui o link do grupo</label>
                    <input
                      v-model="link_sn"
                      type="text"
                      class="form-control"
                      id="link_sn"
                      placeholder="Group's link"
                    />
                  </div>

                  <div v-if="typeSN == 2" class="form-group my-5">
                    <label for="link_sn">What's your username</label>
                    <input
                      v-model="link_sn"
                      type="text"
                      class="form-control"
                      id="link_sn"
                      placeholder="Instagram's username"
                    />
                  </div>

                  <div v-if="typeSN == 3" class="form-group my-5">
                    <label for="link_sn">What's your username</label>
                    <input
                      v-model="link_sn"
                      type="text"
                      class="form-control"
                      id="link_sn"
                      placeholder="Facebook's username"
                    />
                  </div>

                  <div v-if="typeSN == 4" class="form-group my-5">
                    <label for="link_sn">Twitter</label>
                    <input
                      v-model="link_sn"
                      type="text"
                      class="form-control"
                      id="link_sn"
                      placeholder="@john_rambo"
                    />
                  </div>

                  <div v-if="typeSN == 5" class="form-group my-5">
                    <label for="link_sn">Paste here your link site</label>
                    <input
                      v-model="link_sn"
                      type="text"
                      class="form-control"
                      id="link_sn"
                      placeholder="Site's link"
                    />
                  </div>

                  <div v-if="typeSN == 6" class="form-group my-5">
                    <label for="link_sn">E-mail</label>
                    <input
                      v-model="link_sn"
                      type="email"
                      class="form-control"
                      id="link_sn"
                      placeholder="Your e-mail"
                    />
                  </div>

                  <div v-if="typeSN == 7" class="form-group my-5">
                    <label for="link_sn">Other social network</label>
                    <input
                      v-model="link_sn"
                      type="text"
                      class="form-control"
                      id="link_sn"
                      placeholder="Paste link here"
                    />
                  </div>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    @click="(showModal = false), (typeSN = -1)"
                  >
                    Close
                  </button>
                  <button
                    v-if="btn == 'save'"
                    type="button"
                    class="btn btn-primary"
                    @click="addSocialNetwork(typeSN)"
                  >
                    Save changes
                  </button>

                  <button
                    v-if="btn == 'update'"
                    type="button"
                    class="btn btn-warning"
                    @click="updateSocialNetwork(typeSN)"
                  >
                    Update changes
                  </button>
                </div>
              </div>
              <div v-if="typeModal == 'from'" class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Where are you from?</h5>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span
                      aria-hidden="true"
                      @click="(showModal = false), (typeSN = -1)"
                      >&times;</span
                    >
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group my-5">
                    <label for="sn">Select a social network</label>
                    <select
                      id="sn"
                      class="form-control form-control"
                      v-model="typeSN"
                    >
                      <option selected disabled>Select a Social Network</option>
                      <option
                        v-for="network in networks"
                        :key="network.value"
                        :value="network.value"
                      >
                        {{ network.name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    @click="(showModal = false), (typeSN = -1)"
                  >
                    Close
                  </button>
                  <button
                    v-if="btn == 'save'"
                    type="button"
                    class="btn btn-primary"
                    @click="addSocialNetwork(typeSN)"
                  >
                    Save changes
                  </button>

                  <button
                    v-if="btn == 'update'"
                    type="button"
                    class="btn btn-warning"
                    @click="updateSocialNetwork(typeSN)"
                  >
                    Update changes
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import countries from "../data/countries.json";
import api from "../service/api";
export default {
  data: () => ({
    user: {},
    history: "",
    social_networks: "",
    follow: false,
    modal: false,
    showModal: false,
    typeSN: -1,
    networks: [
      { name: "WhatsApp", value: 0, icon: "fa fa-whatsapp" },
      { name: "Grupo WhatsApp", value: 1, icon: "fa fa-whatsapp" },
      { name: "Instagram", value: 2, icon: "fa fa-instagram" },
      { name: "Facebook", value: 3, icon: "fa fa-facebook" },
      { name: "Twitter", value: 4, icon: "fa fa-twitter" },
      { name: "Site", value: 5, icon: "fa fa-globe" },
      { name: "E-mail", value: 6, icon: "fa fa-at" },
      { name: "Outro", value: 7, icon: "fa fa-paste" },
    ],
    countries: countries,
    dialCode: "",
    link_sn: "",
    btn: "",
    id_sn: "",
    from: "",
    typeModal: "",
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
  },

  methods: {
    // Verifica se você segue esse usuário
    async friends(id) {
      var follow = await api.get(`user/following.php?id=${id}`);
      this.follow = follow.data;
    },

    async addSocialNetwork(value) {
      if (value == 0) {
        var link = `https://api.whatsapp.com/send/?phone=${
          this.dialCode + this.link_sn
        }`;
      } else if (value == 1 || value == 5 || value == 6 || value == 7) {
        var link = this.link_sn;
      } else if (value == 2) {
        var link = `https://www.instagram.com/${this.link_sn}`;
      } else if (value == 2) {
        var link = `https://www.facebook.com/${this.link_sn}`;
      } else if (value == 4) {
        var link = `https://twitter.com/${this.link_sn}`;
      }

      await api.post(`social-network/store.php`, {
        name: this.networks[value].name,
        link,
        icon: this.networks[value].icon,
      });

      this.getSocialNetworks();
      this.showModal = false;
      this.typeSN = -1;
      this.link_sn = "";
      this.btn = "";
    },

    async updateSocialNetwork(value) {
      if (value == 0) {
        var link = `https://api.whatsapp.com/send/?phone=${
          this.dialCode + this.link_sn
        }`;
      } else if (value == 1 || value == 5 || value == 6 || value == 7) {
        var link = this.link_sn;
      } else if (value == 2) {
        var link = `https://www.instagram.com/${this.link_sn}`;
      } else if (value == 2) {
        var link = `https://www.facebook.com/${this.link_sn}`;
      } else if (value == 4) {
        var link = `https://twitter.com/${this.link_sn}`;
      }

      await api.put(`social-network/update.php`, {
        id: this.id_sn,
        name: this.networks[value].name,
        link,
        icon: this.networks[value].icon,
      });

      this.getSocialNetworks();
      this.showModal = false;
      this.typeSN = -1;
      this.link_sn = "";
      this.btn = "";
      this.id_sn = "";
    },

    async getSocialNetworks() {
      const social_networks = await api.get(
        `social-network/index.php?id=${this.user.id_user}`
      );
      this.social_networks = social_networks.data;

      if (this.social_networks.empty == true) {
        this.social_networks = false;
      }
    },

    async deleteSocialNetwork(id, name) {
      var resposta = confirm("Deseja excluir seu " + name + "?");
      if (resposta == true) {
        await api.delete(`social-network/delete.php?id=${id}`);
        this.getSocialNetworks();
      }
    },

    async updateModal(id) {
      const { data } = await api.get(`social-network/show.php?id=${id}`);

      if (data.name == "WhatsApp") {
        this.typeSN = 0;
      } else if (data.name == "Grupo WhatsApp") {
        this.typeSN = 1;
      } else if (data.name == "Instagram") {
        this.typeSN = 2;
      } else if (data.name == "Facebook") {
        this.typeSN = 3;
      } else if (data.name == "Twitter") {
        this.typeSN = 4;
      } else if (data.name == "Site") {
        this.typeSN = 5;
      } else if (data.name == "E-mail") {
        this.typeSN = 6;
      } else if (data.name == "Outro") {
        this.typeSN = 7;
      }
      this.id_sn = id;
      this.link_sn = "";
      this.showModal = true;
    },
  },

  async created() {
    this.user = JSON.parse(localStorage.getItem("user"));
    this.history = localStorage.getItem("history");

    const from = JSON.parse(localStorage.getItem("from"));

    if (from.city != null && from.country != null) {
      this.from = from;
    } else {
      this.from = null;
    }

    this.getSocialNetworks();

    // this.friends(id);
  },
};
</script>

<style>
label {
  color: #666;
}

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

/* MODAL */
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  /* transition: opacity 0.3s ease; */
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

/* transition MODAL */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
