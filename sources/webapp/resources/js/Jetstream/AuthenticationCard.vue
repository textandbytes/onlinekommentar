<template>
    <div class="min-h-48 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-ok-blue shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
