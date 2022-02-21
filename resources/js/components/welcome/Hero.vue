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
                
                <input class="py-1 ps-3" type="text" name="luogo" placeholder="Inserisci luogo" v-model="city" />
              </div>
              <div class="my-3">
                
                <input
                class="py-1 ps-3"
                  type="text"
                  name="ospiti"
                  placeholder="Aggiungi ospiti"
                  v-model="beds"
                />

              </div>

              <a href="" class="button button_1 radius-30" @click="getData()" >Cerca Alloggio</a>

            </div>
          </div>
        </div>

        <div class="col h100 d-none d-lg-block">
          <div class="d-flex justify-content-center align-items-center h100">
            <div class="text-center py-4 w-50">
              <h3 class="mb-5 white">Non sai dove andare?</h3>
              <a href="http://127.0.0.1:8000/index_view" class="button button_1 radius-30">Lasciati ispirare</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      city: '',
      beds: '',
    };
  },
  methods:{

    getData(){
      const city = this.city;
      const beds = this.beds;

      window.axios({
        method: 'post',
        url: "/api/ApartmentController",
        data: {
            city,
            beds,
        },
        headers: {
            'Content-Type': 'text/plain;charset=utf-8',
        },
      })
        // .post("/api/ApartmentController", {
        //   params: {
        //     city,
        //     beds,
        //   },
        // })
        .then((resp) => {
          console.log(resp);
        })
        .catch((e) => {
          alert("Non è stato possibile scaricare gli appartamenti.")
          console.log("Appartamento non trovato");
        });
    }

  },
  mounted(){

  }
};
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