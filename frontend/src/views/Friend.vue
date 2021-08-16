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

              <a href="#" class="btn btn-sm btn-block btn-success my-2">
                <i class="ace-icon fa fa-plus-circle bigger-120"></i>
                <span class="bigger-110">Follow as a friend</span>
              </a>
            </div>
            <!-- /.col -->

            <div class="col-xs-12 col-sm-12 col-md-6">
              <h4 class="blue">
                <span class="middle">{{ nameComplete }}</span>

                <span class="label label-purple arrowed-in-right">
                  <i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
                  online
                </span>
              </h4>

              <div class="profile-user-info">
                <div class="profile-info-row">
                  <div class="profile-info-name">Username</div>

                  <div class="profile-info-value">
                    <span>{{ nameComplete }}</span>
                  </div>
                </div>

                <!-- <div class="profile-info-row">
                  <div class="profile-info-name">Location</div>

                  <div class="profile-info-value">
                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                    <span>Netherlands</span>
                    <span>Amsterdam</span>
                  </div>
                </div> -->

                <div class="profile-info-row">
                  <div class="profile-info-name">Age</div>

                  <div class="profile-info-value">
                    <span>{{ age }}</span>
                  </div>
                </div>

                <div class="profile-info-row">
                  <div class="profile-info-name">Joined</div>

                  <div class="profile-info-value">
                    <span>{{joined}}</span>
                  </div>
                </div>

                <div class="profile-info-row">
                  <div class="profile-info-name">Last Online</div>

                  <div class="profile-info-value">
                    <span>3 hours ago</span>
                  </div>
                </div>
              </div>

              <div class="hr hr-8 dotted"></div>

              <div class="profile-user-info">
                <div class="profile-info-row">
                  <div class="profile-info-name">Website</div>

                  <div class="profile-info-value">
                    <a href="#" target="_blank">www.alexdoe.com</a>
                  </div>
                </div>

                <div class="profile-info-row">
                  <div class="profile-info-name">
                    <i
                      class="
                        middle
                        ace-icon
                        fa fa-facebook-square
                        bigger-150
                        blue
                      "
                    ></i>
                  </div>

                  <div class="profile-info-value">
                    <a href="#">Find me on Facebook</a>
                  </div>
                </div>

                <div class="profile-info-row">
                  <div class="profile-info-name">
                    <i
                      class="
                        middle
                        ace-icon
                        fa fa-twitter-square
                        bigger-150
                        light-blue
                      "
                    ></i>
                  </div>

                  <div class="profile-info-value">
                    <a href="#">Follow me on Twitter</a>
                  </div>
                </div>
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
                      My job is mostly lorem ipsuming and dolor sit ameting as
                      long as consectetur adipiscing elit.
                    </p>
                    <p>
                      Sometimes quisque commodo massa gets in the way and sed
                      ipsum porttitor facilisis.
                    </p>
                    <p>
                      The best thing about my job is that vestibulum id ligula
                      porta felis euismod and nullam quis risus eget urna mollis
                      ornare.
                    </p>
                    <p>Thanks for visiting my profile.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
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

    joined(){
      var created = this.user.created.split(' ');

      var time = created[1];
      var date = created[0];
      
      return date;
    }
  },
  async created() {
    const id = this.$route.params.id;

    const user = await api.get(`user/show.php?id=${id}`);
    console.log(user)
    this.user = user.data.user;

    console.log(this.user);
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
