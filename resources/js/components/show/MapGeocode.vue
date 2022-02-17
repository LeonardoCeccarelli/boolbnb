<template>
  <div>
    <p>
      <a
        class="btn btn-primary"
        data-bs-toggle="collapse"
        href="#collapseExample"
        role="button"
        aria-expanded="false"
        aria-controls="collapseExample"
      >
        Visualizza Mappa
      </a>
    </p>
    <div class="collapse" :class="classMap" id="collapseExample">
      <div class="card card-body">
        <div class="map" id="myMap"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      classMap: "show",
      apiKey: "74G2HVlLeNW6ZnVG4yzsaMj20OxuW1sJ",
      lon: "12.48945",
      lat: "41.89358",
    };
  },
  methods: {
    getMap() {
      const map = tt.map({
        key: this.apiKey,
        container: myMap,
        center: [this.lon, this.lat],
        zoom: 14,
        style: {
          map: "basic_main",
        },
      });

      const marker = new tt.Marker().setLngLat([this.lon, this.lat]).addTo(map);

      this.classMap = "";
    },
  },
  mounted() {
    this.getMap();
  },
};
</script>

<style scoped lang="scss">
.map {
  width: 100%;
  height: 70vh;
  max-height: 600px;
}
</style>