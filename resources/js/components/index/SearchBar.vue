<template>
  <div>
    <!-- Searchbox -->
    <div class="container">
      <div class="row">
        <div class="col-12 searchbox d-flex">
          <div class="col d-flex flex-column">
            <label for="">Città</label>
            <input type="text" name="" id="" placeholder="Es. Milano" />
          </div>
          <div class="col d-flex flex-column">
            <label for="">Letti</label>
            <input
              type="number"
              name=""
              id=""
              min="1"
              max="50"
              placeholder="Es. 1"
            />
          </div>
          <div class="col d-flex flex-column">
            <label for="">Stanze</label>
            <input
              type="number"
              name=""
              id=""
              min="1"
              max="50"
              placeholder="Es. 3"
            />
          </div>
          <div class="col d-flex flex-column">
            <div>
              <label for="">Distanza:</label><span> {{ valore }}</span>
            </div>
            <input
              type="range"
              min="1"
              max="100"
              value="50"
              v-model="valore"
              class="slider"
              id="myRange"
            />
          </div>
          <div
            class="
              col
              d-flex
              flex-column
              align-items-center
              justify-content-center
            "
          >
            <div class="position-relative">
              <a href="#" class="serviceListLink" @click="getExpanded"
                >Servizi <i class="fas fa-angle-down"></i
              ></a>
              <div v-if="expanded === true" class="serviceList">
                <div
                  class="form-check"
                  v-for="(service, i) in services"
                  :key="i"
                >
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value=""
                    id="flexCheckDefault"
                  />
                  <label class="form-check-label" for="flexCheckDefault">
                    {{ service.nome }}
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Searchbox -->

    <div class="container">
      <div class="row">
        <!-- Sezione Appartamenti -->
        <div class="col">
          <h1 class="my-5">Scopri tutti gli alloggi</h1>
          <div class="d-flex flex-column">
            <!-- Singolo Appartamento -->
            <div class="row">
              <div class="col-4">
                <img src="" alt="" class="img-fluid" />
              </div>
              <div class="col-8">
                <h4 class="card-title mb-3"></h4>
                <ul class="d-flex flex-wrap p-0 list-unstyled">
                  <li class="me-3"><span class="me-1"></span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Mappa -->
        <div class="col d-sm-none"></div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      valore: 50,
      expanded: false,
      services: [
        { nome: "cucina" },
        { nome: "bagno" },
        { nome: "palestra" },
        { nome: "wifi" },
      ],
    };
  },
  methods: {
    getExpanded() {
      if (this.expanded === false) {
        this.expanded = true;
      } else {
        this.expanded = false;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
/* searchbox */
.searchbox {
  border: 1px solid black;
  padding: 4px 15px;
  border-radius: 20px;
  background-color: white;
  height: 50px;
  transition: 1s;
  &:hover {
    border: 1px solid rgb(107, 178, 245);
  }

  label {
    color: rgb(170, 170, 170);
    font-size: 12px;
  }

  span {
    font-size: 12px;
  }
  input {
    border: none;
    height: 20px;
    background: none;
    &:focus-visible {
      outline: none;
    }
  }
}

.slider {
  &:hover {
    cursor: pointer;
  }
}
/* Dropdown menu */
.serviceList {
  position: absolute;
  top: 100%;
  background-color: white;
  width: 120px;
  border: 1px solid rgb(187, 185, 185);
  border-radius: 10px;
  .form-check-input {
    background-color: rgb(255, 255, 255);
    border: 1px solid rgb(187, 185, 185);
  }
}
.serviceListLink {
  text-decoration: none;
  color: black;
}
/* End Searchbox */
</style>