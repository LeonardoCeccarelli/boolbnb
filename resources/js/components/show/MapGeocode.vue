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
        <div class="row">
          <div class="col-1 col-md-2">sx</div>
          <div class="col-10 col-md-8">
            <input
              type="range"
              class="form-range"
              min="1"
              max="24"
              step="1"
              :value="mapZoom"
            />
          </div>
          <div class="col-1 col-md-2">dx</div>
        </div>
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
      mapZoom: "",
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
  border: 2px solid #001533;
  border-radius: 10px;
}

.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: transparent;
  background-clip: border-box;
  border: none;
  border-radius: 0.25rem;
  overflow: hidden;
}
</style>