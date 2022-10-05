<template>
  <div class="modal-container" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!--
      Background backdrop, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="modal-backdrop"></div>

    <div class="modal-panel-container">
      <div class="modal-panel-parent">
        <!--
          Modal panel, show/hide based on modal state.

          Entering: "ease-out duration-300"
            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            To: "opacity-100 translate-y-0 sm:scale-100"
          Leaving: "ease-in duration-200"
            From: "opacity-100 translate-y-0 sm:scale-100"
            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->
        <div class="modal-panel">
          <slot name="body" />
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="postcss" scoped>
  .modal-container {
    @apply relative z-10;

    .modal-backdrop {
      @apply fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity;
    }

    .modal-panel-container {
      @apply fixed inset-0 z-10 overflow-y-auto;

      .modal-panel-parent {
        @apply flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0;

        .modal-panel {
          @apply relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg;
        }
      }
    }
  }
</script>