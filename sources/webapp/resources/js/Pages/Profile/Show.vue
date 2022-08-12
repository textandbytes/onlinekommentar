<template>
  <Head title="Profile" />

  <h1 class="font-semibold text-2xl text-gray-800 leading-tight py-4 mb-8">
    Profile
  </h1>

  <div v-if="$page.props.jetstream.canUpdateProfileInformation">
    <UpdateProfileInformationForm :user="$page.props.user" />

    <JetSectionBorder />
  </div>

  <div v-if="$page.props.jetstream.canUpdatePassword">
    <UpdatePasswordForm class="mt-10 sm:mt-0" />

    <JetSectionBorder />
  </div>

  <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
    <TwoFactorAuthenticationForm 
      :requires-confirmation="confirmsTwoFactorAuthentication"
      class="mt-10 sm:mt-0" 
    />

    <JetSectionBorder />
  </div>

  <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />

  <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
    <JetSectionBorder />

    <DeleteUserForm class="mt-10 sm:mt-0" />
  </template>
</template>

<script>
  import CmsLayout from '@/Layouts/CmsLayout.vue'
  
  export default {
    layout: CmsLayout
  }
</script>

<script setup>
  import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue'
  import JetSectionBorder from '@/Jetstream/SectionBorder.vue'
  import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue'
  import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue'
  import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue'
  import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue'

  defineProps({
      confirmsTwoFactorAuthentication: Boolean,
      sessions: Array,
  })
</script>