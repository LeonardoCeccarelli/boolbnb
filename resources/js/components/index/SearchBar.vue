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
              max="35"
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
            <div class="apartment_container">
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

.search_container {
  border: 2px solid transparent;
  border-radius: 10px;
  background: rgb(0, 21, 51);
  background: linear-gradient(
    36deg,
    rgba(0, 21, 51, 0.20211834733893552) 0%,
    rgba(255, 90, 95, 0.30015756302521013) 47%,
    rgba(0, 21, 51, 0.2) 100%
  );
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

.map_container {
}
</style>