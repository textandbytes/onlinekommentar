<template>
  <div class="flex flex-col relative p-8 transition ease-in-out delay-150 bg-white group">
    <div v-if="user.legal_domain" class="mb-4 text-xs tracking-widest text-center uppercase">
      {{ $t(user.legal_domain.label) }}
    </div>

    <div class="flex flex-col items-center justify-between space-y-6">
      <img v-if="user.avatar" :src="user.avatar" class="object-cover rounded-full w-28 h-28 lg:w-32 lg:h-32 xl:w-36 xl:h-36 grayscale" />
      <span v-else class="bg-gray-200 rounded-full w-28 h-28 lg:w-32 lg:h-32 xl:w-36 xl:h-36"></span>

      <h2 class="font-serif text-3xl font-medium !leading-snug text-center lg:text-4xl 2xl:text-5xl" style="word-spacing: 999px">
        {{ user.name }}
      </h2>

      <div class="text-sm text-center lg:text-base">
        {{ user.title }}
      </div>
    </div>
    <div class="self-end w-full mt-auto">
      <div class="w-full text-sm lg:text-base mt-8 mb-4 border-y border-black divide-y divide-black min-h-[60px]">
        <div class="flex justify-center items-center py-2 h-48">
          {{ user.occupation ?? '' }}
        </div>
      
        <div v-if="user.editor_of" class="py-2">
          <div>
            {{ user.editor_of }}
          </div>
          <!-- <div
            v-for="commentary in user.edited_commentaries"
            :key="commentary.id">
            &mdash; <a :href="'/' + locale + '/kommentare/' + commentary.slug" class="underline">{{ commentary.title }}</a>
          </div> -->
        </div>

        <div v-if="user.authored_commentaries" class="py-2">
          <div>
            {{ $t('author_of')}}
          </div>
          <div
            v-for="commentary in user.authored_commentaries"
            :key="commentary.id">
            &mdash; <a :href="'/' + locale + '/kommentare/' + commentary.slug" class="underline">{{ commentary.title }}</a>
          </div>
        </div>
      </div>

      <div class="flex items-center justify-between w-full">
        <div class="flex mt-2 space-x-2">
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
            class="inline-flex items-center p-1 border border-2 border-black text-xs font-medium uppercase rounded-sm text-white bg-black hover:bg-white hover:text-black"
            target="_blank"
            rel="noopener">
            Website
          </a>
        </div>

        <slot name="buttons" />
      </div>
    </div>

  </div>
</template>

<script setup>
  defineProps({
    locale: { type: String, required: true },
    user: { type: Object, required: true }
  })
</script>