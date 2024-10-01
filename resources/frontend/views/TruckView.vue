<template>
  <TruckCreateForm @truckCreated="addTruck" />

  <TruckListTable :trucks="truckList" @editTruck="openEditModal" @deleteTruck="removeTruck"
    @trucksLoaded="setTruckList" />

  <div v-if="isEditModalVisible" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <TruckEditModal :truck="truckToEdit" @cancelEdit="closeEditModal" @truckUpdated="updateTruck" />
  </div>
</template>

<script lang="ts">
import TruckCreateForm from '../modules/truck/TruckCreateForm.vue';
import TruckEditModal from '../modules/truck/TruckEditModal.vue';
import TruckListTable from '../modules/truck/TruckListTable.vue';
import { Truck } from '../models/Truck';

export default {
  name: 'TruckView',
  components: {
    TruckCreateForm,
    TruckEditModal,
    TruckListTable,
  },
  data() {
    return {
      truckList: [] as Truck[],
      isEditModalVisible: false,
      truckToEdit: {
        id: undefined,
        unit_number: '',
        year: '',
        notes: '',
      } as Truck,
    };
  },
  methods: {
    addTruck(newTruck: Truck) {
      this.truckList.push(newTruck);
    },
    updateTruck(updatedTruck: Truck) {
      const index = this.truckList.findIndex(truck => truck.id === updatedTruck.id);
      if (index !== -1) {
        this.truckList[index] = { ...this.truckList[index], ...updatedTruck };
      }
      this.isEditModalVisible = false;
    },
    removeTruck(id?: number) {
      this.truckList = this.truckList.filter(truck => truck.id !== id);
    },
    openEditModal(truck: Truck) {
      this.truckToEdit = { ...truck };
      this.isEditModalVisible = true;
    },
    closeEditModal() {
      this.isEditModalVisible = false;
    },
    setTruckList(fetchedTrucks: Truck[]) {
      this.truckList = fetchedTrucks;
    },
  },
};
</script>

<style scoped></style>
