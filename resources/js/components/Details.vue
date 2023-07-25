<template>

  <div class="max-w-sm p-6 bg-white border border-gray-100 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700 m-5">
    <img :src="`data:image/png;base64,${item.image}`" />
    <p class="text-white text-bold">Name: {{ item.name }}</p>
    <p class="text-white text-bold">Weight: {{ item.weight }}</p>
    <p class="text-white text-bold">Height: {{ item.height }}</p>
    <div class="flex justify-content-between">
      <div><p class="text-white text-bold">Types:</p></div>
      <div class=" ml-3">
        <ul class="text-white text-bold">
          <li v-for="type in types">
            {{ type }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
  import axiosClient from '../axios/axios';
  import {useRoute} from "vue-router";

  export default {
    mounted() {
      
    },

    data() {
      return {
          route: useRoute(),
          item: '',
          types: {}
      };
    },

    created() {
        axiosClient.get('pokemon/' + this.route.params.name).then(res => {
            this.item = res.data;
            this.types = this.item.types;
        });
    },

  };
</script>