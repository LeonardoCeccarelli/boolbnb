<template>
  <div class="col-12 px-2">
    <router-link
      :to="{
        name: 'apartment',
        params: { id: apartment.id },
      }" class="remove-undeline"
    >
      <div class="card">
        <div class="row g-0 align-items-center">
          <!-- IMMAGINE -->
          <div class="col-12 col-lg-4 p-2">
            <div class="ratio ratio-1x1">
              <img
                :src="apartment.cover_img"
                class="img-fluid rounded-start card_image"
                alt="..."
              />
            </div>
          </div>
          <!-- TESTO -->
          <div class="col-12 col-lg-8">
            <div class="card-body">
              <h4 class="card-title text-center text-lg-start mb-3"><strong> {{ apartment.title }}</strong>
               
              </h4>
              <p class="card-text mb-5">
                {{ apartment.description.substring(0, 50) }}...
              </p>
              <p class="mb-2">
                <strong>{{ apartment.city }}</strong> - {{ apartment.address }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </router-link>
  </div>
</template>

<script>
export default {
  props: {
    apartment: {
      type: Object,
      default: () => ({}),
    },
  },
};
</script>

<style scoped lang="scss">
.remove-undeline {
  text-decoration: none !important;
}
.card {
  margin: 20px 0;
  color: black;

  .card_image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border: 1px solid lightgrey;
  }

  .apartment_address {
    font-size: 13px;
    color: rgb(155, 155, 155);
  }
  .card-body {
    text-decoration-line: none !important;
  }
}
</style>