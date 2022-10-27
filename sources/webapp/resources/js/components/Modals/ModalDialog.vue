<template>
  <TransitionRoot as="template" :show="show">
    <Dialog as="div" @close="closeModal" class="relative z-50">
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0">
        <div class="fixed inset-0 bg-black bg-opacity-25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95">
            <DialogPanel class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-6xl sm:w-full sm:p-6">
              <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                <button type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none" @click="show = false">
                  <span class="sr-only">Close</span>
                  <XIcon class="h-6 w-6" aria-hidden="true" />
                </button>
              </div>

              <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:text-left">
                  <DialogTitle as="h2" class="text-lg leading-6 font-medium text-gray-900 border-b pb-4">
                    <slot name="title" />
                  </DialogTitle>

                  <slot name="body" />
                </div>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
  import { ref, onMounted } from 'vue'
  import { Dialog, DialogPanel, DialogTitle, TransitionRoot, TransitionChild } from '@headlessui/vue'
  import { XIcon } from '@heroicons/vue/outline'
  import useEmitter from '../../composables/useEmitter'

  const emitter = useEmitter()

  const props = defineProps({
    open: { type: Boolean, required: false, default: false }
  })

  const show = ref(props.open)

  onMounted(() => {
    emitter.on('open-modal-dialog', () => {
      openModal()
    })

    emitter.on('close-modal-dialog', () => {
      closeModal()
    })
  })

  const closeModal = () => {
    open.value = false
  }

  const openModal = () => {
    open.value = true
  }
</script>