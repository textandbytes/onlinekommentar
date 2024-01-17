<template>
  <div class="flex flex-col">
    <div class="lg:flex lg:items-center lg:justify-between space-y-2 lg:space-y-0 px-4 py-2 md:px-6 border-b border-black bg-white">
      <div class="text-xs uppercase font-medium tracking-wider">
        {{ title }}
      </div>

      <div class="flex flex-col lg:flex-row space-y-2 lg:space-x-2 lg:space-y-0">
        <!-- <button
          type="button"
          :class="viewMode === 'list' ? 'bg-ok-beige' : 'bg-white'"
          class="inline-flex items-center px-3 py-1 border border-ok-dark-gray shadow-sm text-xs uppercase leading-4 font-medium rounded-md text-black bg-white hover:bg-ok-light-beige focus:outline-none focus:ring-1 focus:ring-gray-300 tracking-wider"
          @click="">
          <img class="mr-2" src="/img/list.svg" alt="{{ $t('list_view') }}"> {{ $t('list_view') }}
        </button>

        <button
          type="button"
          :class="viewMode === 'grid' ? 'bg-ok-beige' : 'bg-white'"
          class="inline-flex items-center px-3 py-1 border border-ok-dark-gray shadow-sm text-xs uppercase leading-4 font-medium rounded-md text-black bg-white hover:bg-ok-light-beige focus:outline-none focus:ring-1 focus:ring-gray-300 tracking-wider">
          <img class="mr-2" src="/img/grid.svg" alt="{{ $t('grid_view') }}"> {{ $t('grid_view') }}
        </button> -->

        <FlyoutMenuWithDividers
          v-if="legalDomains.length > 0"
          class="lg:min-w-[300px] lg:max-w-[300px] xl:min-w-[450px] xl:max-w-[450px] uppercase tracking-wider"
          :label="$t('legal_domain_filter_label')"
          :options="legalDomains"
          :active-option="activeLegalDomain"
          @changed="onFilter"
        />
      </div>
    </div>

    <GridListView
      :items="filteredUsers"
      class="bg-ok-beige sm:gap-x-px sm:gap-y-4">
      <template v-slot:item="user">
        <UserCard :locale="locale" :user="user">
          <template v-if="user.slug" v-slot:buttons>
            <a
              class="ok-button"
              :href="basePathPrefix + '/' + user.slug">
              {{ $t('view_user') }}
            </a>
          </template>
        </UserCard>
      </template>
    </GridListView>
  </div>
</template>

<script setup>
  import { ref } from 'vue'
  import GridListView from './GridListView'
  import UserCard from './UserCard'
  import FlyoutMenuWithDividers from '@/components/Menus/FlyoutMenuWithDividers'

  const props = defineProps({
    locale: { type: String, required: true },
    title: { type: String, required: true },
    users: { type: Array, required: true },
    legalDomains: { type: Array, required: true },
    basePathPrefix: { type: String, required: true }
  })

  const viewMode = 'grid'

  const filteredUsers = ref(props.users)

  const activeLegalDomain = ref(props.legalDomains[0])

  const onFilter = (legalDomain) => {
    // reset the list of filtered users
    filteredUsers.value = props.users

    if (legalDomain.id) {
      filteredUsers.value = filteredUsers.value.filter(user => {
        return user.legal_domains && (user.legal_domains.map(legal_domain => legal_domain.id).includes(legalDomain.id))
      })
    }
  }
</script>