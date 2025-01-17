<template>
  <div>
    <h2>Foglalkozások</h2>
    <!-- Táblázat -->

    <table class="table table-striped">
      <thead>
        <tr>
          <!-- rename -->
          <th scope="col">Műveletek</th>
          <th scope="col">Foglalkozás</th>
          <th scope="col">Fizetés</th>
          <th scope="col">Munkaidő</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="sportForm in collection"
          :key="sportForm.id"
          @click="onClickTr(sportForm.id)"
          :class="{ 'table-success': selectedRowDataLineId == sportForm.id }"
        >
          <td class="text-nowrap">
            <OperationsCrud
              :sportForm="sportForm"
              @onClickDeleteButton="onClickDeleteButton"
              @onClickUpdate="onClickUpdate"
              @onClickCreate="onClickCreate"
            />
          </td>
          <!-- rename -->
          <td>{{ sportForm.sportNev }}</td>
        </tr>
      </tbody>
    </table>
    <!-- Modal -->
    <Modal
      :title="title"
      :yes="yes"
      :no="no"
      :size="size"
      @yesEvent="yesEventHandler"
    >
      <!-- yes-no (Modal) -->
      <div v-if="state == 'Delete'">
        {{ messageYesNo }}
      </div>

      <!-- Form person -->
      <SportForm
        v-if="state == 'Create' || state == 'Update'"
        :sportForm="sportForm"
        @saveDataLine="saveDataLineHandler"
      />
    </Modal>
  </div>
</template>

<script>
import { BASE_URL } from "../helpers/baseUrls";
import axios from "axios";
import * as bootstrap from "bootstrap";
import Modal from "@/components/Modal.vue";
import OperationCrud from "@/components/OperationsCrud.vue";
import SportForm from "@/components/SportForm.vue";

class ModifySport {
  constructor(sportNev = null) {
    this.sportNev = sportNev;
  }
}

export default {
  components: {
    Modal,
    OperationCrud,
    SportForm,
  },
  data() {
    return {
      modal: null,
      sportForm: new ModifySport(),
      selectedRowDataLineId: null,
      messageYesNo: null,
      state: "Read", //CRUD: Create, Read, Update, Delete
      title: null,
      yes: null,
      no: null,
      size: null,
    };
  },
  mounted() {
    this.getSports();
    this.modal = new bootstrap.Modal("#modal", {
      keyboard: false,
    });
  },
  methods: {
    async getSports() {
      const url = `${this.urlApi}/sports`;
      const response = await axios.get(url);
      this.collection = response.data.data;
      console.log("Sportok", this.rows);
    },
    deleteDataLineById() {
      const url = `${this.urlApi}/sports/${this.selectedRowDataLineId}`;

    },
    //rename
    createDataLine() {
      this.collection.push(this.dataLine);
      this.state = "Read";
    },
    //reaname
    updateDataLine() {
      const index = this.collection.findIndex((p) => p.id == this.dataLine.id);
      this.collection[index] = this.dataLine;
      this.state = "Read";
    },
    onClickAdd() {
      this.title = "Új Sport Hozzáadása";
      this.yes = "Mentés";
      this.no = "Mégse";
      this.size = "lg";
      this.state = "add";
      this.sportForm = new ModifySport();
      this.modal.show();
    },
    onClickUpdate(sport) {
      this.title = "Sport Módosítása";
      this.yes = "Mentés";
      this.no = "Mégse";
      this.size = "lg";
      this.state = "update";
      this.sportForm = new ModifySport(sport.id, sport.sportNev);
      this.modal.show();
    },
    onClickDelete(sport) {
      this.title = "Sport Törlése";
      this.yes = "Törlés";
      this.no = "Mégse";
      this.size = "sm";
      this.state = "delete";
      this.sportForm = new ModifySport(sport.id, sport.sportNev);
      this.modal.show();
    },
    yesEventHandler() {
      console.log("Yes action triggered for state:", this.state);
      this.modal.hide();
    },
  },
};
</script>

<style>
/* Stílusok itt */
</style>
