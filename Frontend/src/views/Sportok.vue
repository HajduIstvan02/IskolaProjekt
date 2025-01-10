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
import { BASE_URL } from "../helpers/baseUrls";
import axios from "axios";
// import Modal from "@/components/Modal.vue";
import Modal from '../components/Modal.vue';

export default {
  components: {Modal},
  data() {
    return {
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
  },
  methods: {
    async getSports() {
      const url = `${this.urlApi}/sports`;
      const response = await axios.get(url);
      this.rows = response.data.data;
      console.log("Sportok", this.rows);
    },

    onClickAdd(){
      this.state = "add"
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
  },
};
</script>
  
  <style>
</style>