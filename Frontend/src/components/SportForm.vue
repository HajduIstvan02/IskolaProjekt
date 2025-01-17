<template>
  <div>
    <p>{{ sportForm }}</p>
    <form class="row g-4 needs-validation was-validated" novalidate>
      <!-- Name -->
      <div class="col-md-8">
        <label for="name" class="form-label">Név:</label>
        <input
          type="text"
          class="form-control"
          id="name"
          required
          v-model="sportForm.sportNev"
        />
        <div class="valid-feedback">&nbsp;</div>
        <div class="invalid-feedback">Név kitöltése kötelező</div>
      </div>
      <button type="submit" class="btn btn-success">Mentés</button>
    </form>
  </div>


</template>

<script>
export default {
  props: ["sportForm"],
  emits: ["saveSport"],
  mounted() {
    const forms = document.querySelectorAll(".needs-validation");

    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
      form.addEventListener(
        "submit",
        (event) => {
          event.preventDefault();
          event.stopPropagation();
          if (form.checkValidity()) {
            this.onClickSubmit();
          }
        },
        false
      );
    });
  },
  methods: {
    onClickSubmit() {
      console.log("Mentés");
      this.$emit("saveSport", this.sportForm);
    },
  },
  computed: {

      },
 
};
</script>

<style>
</style>