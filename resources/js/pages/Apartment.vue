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
  },
  mounted() {
    this.getData();
  },
};
</script>

<style>
</style>