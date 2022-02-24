<template>
  <div class="col-12">
    <div class="card">
      <div class="row g-0">
        <div class="col-md-4">
          <img
            :src="apartment.cover_img"
            class="img-fluid rounded-start card_image"
            alt="..."
          />
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">{{ apartment.title }}</h5>
            <p class="card-text">
              {{ apartment.description.substring(0, 30) }}...
            </p>
            <div class="row">
              <div class="col-3">
                <router-link
                  :to="{
                    name: 'apartment',
                    params: { id: apartment.id },
                  }"
                  class="btn btn-primary show_link"
                  >Info</router-link
                >
              </div>
              <div class="col-9">
                <p class="mb-0 apartment_city">{{ apartment.city }}</p>
                <p class="mb-0 apartment_address">{{ apartment.address }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
.card {
  margin: 20px 0;
  background-color: #001533;
  color: white;

  .show_link {
    opacity: 0;
    transform: scale(0.1);
    transition: all 0.1s linear;
  }

  &:hover .show_link {
    opacity: 1;
    transform: scale(1);
  }

  .card_image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .apartment_service {
    display: inline-block;
    margin-right: 5px;
    font-size: 10px;
    color: rgb(155, 155, 155);
  }

  .apartment_address {
    font-size: 13px;
    color: rgb(155, 155, 155);
  }
}
</style>