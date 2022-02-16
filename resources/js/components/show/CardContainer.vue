<template>
  <div>
    <div class="container mt-3">
      <div class="row g-4 image_container mb-5">
        <div class="col-6">
          <div class="cover_img">
            <img
              src="https://www.classcountryhomes.it/wp-content/uploads/2019/05/appartamenti-in-vendita-roma-nord-38.jpg"
              alt=""
            />
          </div>
        </div>
        <div class="col-6">
          <div class="other_img">
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
        </div>
      </div>
      <div class="row mb-5">
        <div class="col-8">
          <div class="left_info">
            <div class="title_container mb-4">
              <h2>Appartamento vista mare</h2>
              <p>
                Roma - Piazza Venezia - 4 stanze/a - 4 posti/o letto - 1 bagni/o
              </p>
            </div>
            <div class="description_container mb-5">
              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Provident, ducimus itaque? Expedita saepe praesentium provident,
                eaque fuga rerum accusamus optio est repudiandae voluptate sint
                reiciendis consequatur laboriosam veniam, incidunt nisi. Non
                dolore alias quam fuga nisi doloribus commodi ut? Quisquam
                consequuntur facilis hic, in, illum ipsum beatae quo nulla
                tenetur sed perferendis expedita animi similique eius recusandae
                tempore molestiae? Tempora!
              </p>
            </div>
            <div class="form_button">
              <button
                type="button"
                class="btn btn-primary"
                @click="getFormActive"
                :disabled="formActive"
              >
                Contattami
              </button>
            </div>
          </div>
        </div>
        <div class="col-4 right_info">
          <p class="mb-2"><span class="price">€50</span>/notte</p>
          <p class="mb-5">
            Proprietario/a : <span class="fw-bold">Leonardo</span>
          </p>
          <h5 class="mb-4">Servizi disponibili</h5>
          <div class="row row-cols-2 row-cols-sm-1 row-cols-md-2 gy-3">
            <div class="col">
              <p><i class="fas fa-wifi"></i><span class="ms-2">Wi-Fi</span></p>
            </div>
            <div class="col">
              <p>
                <i class="fas fa-wifi"></i><span class="ms-2">Portineria</span>
              </p>
            </div>
            <div class="col">
              <p><i class="fas fa-wifi"></i><span class="ms-2">Sauna</span></p>
            </div>
            <div class="col">
              <p>
                <i class="fas fa-wifi"></i><span class="ms-2">Piscina</span>
              </p>
            </div>
          </div>
        </div>
      </div>
      <form-contacts
        v-if="formActive"
        :formSend="formSend"
        @closeForm="closeForm"
        @sendForm="sendForm"
      ></form-contacts>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formActive: false,
      formSend: false,
    };
  },
  methods: {
    getFormActive() {
      this.formActive = true;
    },
    closeForm() {
      this.formActive = false;
    },
    sendForm() {
      this.formSend = true;
    },
  },
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

  .other_img:hover .overlay_image {
    opacity: 1;
    backdrop-filter: blur(4px);

    .button_overlay_image {
      bottom: 50%;
    }
  }
}

.left_info {
}

.right_info {
  border-left: 2px solid #001355;
  .price {
    font-weight: bold;
    font-size: 20px;
    margin-right: 5px;
    color: #ff5a5f;
  }
}
</style>