<template>
  <div>
    <!-- Searchbox -->
    <div class="container">
      <div class="d-flex searchbox my-5 align-items-center">
        <div class="flex-grow-1">



          <div class="row row-cols-2 row-cols-lg-5 align-items-top">
            <!-- CITTA FIELD -->
            <div class="col mb-3 mb-lg-0">
              <div class="d-flex flex-column">
                <label class="fw-700" for="">Città</label>
                <input
                  v-model="filterCity"
                  type="text"
                  placeholder="Es. Milano"
                />
              </div>
            </div>

            <!-- LETTI FIELD -->
            <div class="col mb-3 mb-lg-0">
              <div class="d-flex flex-column">
                <label class="fw-700" for="">Letti</label>
                <input
                  v-model="filterBeds"
                  type="number"
                  min="1"
                  max="50"
                  placeholder="Es. 1"
                />
              </div>
            </div>

            <!-- STANZE FIELD -->
            <div class="col mb-3 mb-lg-0">
              <div class="d-flex flex-column">
                <label class="fw-700" for="">Stanze</label>
                <input
                  v-model="filterRooms"
                  type="number"
                  min="1"
                  max="50"
                  placeholder="Es. 3"
                />
              </div>
            </div>

            <!-- SERVIZI FIELD -->
            <div class="col mb-3 mb-lg-0">
              <div class="position-relative">
                <div class="serviceListLink fw-700" @click="getExpanded">
                  Servizi <i class="fas fa-angle-down"></i>
                </div>
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
                    <label class="form-check-label me-3">
                      {{ service.name }}
                    </label>
                  </div>
                </div>
              </div>
            </div>

               <!-- DISTANZA FIELD -->
            <div class="col flex-grow-1">
              <div class="d-flex flex-column me-lg-5">
                <label class="fw-700" for="">Distanza: {{ filterRange }} Km</label>

                <input
                  type="range"
                  min="1"
                  step="1"
                  max="35"
                  v-model="filterRange"
                  class="slider"
                  id="myRange"
                />
              </div>
            </div>
          </div>
        </div>

        <!-- SUBMIT -->
        <div class="ms-5 ms-lg-0">
          <div class="text-center">
            <button @click="getFiltered" class="">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Searchbox -->

    <div class="container">
      <h1 class="my-5">Scopri tutti gli alloggi</h1>
      <div class="switch_link">
        <a
          @click="switchApartment('sponsor')"
          class="custom custom_link_4"
          :class="switchPage ? '' : 'active'"
          >In evidenza</a
        >
        <a
          @click="switchApartment('all')"
          class="custom custom_link_4"
          :class="switchPage ? 'active' : ''"
        >
          Tutti gli appartamenti
        </a>
      </div>
      <div class="search_container">
        <div class="row g-0">
          <!-- Sezione Appartamenti -->
          <div class="col-12 col-md-6">
            <div class="apartment_container px-5">
              <div v-if="!switchPage" class="sponsor_column">
                <div v-if="filteredSponsorApartments.length">
                  <ApartmentCard
                    v-for="apartment in filteredSponsorApartments"
                    :key="apartment.id"
                    :apartment="apartment"
                  ></ApartmentCard>
                </div>
                <h5 v-else>Ancora nessun appartamento in evidenza</h5>
              </div>

              <div v-else class="basic_column">
                <div v-if="filteredBasicApartments.length">
                  <ApartmentCard
                    v-for="apartment in filteredBasicApartments"
                    :key="apartment.id"
                    :apartment="apartment"
                  ></ApartmentCard>
                </div>
                <h5 v-else>Nessun risultato</h5>
              </div>
            </div>
          </div>
          <!-- Mappa -->
          <div class="col-6 d-none d-md-block">
            <div class="map_container" id="myMap"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import ApartmentCard from "./ApartmentCard.vue";
export default {
  components: { ApartmentCard },
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
      switchPage: false,
      apiKey: "74G2HVlLeNW6ZnVG4yzsaMj20OxuW1sJ",
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
          // console.log(resp.data);
          this.filteredBasicApartments = resp.data[0];
          this.filteredSponsorApartments = resp.data[1];
          this.cityLat = resp.data[2];
          this.cityLon = resp.data[3];
          this.getMap();
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
      this.getMap();
    },
    getMap() {
      let mapZoom = 10;
      if (this.cityLat === 42.3011 && this.cityLon === 12.3424) {
        mapZoom = 5;
      }
      const map = tt.map({
        key: this.apiKey,
        container: myMap,
        center: [this.cityLon, this.cityLat],
        zoom: mapZoom,
        style: {
          map: "basic_main",
        },
      });

      this.filteredBasicApartments.forEach((apartment) => {
        const marker = new tt.Marker()
          .setLngLat([apartment.lon, apartment.lat])
          .addTo(map);
      });
    },
    switchApartment(value) {
      if (value === "sponsor") this.switchPage = false;
      else if (value === "all") this.switchPage = true;
      else this.switchPage = false;
    },
  },
  mounted() {
    this.getServices();
    this.getData();
  },
};
</script>

<style lang="scss" scoped>


a.custom {
  display: inline-block;
  font-weight: bold;
  text-decoration: none;
  color: black;
  padding: 8px 14px;
  margin-right: 5px;
  cursor: pointer;

  &.active::before {
    content: "";
    position: absolute;
    top: 80%;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #ffa5af;
    transform: translateX(0);
    transition: transform 0.2s ease-in-out;
  }
}

.custom_link_4 {
  position: relative;
  overflow: hidden;
  color: #001533 !important;
}

.custom_link_4::before {
  content: "";
  position: absolute;
  top: 80%;
  left: 0;
  width: 100%;
  height: 2px;
  background-color: #ffa5af;
  transform: translateX(-100%);
  transition: transform 0.2s ease-in-out;
}

.custom_link_4:hover::before {
  transform: translateX(0);
}

/* searchbox */
.searchbox {
  padding: 20px 30px;
  border-radius: 40px;
  background-color: white;

.fw-700 {
  font-weight: 700;
}
  input {
    border: none;
   
    &:focus-visible {
      outline: none;
    }
  }
  button {
    color: white;
    background-color: white;
    border: none;
  }
  .fa-search {
    background: #ff5a5f;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    text-align: center;
    line-height: 60px;
    vertical-align: middle;
    font-size: 25px;
    
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
  padding: 20px;
  background-color: rgba(255, 255, 255, 0.9);
  border: 1px solid rgb(228, 228, 228, 0.9);
  border-radius: 10px;
  z-index: 100;
  
  .form-check-input {
    border: 1px solid rgb(216, 210, 210);
  }
}

/* End Searchbox */

.search_container {
  border: 2px solid transparent;
  border-radius: 10px;

  overflow: hidden;
  -webkit-box-shadow: 0px 0px 20px 0px rgba(0, 21, 51, 0.2);
  box-shadow: 0px 0px 20px 0px rgba(0, 21, 51, 0.2);
}

.apartment_container,
.map_container {
  height: 80vh;
  width: 100%;
}

.apartment_container {
  overflow-y: auto;
  overflow-x: hidden;
  position: relative;

  .sponsor_column,
  .basic_column {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    padding: 25px 10px;
  }
}
</style>