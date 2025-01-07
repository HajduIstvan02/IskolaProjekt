<template>
    <div>
  
      <h2>Nevsor</h2>
      
    </div>
  </template>
  
  <script>
  import { BASE_URL } from "../helpers/baseUrls";
  import axios from "axios";


 
  export default {
    data() {

      
      return {
        
        osztalyok: [],
      }
    },

    methods: {
      async getIskolaNevsor() {
      
      const url = `${BASE_URL}/queryOsztalynevsorObj`;
      const response = await axios.get(url);
      this.osztalyok = response.data.data;
      console.log(this.osztalyok);
      
    },
    async mounted() {
      //  await this.getIskolaNevsor();

    }
    }
  }
  </script>
  
  <style>
  
  </style>
  