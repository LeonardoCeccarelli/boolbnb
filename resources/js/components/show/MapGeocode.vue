<template>
  <div>
    <p @click="getMap(1)">
      <a
        class="button button_special_1"
        data-bs-toggle="collapse"
        href="#collapseExample"
        role="button"
        aria-expanded="false"
        aria-controls="collapseExample"
      >
        Dove ti troverai
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
  props: {
    apartmentLat: {
      default: 12.5643,
    },
    apartmentLon: {
      default: 40.84567,
    },
  },
  data() {
    return {
      classMap: "show",
      apiKey: "74G2HVlLeNW6ZnVG4yzsaMj20OxuW1sJ",
      mapShow: false,
    };
  },
  methods: {
    getMap(bool) {
      if (this.mapShow) return;

      if (bool) {
        const map = tt.map({
          key: this.apiKey,
          container: myMap,
          center: [this.apartmentLon, this.apartmentLat],
          zoom: 14,
          style: {
            map: "basic_main",
          },
        });
        const marker = new tt.Marker()
          .setLngLat([this.apartmentLon, this.apartmentLat])
          .addTo(map);
        this.mapShow = true;
      } else {
        const map = tt.map({
          key: this.apiKey,
          container: myMap,
          zoom: 14,
          style: {
            map: "basic_main",
          },
        });
        this.classMap = "";
      }
    },
  },
  mounted() {
    this.getMap(0);
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