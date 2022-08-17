<template>
  <div :class="$attrs.class">
    <label
      v-if="label"
      :for="id"      
      class="block font-medium text-sm text-gray-700"
      :class="{ 'required': required }">
      {{ label }}
    </label>

    <textarea
      :id="id"
      ref="input"
      v-bind="{ ...$attrs, class: null }"
      class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
      :class="{ 'border border-red-700': error }"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    />

    <div
      v-if="error"
      class="block font-medium text-sm text-red-700 mt-2 ml-1">
      {{ error }}
    </div>
  </div>
</template>

<script>
  import { v4 as uuid } from 'uuid'

  export default {
    inheritAttrs: false,

    props: {
      id: { type: String, default() { return `textarea-input-${uuid()}` } },
      error: String,
      required: Boolean,
      label: String,
      modelValue: String
    },

    emits: ['update:modelValue'],

    methods: {
      focus() {
        this.$refs.input.focus()
      },

      select() {
        this.$refs.input.select()
      }
    }
  }
</script>

<style lang="postcss" scoped>
  .required:after {
    content: " *";
    color: red;
  }
</style>