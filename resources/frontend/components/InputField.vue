<template>
    <input
      :value="modelValue"
      @input="onInput($event)"
      :placeholder="placeholder"
      class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 outline-blue-500"
    />
  </template>

  <script lang="ts">
  export default {
    props: {
      modelValue: {
        type: String,
        default: undefined
      },
      placeholder: {
        type: String,
        default: undefined
      },
    },
    methods: {
      onInput(event: Event) {
        const input = event.target as HTMLInputElement;
        if (input) {
          this.$emit('update:modelValue', input.value);
        }
      }
    },
  };
  </script>

  <style scoped>
  </style>
