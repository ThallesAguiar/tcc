<template>
  <body>
    <div class="container">
      <div class="row d-flex align-items-center justify-content-center">
        <div v-if="isLogin" class="col-sm-12 col-md-6" style="height:100vh;">
          <form class="mt-5">
            <p
              class="text-center text-white font-weight-bold"
              style="font-size: 21px; text-shadow: 0px 0px 10px teal"
            >
              Mateship
            </p>
            <div class="form-group">
              <input
                type="email"
                class="form-control"
                aria-describedby="emailHelp"
                placeholder="Enter email"
                required
                v-model="user.email"
              />
            </div>
            <div class="form-group">
              <input
                type="password"
                class="form-control"
                placeholder="Password"
                required
                v-model="user.pass"
              />
            </div>
            <button
              type="button"
              @click="login()"
              class="btn btn-block btn-success"
            >
              {{ texts.toolbar }}
            </button>
            <div class="row">
              <div class="col-12">
                <small
                  id="noAccount"
                  class="form-text font-weight-bold text-white mt-5"
                  style="text-shadow: 1px 1px 2px black"
                  >Don't have an account?</small
                >
              </div>
              <div class="col-12">
                <button
                  type="button"
                  @click="isLogin = !isLogin"
                  class="btn btn-primary"
                >
                  {{ texts.button }}
                </button>
              </div>
            </div>
          </form>
        </div>

        <div v-else class="col-sm-12 col-md-6">
          <form enctype="multipart/form-data" class="mt-5">
            <p
              class="text-center text-white font-weight-bold"
              style="font-size: 21px; text-shadow: 0px 0px 10px teal"
            >
              Mateship
            </p>
            <div class="row">
              <div class="col"></div>

              <div v-if="previewImage" class="imagePreviewWrapper">
                <img
                  :src="previewImage"
                  @click="overlay = !overlay"
                  width="150px"
                  height="150px"
                  style="border-radius: 50%"
                />
              </div>
              <div v-else class="imagePreviewWrapper">
                <img
                  src="https://image.winudf.com/v2/image1/YnIuY29tLmFwcHN3cy5lcnZhbWF0ZV9zY3JlZW5fMV8xNTYwNjk2NzMxXzAzNw/screen-1.jpg?fakeurl=1&type=.jpg"
                  @click="selectImage"
                  width="150px"
                  style="border-radius: 50%"
                />
              </div>
              <div class="col"></div>
            </div>
            <div class="form-group">
              <input
                type="file"
                @change="onFileSelected"
                ref="fileInput"
                @input="pickFile"
                class="form-control"
              />
            </div>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                placeholder="Name"
                required
                v-model="user.name"
              />
            </div>
            <div class="form-group">
              <input
                type="text"
                class="form-control"
                placeholder="Lastname"
                required
                v-model="user.lastname"
              />
            </div>
            <div class="form-group">
              <input
                type="email"
                class="form-control"
                aria-describedby="emailHelp"
                placeholder="Email"
                required
                v-model="user.email"
              />
            </div>
            <div class="form-group">
              <input
                type="password"
                class="form-control"
                placeholder="Password"
                required
                v-model="user.pass"
              />
            </div>
            <div class="row form-group">
              <div class="col-12">
                <label class="float-left"
                  >Phone {{ user.phone.dialCode }}{{ user.phone.DDD
                  }}{{ user.phone.number }}</label
                >
                <select
                  class="custom-select my-1 mr-sm-2"
                  v-model="user.phone.dialCode"
                >
                  <option disabled selected>Select your code country</option>
                  <option
                    v-for="country in countries"
                    :key="country.name"
                    :value="country.dialCode"
                    >{{ country.dialCode }} - {{ country.name }}</option
                  >
                </select>
              </div>
              <div class="col-4">
                <input
                  type="tel"
                  class="form-control"
                  v-model="user.phone.DDD"
                  max="4"
                  min="1"
                  placeholder="DDD"
                />
              </div>
              <div class="col">
                <input
                  type="tel"
                  class="form-control"
                  v-model="user.phone.number"
                  placeholder="Phone"
                />
              </div>
            </div>
            <div class="form-group">
              <label for="birthday" class="float-left">Birthday</label>
              <input
                class="form-control"
                type="date"
                placeholder="dd/mm/yyyy"
                v-model="user.birthday"
                required
              />
              <small>Your birthday is important for us</small>
            </div>
            <div class="form-group">
              <select
                class="custom-select my-1 mr-sm-2"
                required
                v-model="user.gender"
              >
                <option disabled selected hidden>Gender</option>
                <option value="F">Female</option>
                <option value="M">Male</option>
              </select>
            </div>

            <div class="form-group">
              <textarea
                class="form-control"
                id="exampleFormControlTextarea1"
                rows="3"
                placeholder="Add a Bio"
                v-model="user.bio"
              ></textarea>
            </div>
            <div
              class="row d-flex align-items-center justify-content-center"
              style="background-color: rgba(0, 0, 0, 0.8); border-radius: 5px; margin-bottom:15px; padding:5px"
            >
              <p style="color:white" class="font-weight-bold">
                Are you businessman?&nbsp;&nbsp;&nbsp;
              </p>
              <label class="switch">
                <input type="checkbox" v-model="user.businessman" />
                <span class="slider round"></span>
              </label>
            </div>
            <div
              class="row d-flex align-items-center justify-content-center"
              style="background-color: rgba(0, 0, 0, 0.8); border-radius: 5px; margin-bottom:15px; padding:5px"
            >
              <small
                >Your coordinates <br />
                lat: {{ user.coordinates.lat }}

                lng: {{ user.coordinates.lng }}
              </small>
            </div>
            <button
              type="button"
              @click="singin()"
              class="btn btn-block btn-success"
            >
              {{ texts.toolbar }}
            </button>
            <div class="row">
              <div class="col-12 p-5">
                <button
                  type="button"
                  @click="isLogin = !isLogin"
                  class="btn btn-primary"
                >
                  {{ texts.button }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</template>

<script>
import countries from "../../data/countries.json";
import axios from "axios";
import api from "../../service/api";

export default {
  data: () => ({
    isLogin: true,
    countries: countries,
    user: {
      name: "",
      lastname: "",
      email: "",
      pass: "",
      businessman: false,
      gender: "",
      birthday: new Date(),
      phone: {
        dialCode: "",
        DDD: "",
        number: "",
      },
      bio: "",
      avatar: "",
      coordinates: {
        lat: "",
        lng: "",
      },
    },
    image:
      "https://image.winudf.com/v2/image1/YnIuY29tLmFwcHN3cy5lcnZhbWF0ZV9zY3JlZW5fMV8xNTYwNjk2NzMxXzAzNw/screen-1.jpg?fakeurl=1&type=.jpg",
    previewImage: null,
    selectedFile: null,
    overlay: false,
  }),
  created() {
    this.getCoordinates();
  },

  methods: {
    /** IMAGEM/FILE*/
    /**Quando inserir a imagem, o this. recebe o valor da imagem */
    onFileSelected(event) {
      this.selectedFile = event.target.files[0];
    },
    selectImage() {
      this.$refs.fileInput.click();
    },
    pickFile() {
      let input = this.$refs.fileInput;
      let file = input.files;
      if (file && file[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.previewImage = e.target.result;
        };
        reader.readAsDataURL(file[0]);
        this.$emit("input", file[0]);
      }
    } /** ./IMAGEM/FILE*/,

    getCoordinates() {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const { latitude, longitude } = position.coords;

          this.user.coordinates.lat = latitude;
          this.user.coordinates.lng = longitude;
        },
        (err) => {
          console.log(err);
        },
        {
          timeout: 30000,
        }
      );
    },

    async login() {
      try {
        const user = await axios.post(
          "http://localhost/mateship/backend/controller/session/store.php",
          {
            email: this.user.email,
            password: this.user.pass,
          }
        );

        localStorage.setItem("login", true);
        localStorage.setItem("token", user.data.token);
        localStorage.setItem("user", JSON.stringify(user.data.user));
        localStorage.setItem(
          "from",
          JSON.stringify({
            city: user.data.user.city,
            country: user.data.user.country,
          })
        );

        const history = await axios.get(
          `http://localhost/mateship/backend/controller/history/show.php?id=${user.data.user.id_user}`
        );
        const enterprise = await axios.get(
          `http://localhost/mateship/backend/controller/enterprise/show.php?id=${user.data.user.id_enterprise}`
        );

        if (history.data.history) {
          localStorage.setItem("history", history.data.history.description);
        }
        if (enterprise.data) {
          localStorage.setItem("enterprise", JSON.stringify(enterprise.data));
        }

        await api.put(`session/update.php?id=${user.data.user.id_user}`);

        if (
          user.data.user.enterprise == 1 &&
          user.data.user.id_enterprise == null
        ) {
          this.$router.push("/registerCompany");
        } else {
          this.$router.push("/feed");
        }
      } catch (error) {
        console.log(error);
      }
    },

    async singin() {
      if (this.selectedFile) {
        const formData = new FormData(); /**Este formData serve para validar o envio de arquivos. */
        formData.append("file", this.selectedFile);
        const result = await axios.post(
          `http://localhost/mateship/backend/controller/file/store.php`,
          formData
        );
        // console.log(result.data);
        this.user.avatar = result.data;
      } else {
        this.user.avatar =
          "https://gartic.com.br/imgs/mural/ra/raqueelita/chimarrao.png";
      }

      try {
        const user = await axios.post(
          "http://localhost/mateship/backend/controller/user/store.php",
          {
            name: this.user.name,
            lastname: this.user.lastname,
            email: this.user.email,
            businessman: this.user.businessman,
            password: this.user.pass,
            birthday: this.user.birthday,
            gender: this.user.gender,
            phone:
              this.user.phone.dialCode +
              this.user.phone.DDD +
              this.user.phone.number,
            bio: this.user.bio,
            avatar: this.user.avatar,
            lat: this.user.coordinates.lat,
            lng: this.user.coordinates.lng,
          }
        );
        this.isLogin = true;
      } catch (error) {
        console.log(error);
      }
    },
  },
  computed: {
    texts() {
      return this.isLogin
        ? { toolbar: "Login", button: "Sing in" }
        : { toolbar: "Create account", button: "I have an account" };
    },
  },

  created() {
    localStorage.setItem("login", false);
    localStorage.removeItem("token");
    localStorage.removeItem("user");
    localStorage.removeItem("from");
    localStorage.removeItem("history");
    localStorage.removeItem("enterprise");
  },
};
</script>

<style scoped>
select:invalid {
  color: gray;
}

form {
  background-color: rgba(0, 0, 0, 0.5);
  padding: 20px;
  border-radius: 8px;
}

label,
small {
  color: #fff;
}

body {
  background-image: url("../../assets/bg-login.jpg");
  background-repeat: no-repeat;
  background-size: cover;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

input:checked + .slider {
  background-color: #2196f3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196f3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

/* avatar */
.imagePreviewWrapper {
  display: block;
  cursor: pointer;
  margin: 0 auto 10px;
  background-color: rgba(0, 0, 0, 0.1);
}
.imagePreviewClicked {
  width: calc(100% - 20px);
  height: calc(100% - 23px - 65px - 47px - 16px);
  min-width: 300px;
  max-width: 355px;
  display: block;
  margin: 0 auto 30px;
  background-size: cover;
  background-position: center center;
}
#imagePerfil {
  width: 80%;
  border-radius: 1%;
  background-size: cover;
}
</style>
