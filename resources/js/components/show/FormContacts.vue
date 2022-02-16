<template>
  <div>
    <div class="close_form d-flex justify-content-end">
      <i @click="$emit('closeForm')" class="fas fa-times"></i>
    </div>
    <form v-if="!formSend" @submit.prevent="onFormSubmit">
      <div class="form-group mb-3">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" v-model="form.name" />
      </div>

      <div class="form-group mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" v-model="form.email" />
      </div>

      <div class="form-group mb-3">
        <label class="form-label">Oggetto</label>
        <input
          type="text"
          class="form-control"
          v-model="form.object"
          value="Appartamento Vista Mare"
          readonly
        />
      </div>

      <div class="form-group mb-3">
        <label class="form-label">Messaggio</label>
        <textarea
          type="text"
          rows="5"
          class="form-control"
          v-model="form.content"
        ></textarea>
      </div>

      <div class="text-center py-3">
        <button class="btn btn-success">Invia</button>
      </div>
    </form>
    <div v-else class="alert alert-success">
      <h5 class="mb-0">Messaggio inviato correttamente</h5>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    formSend: {
      type: Boolean,
    },
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        object: "",
        content: "",
      },
    };
  },
  methods: {
    onFormSubmit() {
      // Fare chiamata Api
      this.$emit("sendForm");
    },
  },
};
</script>

<style scoped lang="scss">
.close_form {
  i {
    padding: 5px;
    color: #ff5a5f;
    font-size: 20px;
    cursor: pointer;
  }
}
</style>