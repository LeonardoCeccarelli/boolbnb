<template>
  <div v-if="sponsoredApartment.length" class="sponsored container pt-5">
    <h2 class="mb-4">Scopri le esperienze Boolbnb</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-md-3 g-lg-3 h-100">
      <!-- CARD -> foreach per i primi 8 appartamenti sponsorizzati-->

      <div
        v-for="apartment in sponsoredApartment"
        :key="apartment.id"
        class="col d-flex justify-content-center"
      >
        <div class="card sponsored-card">
          <img
            :src="apartment.cover_img"
            class="card-img-top card_image"
            alt="..."
          />
          <div class="card-body">
            <h5 class="card-title">{{ apartment.title }}</h5>
            <p class="card-text">
              {{ apartment.description.substring(0, 50) }}...
            </p>
            <router-link
              :to="{ name: 'apartment', params: { id: apartment.id } }"
              class="button button_4"
              >Scopri</router-link
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sponsoredApartment: [],
    };
  },
  methods: {
    getData() {
      window.axios.get("api/welcome/sponsored").then((resp) => {
        this.sponsoredApartment = resp.data;
      });
    },
  },
  mounted() {
    this.getData();
  },
};
</script>

<style>
.sponsored-card {
  position: relative;
  border-radius: 5px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
  transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.sponsored-card::after {
  content: "";
  border-radius: 5px;
  position: absolute;
  z-index: -1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  opacity: 0;
  -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
  transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.sponsored-card:hover {
  -webkit-transform: scale(1.05, 1.05);
  transform: scale(1.05, 1.05);
}
.sponsored-card:hover::after {
  opacity: 1;
}

.card_image {
  max-height: 250px;
  object-fit: cover;
}
</style>