<template>
  <div class="overlay_banner_container">
    <div class="close_banner">
      <i @click="$emit('closeOverlayImage')" class="fas fa-times"></i>
    </div>
    <div class="overlay_banner_image">
      <img
        src="https://www.classcountryhomes.it/wp-content/uploads/2019/05/appartamenti-in-vendita-roma-nord-38.jpg"
        alt=""
      />
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped lang="scss">
.overlay_banner_container {
  background-color: rgba(0, 0, 0, 0.55);
  position: fixed;
  z-index: 99;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  backdrop-filter: blur(4px);

  .overlay_banner_image {
    width: 70vw;
    height: 80vh;
    position: relative;

    img {
      height: 100%;
      width: 100%;
      object-fit: cover;
    }
  }
}

.close_banner {
  position: absolute;
  top: 5%;
  right: 5%;
  i {
    padding: 7px;
    color: #ff5a5f;
    font-size: 30px;
    cursor: pointer;
  }
}

@media only screen and (max-width: 576px) {
  .close_banner i {
    font-size: 20px;
    padding: 4px;
  }
}
</style>