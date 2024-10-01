<template>
  <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-3">Unit Number</th>
        <th scope="col" class="px-6 py-3">Year</th>
        <th scope="col" class="px-6 py-3">Notes</th>
        <th scope="col" class="px-6 py-3">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="truck in trucks" :key="truck.id" class="border-b">
        <td class="px-6 py-4">{{ truck.unit_number }}</td>
        <td class="px-6 py-4">{{ truck.year }}</td>
        <td class="px-6 py-4">{{ truck.notes || 'No notes' }}</td>
        <td class="px-6 py-4 flex space-x-4">
          <button @click="triggerEdit(truck)" class="rounded-md bg-blue-600 p-2.5">
            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
            </svg>
          </button>
          <button @click="triggerDelete(truck.id)" class="rounded-md bg-red-600 p-2.5">
            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd"
                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script lang="ts">
import { Truck } from '../../models/Truck';
import axios from 'axios';

export default {
  name: 'TruckListTable',
  props: {
    trucks: {
      type: Array as () => Truck[],
      required: true,
      default: undefined
    },
  },
  methods: {
    async fetchTrucks() {
      axios.get('http://localhost/trucks')
        .then((response) => {
          this.$emit('trucksLoaded', response.data as Truck[]);
        })
        .catch((error) => {
          console.error('Error fetching trucks:', error);
        });

    },
    async triggerDelete(id?: number) {
      axios.delete(`http://localhost/trucks/${id}`)
        .then(() => {
          this.$emit('deleteTruck', id);
        })
        .catch((error) => {
          console.error('Error deleting truck:', error);
        });
    },
    triggerEdit(truck: Truck) {
      this.$emit('editTruck', truck);
    }
  },
  mounted() {
    this.fetchTrucks();
  },
};
</script>

<style scoped></style>
