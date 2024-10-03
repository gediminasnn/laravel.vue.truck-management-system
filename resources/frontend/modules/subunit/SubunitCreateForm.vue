<template>
  <form class="mx-8" @submit.prevent="assignSubunit">
    <h2 class="text-lg font-semibold mb-4">Assign Subunit</h2>
    <Alert :message="errorMessage" type="danger" />
    <Alert :message="successMessage" type="success" />
    <TruckSelect :trucks="trucks" v-model="formData.main_truck_id" label="Main Truck" placeholder="Select main truck" />
    <TruckSelect :trucks="trucks" v-model="formData.subunit_truck_id" label="Subunit Truck"
      placeholder="Select subunit truck" />
    <div class="mb-5">
      <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Start Date</label>
      <InputField type="date" id="start_date" v-model="formData.start_date" required />
    </div>
    <div class="mb-5">
      <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">End Date</label>
      <InputField type="date" id="end_date" v-model="formData.end_date" />
    </div>
    <button type="submit"
      class="mb-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
      Submit
    </button>
  </form>
</template>

<script lang="ts">
import Alert from '../../components/Alert.vue';
import TruckSelect from '../../components/TruckSelect.vue';
import InputField from '../../components/InputField.vue';
import axios from 'axios';
import { Subunit } from '../../models/Subunit.ts';
import { Truck } from '../../models/Truck.ts';

export default {
  name: 'SubunitCreateForm',
  components: {
    Alert,
    InputField,
    TruckSelect,
  },
  data() {
    return {
      formData: {
        main_truck_id: 0,
        subunit_truck_id: 0,
        start_date: '',
        end_date: '',
      } as Subunit,
      trucks: [] as Truck[],
      errorMessage: '',
      successMessage: '',
    };
  },
  mounted() {
    this.fetchTrucks();
  },
  methods: {
    fetchTrucks() {
      axios.get('http://localhost/trucks')
        .then((response) => {
          this.trucks = response.data;
        })
        .catch((error) => {
          console.error('Error fetching trucks:', error);
          this.errorMessage = 'Failed to load trucks. Please try again.';
        });
    },
    assignSubunit() {
      this.errorMessage = '';
      this.successMessage = '';
      axios.post('http://localhost/subunits', this.formData)
        .then(() => {
          this.successMessage = 'Subunit assigned successfully!';
          this.resetForm();
        })
        .catch((error) => {
          if (error.response && error.response.data && error.response.data.message) {
            this.errorMessage = error.response.data.message;
          } else {
            this.errorMessage = 'Error assigning subunit. Please check your input and try again.';
          }
        });
    },
    resetForm() {
      this.formData = {
        main_truck_id: 0,
        subunit_truck_id: 0,
        start_date: '',
        end_date: '',
      };
    },
  },
};
</script>

<style scoped></style>
