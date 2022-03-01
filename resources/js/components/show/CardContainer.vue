<template>
  <div>
    <div class="container mt-3">
      <div class="row g-4 image_container mb-5">
        <div class="col-12 col-md-6">
          <div class="cover_img" @click="getOverlayImage">
            <img :src="apartment.cover_img" alt="" />
          </div>
        </div>
        <!-- <div class="col-12 col-md-6">
          <div class="other_img" @click="getOverlayImage()">
            <div class="overlay_image">
              <div class="button_overlay_image">
                <button class="btn btn-primary" type="button">
                  Vedi Tutto
                </button>
              </div>
            </div>
            <img
              src="https://www.lago.it/wp-content/uploads/2017/10/Lago-Appartamento-Store-Arnhem-1.jpg"
              alt=""
            />
          </div>
        </div> -->
      </div>
      <MapGeocode
        :apartmentLat="apartment.lat"
        :apartmentLon="apartment.lon"
      ></MapGeocode>
      <div class="row my-5">
        <div class="col-12 col-md-8">
          <div class="left_info">
            <div class="title_container mb-4">
              <h2>{{ apartment.title }}</h2>
              <p>{{ apartment.city }} - {{ apartment.address }}</p>
              <p>
                {{ apartment.rooms }} stanze - {{ apartment.beds }} posti/o
                letto - {{ apartment.bathrooms }} bagni/o
              </p>
            </div>
            <div class="description_container mb-5">
              <p>
                {{ apartment.description }}
              </p>
            </div>
            <div class="form_button">
              <button
                type="button"
                class="button button_special_1"
                @click="getFormActive"
                :disabled="formActive"
              >
                Contattami
              </button>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4 right_info">
          <p class="mb-2">
            <span class="price">€{{ apartment.night_price }}</span
            >/notte
          </p>
          <p class="mb-2">
            <span class="price">{{ apartment.square_metres }}</span
            >/metri²
          </p>
          <p class="mb-5">
            Proprietario/a:
            <span v-if="this.apartment.user" class="fw-bold">{{
              apartment.user.name
            }}</span>
          </p>
          <h5 class="mb-4">Servizi disponibili</h5>
          <div
            v-if="apartment.services && apartment.services.length"
            class="row row-cols-2 row-cols-sm-1 row-cols-md-2 gy-3"
          >
            <div
              v-for="service in apartment.services"
              :key="service.id"
              class="col"
            >
              <p>
                <span v-html="service.icon"></span>
                <span class="ms-2">{{ service.name }}</span>
              </p>
            </div>
          </div>
          <div v-else>
            <h5 class="text-secondary py-3">Nessun servizio</h5>
          </div>
        </div>
      </div>

      <FormContacts
        v-if="formActive"
        :formSend="formSend"
        :apartmentId="apartment.id"
        :apartmentTitle="apartment.title"
        @closeForm="closeForm"
        @sendForm="sendForm"
      ></FormContacts>

      <OverlayImage
        :coverImg="apartment.cover_img"
        v-if="overlayImage"
        @closeOverlayImage="closeOverlayImage"
      ></OverlayImage>
    </div>
  </div>
</template>

<script>
import FormContacts from "./FormContacts.vue";
import MapGeocode from "./MapGeocode.vue";
import OverlayImage from "./OverlayImage.vue";
export default {
  components: { MapGeocode, FormContacts, OverlayImage },
  props: {
    apartment: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      formActive: false,
      formSend: false,
      overlayImage: false,
    };
  },
  methods: {
    getFormActive() {
      this.formActive = true;
      window.scrollTo(0, document.body.scrollHeight);
    },
    closeForm() {
      this.formActive = false;
    },
    sendForm() {
      this.formSend = true;
    },

    getOverlayImage() {
      this.overlayImage = true;
    },

    closeOverlayImage() {
      this.overlayImage = false;
    },
  },
  mounted() {},
};
</script>

<style scoped lang="scss">
ul {
  list-style: none;
}
.image_container {
  div {
    border-radius: 10px;
    overflow: hidden;
  }
  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
  }
  .cover_img {
    cursor: pointer;
    height: 100%;
  }

  .other_img {
    height: 100%;
    position: relative;
    overflow: hidden;
  }

  .overlay_image {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.55);
    opacity: 0;
    backdrop-filter: none;
    transition: all 0.2s linear;

    .button_overlay_image {
      position: absolute;
      bottom: 110%;
      left: 50%;
      transform: translate(-50%, 50%);
      transition: all 0.3s 0.2s ease-in-out;
    }
  }

  .other_img:hover {
    .overlay_image {
      opacity: 1;
      backdrop-filter: blur(4px);
    }
    .button_overlay_image {
      bottom: 50%;
    }
  }
}

.left_info {
}

.right_info {
  .price {
    font-weight: bold;
    font-size: 20px;
    margin-right: 5px;
    color: #ff5a5f;
  }
}

@media only screen and (max-width: 768px) {
  .right_info {
    border-top: 2px solid #001533;
    margin-top: 50px;
    padding-top: 20px;
  }
}

@media only screen and (min-width: 769px) {
  .right_info {
    border-left: 2px solid #001533;
  }
}
</style>