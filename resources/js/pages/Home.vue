<template>
  <div>
    <Hero></Hero>
    <Sponsored></Sponsored>
    <Cities></Cities>
  </div>
</template>

<script>
import Cities from "../components/welcome/Cities.vue";
import Hero from "../components/welcome/Hero.vue";
import Sponsored from "../components/welcome/Sponsored.vue";

export default {
  components: { Hero, Sponsored, Cities },
};
</script>

<style>
</style>