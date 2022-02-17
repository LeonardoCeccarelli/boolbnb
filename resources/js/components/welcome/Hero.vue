<template>
  <div class="hero bg-blue py-5">
    <div class="container hero-bg">
      <div class="row row-cols-1 row-cols-lg-2 g-lg-3 h100">
        <div class="col h100">
          <div class="d-flex justify-content-center align-items-center h100">
            <!-- searchform -->
            <div class="white text-center py-4 w-50">
              <h3 class="mb-4">Qual'è la tua prossima avventura?</h3>
              <div class="my-3">
                
                <input class="py-1 ps-3" type="text" name="luogo" placeholder="Inserisci luogo" />
              </div>
              <div class="my-3">
                
                <input
                class="py-1 ps-3"
                  type="text"
                  name="ospiti"
                  placeholder="Aggiungi ospiti"
                />
              </div>
            </div>
          </div>
        </div>

        <div class="col h100 d-none d-lg-block">
          <div class="d-flex justify-content-center align-items-center h100">
            <div class="text-center py-4 w-50">
              <h3 class="mb-5 white">Non sai dove andare?</h3>
              <a href="" class="button button_1 radius-30">Lasciati ispirare</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>

/* utilities */
.white {
  color: white;
}

.radius-30 {
  border-radius: 30px;
}

.bg-blue {
  background-color: #001533;
}

.hero-bg {
  background-image: url("/img/hero-img.jpg");
  background-size: cover;
  background-position-y: center;
  height: 600px;
  border-radius: 30px;
}

input {
  border-radius: 30px;
  
 
}

.h100 {
  height: 100%;
}
/* style bottoni */
.button {
  padding: 8px 13px;
  font-size: 15px;
  text-decoration: none;
}

.button_1 {
  cursor: pointer;
  color: white;
  background-color: #001533;
  border: 2px solid #001533;
  transition: all 0.2s linear;
}

.button_1:hover {
  -webkit-box-shadow: 0px 10px 13px -7px #000000,
    0px 0px 10px 5px rgba(255, 90, 95, 0.8);
  box-shadow: 0px 10px 13px -7px #000000,
    0px 0px 10px 5px rgba(255, 90, 95, 0.8);
}


</style>