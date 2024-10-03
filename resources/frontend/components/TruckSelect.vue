<template>
    <div class="mb-5">
      <label class="block mb-2 text-sm font-medium text-gray-900">{{ label }}</label>
      <select
        v-model="internalSelectedTruckId"
        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 outline-blue-500"
      >
        <option value=0 selected hidden>{{ placeholder }}</option>
        <option v-for="truck in trucks" :key="truck.id" :value="truck.id">{{ truck.unit_number }} - {{ truck.year }}</option>
      </select>
    </div>
  </template>

  <script lang="ts">
  import { Truck } from '../models/Truck';

  export default {
    name: 'TruckSelect',
    props: {
      modelValue: {
        type: Number,
        required: true,
      },
      trucks: {
        type: Array as () => Truck[],
        required: true,
      },
      label: {
        type: String,
        required: true,
      },
      placeholder: {
        type: String,
        default: 'Select a truck',
      },
    },
    emits: ['update:modelValue'],
    computed: {
      internalSelectedTruckId: {
        get() {
          return this.modelValue;
        },
        set(value) {
          this.$emit('update:modelValue', value);
        },
      },
    },
  };
  </script>

  <style scoped></style>
