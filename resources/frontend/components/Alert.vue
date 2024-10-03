<template>
  <div v-if="message" :class="alertClasses" role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
      fill="currentColor" viewBox="0 0 20 20">
      <path
        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <div>
      <span class="font-medium">{{ message }}</span>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  name: 'Alert',
  props: {
    message: {
      type: String,
      required: false,
      default: undefined
    },
    type: {
      type: String,
      required: true,
    },
  },
  computed: {
    alertClasses() {
      const baseClasses = "flex items-center p-4 mb-4 text-sm rounded-lg border";
      const types = {
        info: "text-blue-800 bg-blue-50 border-blue-300",
        danger: "text-red-800 bg-red-50 border-red-300",
        success: "text-green-800 bg-green-50 border-green-300",
        warning: "text-yellow-800 bg-yellow-50 border-yellow-300",
        dark: "text-gray-800 bg-gray-50 border-gray-300"
      };
      return `${baseClasses} ${types[this.type]}`;
    },
  }
};
</script>

<style scoped></style>
