<template>
  <div class="bg-white p-8 rounded-lg max-w-md w-full">
    <form @submit.prevent="submitUpdate">
      <h2 class="text-lg font-semibold mb-4">Edit Truck</h2>
      <Alert type="danger" :message="errorMessage" />
      <div class="mb-5">
        <label for="unit_number" class="block mb-2 text-sm font-medium text-gray-900">Unit number</label>
        <InputField type="text" id="unit_number" v-model="formData.unit_number" placeholder="A-#####" required />
      </div>
      <div class="mb-5">
        <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Year</label>
        <InputField type="number" id="year" v-model="formData.year" placeholder="1994" required />
      </div>
      <div class="mb-5">
        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">Notes</label>
        <TextArea id="notes" v-model="formData.notes" placeholder="Leave a note..."></TextArea>
      </div>
      <div class="flex justify-end space-x-4">
        <button type="submit"
          class="bg-blue-700 text-white px-5 py-2.5 font-medium rounded-lg text-sm hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-500">Update</button>
        <button type="button" @click="cancelUpdate"
          class="bg-gray-300 text-gray-700 px-5 py-2.5 font-medium text-sm rounded-lg hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-400">Cancel</button>
      </div>
    </form>
  </div>
</template>

<script lang="ts">
import InputField from '../../components/InputField.vue';
import TextArea from '../../components/TextArea.vue';
import Alert from '../../components/Alert.vue';
import axios from 'axios';
import { Truck } from '../../models/Truck';

export default {
  name: 'TruckEditModal',
  components: {
    InputField,
    TextArea,
    Alert,
  },
  props: {
    truck: {
      type: Object as () => Truck,
      required: true,
      default: undefined
    },
  },
  data() {
    return {
      formData: {
        id: undefined,
        unit_number: '',
        year: '',
        notes: undefined,
      } as Truck,
      errorMessage: '',
    };
  },
  watch: {
    truck: {
      handler(newTruck: Truck) {
        this.formData = { ...newTruck };
      },
      immediate: true
    }
  },
  methods: {
    async submitUpdate() {
      this.errorMessage = '';
      axios.put(`http://localhost/trucks/${this.formData.id}`, this.formData as Truck)
        .then((response) => {
          this.$emit('truckUpdated', response.data as Truck);
        })
        .catch(error => {
          if (error.response && error.response.data && error.response.data.message) {
            this.errorMessage = error.response.data.message;
          } else {
            this.errorMessage = 'Error updating truck. Please try again later.';
          }
        });
    },
    cancelUpdate() {
      this.$emit('cancelEdit');
    }
  }
};
</script>

<style scoped></style>
