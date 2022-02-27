<template>
  <div class="container-flex hero">
    <div class="hero-bg">
      <div class="row row-cols-1 row-cols-lg-2 w-100 h100">
        <div class="col">
          <div class="d-flex justify-content-center align-items-center h100">
            <!-- searchform -->
            <div class="white text-center py-4 w-50">
              <h1 class="mb-4">Qual'è la tua prossima avventura?</h1>
              <div class="my-5">
                <input
                  class="py-2 ps-3"
                  type="text"
                  name="luogo"
                  placeholder="Inserisci luogo"
                  v-model="formCity"
                />
              </div>
              <div class="my-3">
                <input
                  class="py-2 ps-3"
                  type="text"
                  name="ospiti"
                  placeholder="Aggiungi ospiti"
                  v-model="formBeds"
                />
              </div>
              <div class="my-5">
                <router-link
                  :to="{
                    name: 'search',
                    params: { name: formCity, beds: formBeds },
                  }"
                  class="  button button_1"
                >
                  Vai
                </router-link>
              </div>
            </div>
          </div>
        </div>

        <div class="col h100 d-none d-lg-block">
          <div class="d-flex justify-content-center align-items-center h100">
            <div class="text-center py-4 w-50">
              <h1 class="mb-5 white">Non sai dove andare?</h1>
              <router-link
                :to="{ name: 'search' }"
                class="button button_1 radius-30"
                >Lasciati ispirare</router-link
              >
            </div>
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
      formCity: "",
      formBeds: "",
    };
  },
};
</script>

<style scoped>
/* utilities */
.white {
  color: white;
}
.hero-bg {
  background-image: url("/img/hero-img.jpg");
  background-size: cover;
  background-position-y: center;
  height: 94vh;

}
input {
  border-radius: 30px;
}

.h100 {
  height: 100%;
}
/* style bottoni */


</style>