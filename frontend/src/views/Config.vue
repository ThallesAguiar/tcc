<template>
  <div class="container">
    <div class="card p-1">
      <div class="row">
        <div class="col">
          <button class="btn btn-success" @click="callPersonal()">
            Personal
          </button>
        </div>
        <div
          class="col"
          v-if="enterprise.id_enterprise != null && user.businessman == 1"
        >
          <button class="btn btn-success" @click="callCompany()">
            Company
          </button>
        </div>
        <div class="col">
          <button class="btn btn-success" @click="callHistory()">
            History
          </button>
        </div>
        <div class="col">
          <button class="btn btn-success" @click="callMap()">Map</button>
        </div>
      </div>
    </div>

    <!-- DATA PERSONAL -->
    <form
      v-if="personal"
      style="
        background-color: rgba(0, 0, 0, 0.2);
        margin-top: 10px;
        border-radius: 10px;
        padding: 10px;
      "
    >
      <p
        class="text-center text-white font-weight-bold"
        style="font-size: 21px; text-shadow: 0px 0px 10px teal"
      >
        Personal data
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
            :src="user.avatar"
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
          v-model="user.pass"
        />
      </div>
      <div v-if="user.pass" class="form-group">
        <input
          type="password"
          class="form-control"
          placeholder="Confirm password"
          required
          v-model="user.Confirmpass"
        />
      </div>
      <div class="row form-group">
        <div class="col-12">
          <label class="float-left"
            >Phone {{ phone.dialCode }}{{ phone.DDD }}{{ phone.number }}</label
          >
          <select class="custom-select my-1 mr-sm-2" v-model="phone.dialCode">
            <option disabled selected>Select your code country</option>
            <option
              v-for="country in countries"
              :key="country.name"
              :value="country.dialCode"
            >
              {{ country.dialCode }} - {{ country.name }}
            </option>
          </select>
        </div>
        <div class="col-4">
          <input
            type="tel"
            class="form-control"
            v-model="phone.DDD"
            max="4"
            min="1"
            placeholder="DDD"
          />
        </div>
        <div class="col">
          <input
            type="tel"
            class="form-control"
            v-model="phone.number"
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
        <label for="gender" class="float-left">Gender</label>
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
        style="
          background-color: rgba(0, 0, 0, 0.8);
          border-radius: 5px;
          margin-bottom: 15px;
          padding: 5px;
        "
      >
        <p style="color: white" class="font-weight-bold">
          Are you businessman?&nbsp;&nbsp;&nbsp;
        </p>
        <label class="switch">
          <input type="checkbox" v-model="user.businessman" />
          <span class="slider round"></span>
        </label>
      </div>

      <button
        type="button"
        class="btn btn-primary"
        @click="updateConfigPersonal()"
      >
        Atualizar
      </button>
    </form>

    <!-- HISTORY -->
    <form
      v-if="history"
      style="
        background-color: rgba(0, 0, 0, 0.2);
        margin-top: 10px;
        border-radius: 10px;
        padding: 10px;
      "
    >
      <p
        class="text-center text-white font-weight-bold"
        style="font-size: 21px; text-shadow: 0px 0px 10px teal"
      >
        Write your history
        <br />
        <small>We love a good history</small>
      </p>
      <div class="form-group">
        <textarea
          class="form-control"
          id="exampleFormControlTextarea1"
          rows="10"
          placeholder="Nos conte a sua história...."
          v-model="userHistory"
        ></textarea>
      </div>

      <button type="button" class="btn btn-primary" @click="updateHistory()">
        Salvar
      </button>
    </form>

    <!-- MAP -->
    <form
      v-if="map"
      style="
        background-color: rgba(0, 0, 0, 0.2);
        margin-top: 10px;
        border-radius: 10px;
        padding: 10px;
      "
    >
      <p
        class="text-center text-white font-weight-bold"
        style="font-size: 21px; text-shadow: 0px 0px 10px teal"
      >
        Config map
      </p>

      <div class="form-group">
        <label for="formControlRange">Reach of users</label>
        <input
          type="range"
          class="form-control-range"
          id="formControlRange"
          v-model="range"
        />
        {{ range + " " + unit }}
      </div>

      <div class="form-group">
        <label for="inputUnit">Distance unit</label>
        <select id="inputUnit" class="form-control" v-model="unit">
          <option value="kilometres" selected>Kilometres (Km)</option>
          <option value="miles">Miles (Mi)</option>
        </select>
      </div>

      <div class="form-group">
        <label for="inputUnit">Allow whatsapp viewing</label>
        <select id="inputUnit" class="form-control" v-model="whats">
          <option value="no" selected>Não</option>
          <option value="yes">Sim</option>
        </select>
      </div>

      <button type="button" class="btn btn-primary" @click="updateConfigMap()">
        Atualizar
      </button>
    </form>

    <!-- Company -->
    <form
      v-if="company"
      style="
        background-color: rgba(0, 0, 0, 0.2);
        margin-top: 10px;
        border-radius: 10px;
        padding: 10px;
      "
    >
      <p
        class="text-center text-white font-weight-bold"
        style="font-size: 21px; text-shadow: 0px 0px 10px teal"
      >
        Mateship
      </p>
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          placeholder="Company name"
          required
          v-model="enterprise.corporate_name"
        />
      </div>
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          placeholder="Fantasy name"
          v-model="enterprise.fantasy_name"
        />
      </div>
      <div class="form-group">
        <input
          type="tel"
          class="form-control"
          placeholder="Company numbering"
          v-model="enterprise.numbering_company"
        />
      </div>
      <div class="form-group">
        <input
          type="tel"
          class="form-control"
          placeholder="Personal numbering"
          required
          v-model="enterprise.numbering_personal"
        />
      </div>
      <div class="form-group">
        <label
          class="float-left text-white font-weight-bold"
          style="text-shadow: 1px 1px 5px black"
          >Type of enterprise</label
        >
        <select
          class="custom-select my-1 mr-sm-2"
          required
          v-model="enterprise.enterprise_type"
        >
          <option disabled selected hidden>Tipo de empreendimento</option>
          <option value="internet">Internet</option>
          <option value="fixed establishment">Fixed establishment</option>
          <option value="door to door">Door to door</option>
        </select>
      </div>
      <div class="form-group">
        <textarea
          class="form-control"
          rows="3"
          placeholder="Add a description"
          v-model="enterprise.description"
        ></textarea>
      </div>
      <button
        type="button"
        @click="updateCompany()"
        class="btn btn-block btn-success"
      >
        Atualizar
      </button>
    </form>
  </div>
</template>

<script>
import countries from "../data/countries.json";
import api from "../service/api";

export default {
  data() {
    return {
      personal: true,
      map: false,
      history: false,
      company: false,
      userHistory: "",
      userCompany: "",
      whats: "no",
      phone: {
        dialCode: "",
        DDD: "",
        number: "",
      },
      user: {
        name: "",
        lastname: "",
        email: "",
        pass: "",
        Confirmpass: "",
        businessman: false,
        birthday: new Date(),
        gender: "",
        phone: "",
        bio: "",
        avatar: "",
      },
      enterprise: {
        corporate_name: "",
        fantasy_name: "",
        numbering_company: "",
        numbering_personal: "",
        description: "",
        enterprise_type: "",
      },
      unit: "",
      range: "",
      address: {},
      countries: countries,
      image:
        "https://image.winudf.com/v2/image1/YnIuY29tLmFwcHN3cy5lcnZhbWF0ZV9zY3JlZW5fMV8xNTYwNjk2NzMxXzAzNw/screen-1.jpg?fakeurl=1&type=.jpg",
      previewImage: null,
      selectedFile: null,
      overlay: false,
    };
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

    callPersonal() {
      this.personal = true;
      this.map = false;
      this.history = false;
      this.company = false;
    },

    callMap() {
      this.personal = false;
      this.map = true;
      this.history = false;
      this.company = false;
    },

    callHistory() {
      this.personal = false;
      this.map = false;
      this.history = true;
      this.company = false;
    },

    callCompany() {
      this.personal = false;
      this.map = false;
      this.history = false;
      this.company = true;
    },

    updateConfigMap() {
      localStorage.setItem("range", this.range);
      localStorage.setItem("unit", this.unit);
    },

    async updateConfigPersonal() {
      if (this.selectedFile) {
        const formData = new FormData(); /**Este formData serve para validar o envio de arquivos. */
        formData.append("file", this.selectedFile);
        const result = await api.post(`file/store.php`, formData);
        // console.log(result.data);
        this.user.avatar = result.data;
      }

      if (this.phone.dialCode && this.phone.DDD && this.phone.number) {
        var phone = this.phone.dialCode + this.phone.DDD + this.phone.number;
      } else {
        var phone = this.user.phone;
      }

      try {
        const user = await api.put("user/update.php", {
          id_user: this.user.id_user,
          name: this.user.name,
          lastname: this.user.lastname,
          email: this.user.email,
          businessman: this.user.businessman,
          password: this.user.pass,
          birthday: this.user.birthday,
          gender: this.user.gender,
          phone,
          avatar: this.user.avatar,
          bio: this.user.bio,
        });

        localStorage.setItem("user", JSON.stringify(user.data.user));

        if (
          (user.data.user.businessman == true ||
            user.data.user.businessman == 1) &&
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

    async updateCompany() {
      console.log(this.enterprise);
      try {
        const enterprise = await api.put(`enterprise/update.php`, {
          id_enterprise: this.enterprise.id_enterprise,
          corporate_name: this.enterprise.corporate_name,
          fantasy_name: this.enterprise.fantasy_name,
          numbering_company: this.enterprise.numbering_company,
          numbering_personal: this.enterprise.numbering_personal,
          description: this.enterprise.description,
          enterprise_type: this.enterprise.enterprise_type,
        });

        localStorage.setItem("enterprise", JSON.stringify(enterprise.data));

        this.$router.push("/feed");
      } catch (error) {
        console.log(error);
      }
    },

    async updateHistory() {
      try {
        const history = await api.get(
          `history/show.php?id=${this.user.id_user}`
        );

        if (history.data.history.id_history) {
          await api.put("history/update.php", {
            id_user: this.user.id_user,
            description: this.userHistory,
          });
        } else {
          await api.post("history/store.php", {
            id_user: this.user.id_user,
            description: this.userHistory,
          });
        }
        localStorage.setItem("history", this.userHistory);
      } catch (error) {
        console.log(error);
      }
    },
  },

  created() {
    this.user = JSON.parse(localStorage.getItem("user"));

    this.userHistory = localStorage.getItem("history")
      ? localStorage.getItem("history")
      : "";

    this.enterprise = JSON.parse(localStorage.getItem("enterprise"))
      ? JSON.parse(localStorage.getItem("enterprise"))
      : "";

    // Isto é para o input, pois ele não reconhece que 0 é falso e 1 é verdadeiro
    if (this.user.businessman == 0) {
      this.user.businessman = false;
    } else {
      this.user.businessman = true;
    }

    this.address = localStorage.getItem("address")
      ? JSON.parse(localStorage.getItem("address"))
      : null;
    this.range = localStorage.getItem("range")
      ? localStorage.getItem("range")
      : 10;
    this.unit = localStorage.getItem("unit")
      ? localStorage.getItem("unit")
      : "kilometres";
  },
};
</script>

<style>
body {
  background-color: #fff;
}

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
