    <template>
      <textarea :value="modelValue" @input="onInput($event)" :placeholder="placeholder"
        class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-blue-500"
        rows="2"></textarea>
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
      default: 'Leave a note...'
    },
  },
  methods: {
    onInput(event: Event) {
      const textarea = event.target as HTMLTextAreaElement;
      if (textarea) {
        this.$emit('update:modelValue', textarea.value);
      }
    }
  },
};
</script>

<style scoped></style>
