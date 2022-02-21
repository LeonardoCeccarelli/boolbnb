<template>
  <div>
    <!-- Searchbox -->
    <div class="container">
      <div class="row">
        <div class="col-12 searchbox d-flex">
          <div class="col d-flex flex-column">
            <label for="">Città</label>
            <input v-model="filterCity" type="text" placeholder="Es. Milano" />
          </div>
          <div class="col d-flex flex-column">
            <label for="">Letti</label>
            <input
              v-model="filterBeds"
              type="number"
              min="1"
              max="50"
              placeholder="Es. 1"
            />
          </div>
          <div class="col d-flex flex-column">
            <label for="">Stanze</label>
            <input
              v-model="filterRooms"
              type="number"
              min="1"
              max="50"
              placeholder="Es. 3"
            />
          </div>
          <div class="col d-flex flex-column">
            <div>
              <label for="">Distanza:</label><span> {{ filterRange }} Km</span>
            </div>
            <input
              type="range"
              min="1"
              step="1"
              max="20"
              v-model="filterRange"
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
                  v-for="service in services"
                  :key="service.id"
                >
                  <input
                    class="form-check-input"
                    type="checkbox"
                    :value="service.name"
                    v-model="filterServices"
                  />
                  <label class="form-check-label">
                    {{ service.name }}
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col text-end">
            <button @click="getFiltered" class="btn btn-success">Cerca</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Searchbox -->

    <div class="container">
      <h1 class="my-5">Scopri tutti gli alloggi</h1>
      <div class="row">
        <!-- Sezione Appartamenti -->
        <div class="col-12 col-sm-6">
          <div class="row g-5">
            <!-- Singolo appartamento sponsor -->
            <div>
              <h5>Alloggi in evidenza</h5>
              <div
                v-for="apartment in filteredSponsorApartments"
                :key="apartment.id"
                class="col-12"
              >
                <div class="card">
                  <img src="" class="card-img-top" alt="" />
                  <div class="card-body">
                    <h5 class="card-title">{{ apartment.title }}</h5>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Singolo appartamento base -->
            <div>
              <h5>Altri alloggi</h5>
              <div
                v-for="apartment in filteredBasicApartments"
                :key="apartment.id"
                class="col-12"
              >
                <div class="card">
                  <img src="" class="card-img-top" alt="" />
                  <div class="card-body">
                    <h5 class="card-title">{{ apartment.title }}</h5>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Finte singolo appartamento -->
          </div>
        </div>

        <!-- Mappa -->
        <div class="col-sm-6 d-sm-none"></div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      filterRange: 20,
      filterCity: "",
      filterBeds: "",
      filterRooms: "",
      filterServices: [],
      expanded: false,
      filteredBasicApartments: [],
      filteredSponsorApartments: [],
      cityLat: "",
      cityLon: "",
      services: [],
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
    getFiltered() {
      window.axios
        .get("api/search/apartment", {
          params: {
            city: this.filterCity,
            beds: this.filterBeds,
            rooms: this.filterRooms,
            range: this.filterRange,
            services: this.filterServices.join(),
          },
        })
        .then((resp) => {
          console.log(resp.data);
          this.filteredBasicApartments = resp.data[0];
          this.filteredSponsorApartments = resp.data[1];
          this.cityLat = resp.data[2];
          this.cityLon = resp.data[3];
        });
    },
    getServices() {
      window.axios.get("api/search/services").then((resp) => {
        this.services = resp.data;
      });
    },
    getData() {
      if (this.$route.params.name) {
        this.filterCity = this.$route.params.name;
      }

      if (this.$route.params.beds) {
        this.filterBeds = this.$route.params.beds;
      }

      this.getFiltered();
    },
  },
  mounted() {
    this.getServices();
    this.getData();
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
    border: 1px solid rgb(187, 185, 185);
  }
}
.serviceListLink {
  text-decoration: none;
  color: black;
}
/* End Searchbox */
</style>