<template>
    <div>
      <!-- törlés -->
      <button
        type="button"
        class="btn btn-outline-danger btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#modal"
        @click="onClickDeleteButton(sportForm)"
      >
        <i class="bi bi-trash3"></i>
      </button>
      <!-- módosítás -->
      <button
        type="button"
        class="btn btn-outline-primary btn-sm ms-2"
        data-bs-toggle="modal"
        data-bs-target="#modal"
        @click="onClickUpdate(sportForm)"
      >
        <i class="bi bi-pencil"></i>
      </button>
      <!-- új -->
      <button
        type="button"
        class="btn btn-outline-success btn-sm ms-2"
        data-bs-toggle="modal"
        data-bs-target="#modal"
        @click="onClickCreate()"
      >
        <i class="bi bi-plus-lg"></i>
      </button>
    </div>
  </template>
  
  <script>
  export default {
    props: ["sportForm"],
    emits: ["onClickDeleteButton", "onClickUpdate", "onClickCreate"],
    methods: {
      onClickDeleteButton(sportForm) {
        this.$emit("onClickDeleteButton", sportForm);
      },
      onClickUpdate(sportForm) {
        this.$emit("onClickUpdate", sportForm);
      },
      onClickCreate() {
        this.$emit("onClickCreate");
      },
    },
  };
  </script>
  
  <style>
  </style>