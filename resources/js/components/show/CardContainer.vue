<template>
  <div>
    <div class="container">
      <h2 class="mb-4">Appartamento Vista mare</h2>
      <div class="row g-3 image_container mb-5">
        <div class="col-6 cover_img">
          <img
            src="https://www.classcountryhomes.it/wp-content/uploads/2019/05/appartamenti-in-vendita-roma-nord-38.jpg"
            alt=""
          />
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
      <div class="row">
        <div class="col-8 left_info">
          <h4>
            Appartamento vista mare in affitto da
            <span class="fw-bold">Leonardo</span>
          </h4>
        </div>
        <div class="col-4 right_info">
          <p class="mb-5"><span class="price">€50</span>/notte</p>
          <h5 class="mb-4">Servizi</h5>
          <ul>
            <li>Wi-Fi</li>
            <li>Posto Macchina</li>
            <li>Piscina</li>
            <li>Portineria</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {},
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
  border-right: 2px solid black;
}

.right_info {
  .price {
    font-weight: bold;
    font-size: 20px;
    margin-right: 5px;
  }
}
</style>