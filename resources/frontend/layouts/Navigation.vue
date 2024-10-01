<template>
  <nav class="bg-white rounded-3xl m-5">
    <div class="max-w-screen-xl px-4 py-3 mx-auto">
      <div class="flex items-center">
        <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
          <li>
            <RouterLink class="text-gray-900 hover:underline" aria-current="page" to="/">Trucks</RouterLink>
          </li>
          <li>
            <RouterLink class="text-gray-900 hover:underline" to="/sub-trucks">Sub-trucks</RouterLink>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script lang="ts">
export default {
  name: 'Navigation',
};
</script>

<style scoped></style>
