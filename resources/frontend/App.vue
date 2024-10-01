<template>
  <div class="mx-auto bg-white rounded-3xl m-5 max-w-2xl">
    <Navigation />
    <RouterView />
  </div>
</template>

<script lang="ts">
import Navigation from './layouts/Navigation.vue';

export default {
  name: 'App',
  components: {
    Navigation,
  },
};
</script>

<style scoped></style>
