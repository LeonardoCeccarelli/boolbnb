<template>
  <div class="cities container pt-5">
    <h2 class="mb-4">Le mete più suggestive</h2>
    <div
      class="
        row row-cols-1 row-cols-md-2 row-cols-lg-3
        g-md-3 g-lg-4
        gy-4
        justify-content-center
      "
    >
      <!-- FIRENZE CITY-CARD  -->
      <div class="col">
        <router-link :to="{ name: 'search', params: { name: 'Firenze' } }">
          <div class="city-card ratio ratio-1x1">
            <img src="/img/firenze.jpg" alt="florence wallpaper" />

            <div class="overlay">
              <span>Firenze</span>
            </div>
          </div>
        </router-link>
      </div>

      <!-- ROMA CITY-CARD  -->
      <div class="col">
        <router-link :to="{ name: 'search', params: { name: 'Roma' } }">
          <div class="city-card city-card ratio ratio-1x1">
            <img src="/img/roma.jpg" alt="florence wallpaper" />

            <div class="overlay">
              <span>Roma</span>
            </div>
          </div>
        </router-link>
      </div>

      <!-- MILANO CITY-CARD  -->
      <div class="col">
        <router-link :to="{ name: 'search', params: { name: 'Milano' } }">
          <div class="city-card city-card ratio ratio-1x1">
            <img src="/img/milano.jpg" alt="florence wallpaper" />

            <div class="overlay">
              <span>Milano</span>
            </div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
.city-card {
  cursor: pointer;
  margin: 5px auto;
  position: relative;
  overflow: hidden;
}

.city-card:hover .overlay {
  opacity: 0.7;
  transform: scale(1);
}

.overlay {
  position: absolute;
  background-color: #ff5a5f;
  width: 100%;
  height: 100%;
  top: 0;
  transform: scale(1.3);
  opacity: 0;
  transition: transform 0.4s ease 0s;
}

.overlay span {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-weight: bold;
  font-size: 5em;
  color: #fff;
  font-family: Sans-serif;
}

.city-card img {
  object-fit: cover;
  transition: transform 0.8s ease;
}

.city-card:hover img {
  transform: scale(1.1);
}
</style>