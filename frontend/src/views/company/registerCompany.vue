<template>
  <body>
    <div class="container">
      <!-- MODAL -->
      <div v-if="showModal">
        <transition name="modal">
          <div class="modal-mask">
            <div class="modal-wrapper">
              <div class="modal-dialog" role="document">
                <div
                  class="modal-content"
                  style="background-color: teal; color:#fff"
                >
                  <div class="modal-header">
                    <h5 class="modal-title">
                      Bem-vindo {{ user.nome + user.sobrenome }}
                    </h5>
                    <button
                      type="button"
                      class="close"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <span aria-hidden="true" @click="showModal = false"
                        >&times;</span
                      >
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="lead">
                      Identificamos que você é um empreendedor. Você deve
                      cadastrar sua empresa, pois você terá acesso ao feed como
                      empresa.<br />
                      <small
                        >Caso não quiser acessar como empreendedor, clique no
                        botão abaixo.</small
                      >
                    </p>
                  </div>
                  <div class="row modal-footer">
                    <div class="col p-3">
                      <button
                        type="button"
                        class="btn btn-primary"
                        @click="showModal = false"
                      >
                        Ok! Understand.
                      </button>
                    </div>
                    <div class="col">
                      <button
                        type="button"
                        class="btn btn-secondary"
                        @click="ImNotBusinessman(user.id_usuario)"
                      >
                        Oh no! i'm not a businessman.
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </transition>
      </div>

      <form
        v-else
        style="background-color: rgba(0, 0, 0, 0.4); padding:20px; border-radius: 10px;"
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
            v-model="enterprise.company_name"
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
            v-model="enterprise.number_pj"
          />
        </div>
        <div class="form-group">
          <input
            type="tel"
            class="form-control"
            placeholder="Personal numbering"
            required
            v-model="enterprise.number_pf"
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
            v-model="enterprise.type_company"
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
          @click="saveCompany()"
          class="btn btn-block btn-success"
        >
          Salvar
        </button>
      </form>
    </div>
  </body>
</template>

<script>
import api from "../../service/api";
export default {
  data: () => ({
    showModal: true,
    enterprise: {
      company_name: "",
      fantasy_name: "",
      number_pj: "",
      number_pf: "",
      description: "",
      type_company: "",
    },
  }),

  computed: {
    user() {
      return JSON.parse(localStorage.getItem("user"));
    },
  },

  methods: {
    async ImNotBusinessman($id) {
      try {
        await api.put("user/update.php", {
          id_user: $id,
          type_update: "ImNotBusinessman",
        });
        localStorage.removeItem("token");
        localStorage.removeItem("user");
        this.$router.push("/");
      } catch (error) {
        console.log(error);
      }
    },

    async saveCompany() {
      console.log(this.enterprise);
      try {
        const enterprise = await api.post("enterprise/store.php", {
          company_name: this.enterprise.company_name,
          fantasy_name: this.enterprise.fantasy_name,
          number_pj: this.enterprise.number_pj,
          number_pf: this.enterprise.number_pf,
          description: this.enterprise.description,
          type_company: this.enterprise.type_company,
        });

        localStorage.setItem("enterprise", JSON.stringify(enterprise));

        this.$router.push("/feed");
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style scoped>
body {
  background-image: url("../../assets/bg-login.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  height: 100vh;
}
</style>
