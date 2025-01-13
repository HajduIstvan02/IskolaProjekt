<template>
  <div>
    <h1>Sportok</h1>
    <table class="table w-auto">
      <thead>
        <tr>
          <th scope="col">Műveletek</th>
          <th scope="col">Sport</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="sport in rows" :key="sport.id">
          <td>
            <button type="button" class="btn btn-outline-success" @click="onClickAdd()">
              <i class="bi bi-plus-lg"></i>
            </button>
            <button type="button" class="btn btn-outline-primary ms-2" @click="onClickUpdate()">
              <i class="bi bi-pen"></i>
            </button>
            <button type="button" class="btn btn-outline-danger ms-2" @click="onClickDelete()">
              <i class="bi bi-trash"></i>
            </button>
          </td>
          <td>
            {{ sport.sportNev }}
          </td>
        </tr>
      </tbody>
    </table>
    <Modal
    :title="title"
      :yes="yes"
      :no="no"
      :size="size"
      @yesEvent="yesEventHandler"
    >Valami</Modal>
  </div>
</template>
  
  <script>
  class ModifySport{
    constructor(
      id = null,
      name = null,
    ) {
      this.id = id
      this.name = name

    }
  }

import { BASE_URL } from "../helpers/baseUrls";
import axios from "axios";
// import Modal from "@/components/Modal.vue";
import Modal from '../components/Modal.vue';

export default {
  components: {Modal},
  data() {
    return {
      modifyedSport: new ModifySport(this.uniqid()),
      rows: [],
      urlApi: BASE_URL,
      state: "read",
      size: "sm",
      title: "title",
      yes: "yes",
      no: "no",

    };
  },
  mounted() {
    this.getSports();
    this.modal = new bootstrap.Modal("#modal", {
      keyboard: false})
  },
  methods: {
    async getSports() {
      const url = `${this.urlApi}/sports`;
      const response = await axios.get(url);
      this.rows = response.data.data;
      console.log("Sportok", this.rows);
    },

    onClickAdd(){
      this.title = "New Sport"
      this.yes = null
      this.no = "Cancel"
      this.size = "lg"
      this.state = "add"
      this.modifyedSport = new ModifySport(this.uniqid())
    },

    onClickUpdate(){
      this.state = "update"
    },

    onClickDelete(){
      this.state = "delete"
    },
    yesEventHandler(){
      console.log("Yes");
      
    },
    uniqid(length = 10) {
      const characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      let result = "";
      for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        result += characters.charAt(randomIndex);
      }
      return result;
    },
  },
};
</script>
  
  <style>
</style>