<template>
  <div class="relative group transition ease-in-out delay-150 bg-white p-8 cursor-pointer">
    <div class="text-xs uppercase mb-4 text-center" v-html="user.practice">
      
    </div>

    <div class="flex flex-col items-center justify-between space-y-6">
      <img v-if="user.avatar" :src="user.avatar" class="w-24 h-24 rounded-full grayscale" />
      <span v-else class="w-24 h-24 rounded-full bg-gray-200"></span>

      <h2 class="text-5xl text-center font-medium font-regular leading-normal" style="word-spacing: 999px">
        {{ user.name }}
      </h2>

      <div class="text-xs text-center">
        {{ user.title }}
      </div>
    </div>

    <div
      class="w-full text-sm mt-8 mb-4 py-2 border-y border-black min-h-[60px]">
      {{ user.occupation ?? '' }}
    </div>

    <div class="w-full flex items-center justify-between">
      <div class="mt-4 space-x-2">
        <a
          v-if="user.linkedin_url"
          :href="user.linkedin_url"
          class="inline-flex"
          target="_blank"
          rel="noopener">
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 32 32">
            <path id="Icon_awesome-linkedin" data-name="Icon awesome-linkedin" d="M29.714,2.25H2.279A2.3,2.3,0,0,0,0,4.557V31.943A2.3,2.3,0,0,0,2.279,34.25H29.714A2.3,2.3,0,0,0,32,31.943V4.557A2.3,2.3,0,0,0,29.714,2.25ZM9.671,29.679H4.929V14.407h4.75V29.679ZM7.3,12.321a2.75,2.75,0,1,1,2.75-2.75,2.751,2.751,0,0,1-2.75,2.75ZM27.45,29.679H22.707V22.25c0-1.771-.036-4.05-2.464-4.05-2.471,0-2.85,1.929-2.85,3.921v7.557H12.65V14.407H17.2v2.086h.064a5,5,0,0,1,4.493-2.464c4.8,0,5.693,3.164,5.693,7.279Z" transform="translate(0 -2.25)"/>
          </svg>
        </a>

        <a
          v-if="user.website_url"
          :href="user.website_url"
          class="inline-flex items-center px-3 py-1.5 border border-2 border-black text-xs font-medium uppercase rounded-md text-white bg-black hover:bg-white hover:text-black"
          target="_blank"
          rel="noopener">
          Website
        </a>
      </div>

      <slot name="buttons" />
    </div>
  </div>
</template>

<script setup>
  defineProps({
    user: { type: Object, required: true }
  })
</script>