<template>
  <div>
    <CardContainer :apartment="apartment"></CardContainer>
  </div>
</template>

<script>
import CardContainer from "../components/show/CardContainer.vue";
export default {
  components: { CardContainer },
  data() {
    return {
      apartment: {
        type: Object,
        default: () => ({}),
      },
      apartment_id: this.$route.params.id,
      ip_address: "",
    };
  },
  methods: {
    getData() {
      window.axios
        .get("/api/apartment/" + this.$route.params.id)
        .then((resp) => {
          this.apartment = resp.data;
        });
    },
    addVisualisation() {
      window.axios
        .post("/api/visualisation", [this.apartment_id, this.ip_address])
        .then((resp) => {
          console.log(this.apartment_id, this.ip_address);
        });
    },

    fetchIpAddress() {
      fetch("https://api.ipify.org?format=json")
        .then((response) => response.json())
        .then((response) => {
          this.clientIp = response.ip;
          this.ip_address = this.clientIp;
          this.addVisualisation();
        });
    },
  },
  mounted() {
    this.getData();
    this.fetchIpAddress();
  },
};
</script>

<style>
</style>