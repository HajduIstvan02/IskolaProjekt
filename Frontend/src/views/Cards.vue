<template>
  <div>
    <h1>Cards Page</h1>
    <!-- Gombok a három komponens kiválasztásához -->
    <button class="btn btn-primary" @click="showComponent('Component1')">1</button>
    <button class="btn btn-primary" @click="showComponent('Component2')">2</button>
    <button class="btn btn-primary" @click="showComponent('Component3')">3</button>

    <!-- Dinamikus komponens megjelenítése -->
    <div v-if="currentComponent">
      <component :is="currentComponent" />
    </div>
  </div>
</template>

<script>
import Component1 from './1.vue'; 
import Component2 from './2.vue'; 
import Component3 from './3.vue'; 

export default {
  name: 'Cards',
  components: {
    Component1, // Regisztráljuk a komponenst
    Component2,
    Component3
  },
  data() {
    return {
      currentComponent: null 
    };
  },
  methods: {
    showComponent(componentName) {
      
      this.currentComponent = componentName;
    }
  }
};
</script>

<style scoped>

</style>
