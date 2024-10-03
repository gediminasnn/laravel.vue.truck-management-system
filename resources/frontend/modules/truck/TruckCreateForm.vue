<template>
    <form class="mx-8" @submit.prevent="createTruck">
      <h2 class="text-lg font-semibold mb-4">Create Truck</h2>
      <Alert type="danger" :message="errorMessage" />
      <Alert type="success" :message="successMessage" />
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
      <button type="submit"
        class="mb-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
    </form>
  </template>

  <script lang="ts">
  import Alert from '../../components/Alert.vue';
  import InputField from '../../components/InputField.vue';
  import TextArea from '../../components/TextArea.vue';
  import { Truck } from '../../models/Truck';
  import axios from 'axios';

  export default {
    name: 'TruckCreateForm',
    components: {
      InputField,
      TextArea,
      Alert,
    },
    data() {
      return {
        formData: {
          unit_number: '',
          year: '',
          notes: ''
        } as Truck,
        errorMessage: '',
        successMessage: '',
      };
    },
    methods: {
      async createTruck() {
        this.errorMessage = '';
        this.successMessage = '';
        axios.post('http://localhost/trucks', this.formData)
          .then((response) => {
            this.successMessage = 'Truck created successfully!';
            this.$emit('truckCreated', response.data as Truck);
            this.resetForm();
          })
          .catch((error) => {
            if (error.response && error.response.data && error.response.data.message) {
              this.errorMessage = error.response.data.message;
            } else {
              this.errorMessage = 'Error creating truck. Please check your input and try again.';
            }
          });
      },
      resetForm() {
        this.formData = {
          unit_number: '',
          year: '',
          notes: '',
        };
      },
    },
  };
  </script>

  <style scoped></style>
