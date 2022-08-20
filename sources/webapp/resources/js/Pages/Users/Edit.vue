<template>
  <Head title="Edit User" />

  <h1 class="font-semibold text-2xl text-gray-800 leading-tight py-4 mb-8 border-b">
    <Link class="text-gray-500 hover:text-gray-700" href="/cms/users">
      Users
    </Link>
    <span class="text-gray-500 font-medium">/</span> {{ userToEdit.name }}
  </h1>

  <div class="max-w-7xl bg-white rounded-md shadow overflow-hidden">
    <form @submit.prevent="onUpdate">
      <div class="flex flex-col -mb-8 -mr-6 p-8">
        <TextInput
          v-model="form.name"
          :error="form.errors.name"
          :required="true"
          class="pb-8 pr-6 w-full"
          label="Name"
        />

        <TextInput
          v-model="form.email"
          type="email"
          :error="form.errors.email"
          :required="true"
          class="pb-8 pr-6 w-full"
          label="Email"
        />

        <SelectInput
          v-model="form.role"
          :error="form.errors.role"
          :required="true"
          class="pb-8 pr-6 w-full"
          label="Role">
          <option v-if="!userToEdit.role" :value="null" />
          <option
            v-for="role in roles"
            :value="role"
            :selected="role === userToEdit.role">
            {{ __(role) }}
          </option>
        </SelectInput>

        <TextInput
          v-model="form.password"
          type="password"
          :error="form.errors.password"
          class="pb-8 pr-6 w-full"
          label="Password"
        />

        <TextInput
          v-model="form.password_confirmation"
          type="password"
          :error="form.errors.password_confirmation"
          class="pb-8 pr-6 w-full"
          label="Confirm password"
        />
      </div>

      <div class="flex items-center justify-between px-8 py-4 bg-gray-50 border-t border-gray-100">
        <button
          v-if="$page.props.can['delete-users']"
          class="text-red-600 hover:underline"
          tabindex="-1"
          type="button"
          @click="onDelete(userToEdit)">
          Delete User
        </button>

        <LoadingButton
          :loading="form.processing"
          class="btn-indigo ml-auto"
          type="submit">
          Update User
        </LoadingButton>
      </div>
    </form>
  </div>
</template>

<script>
  import CmsLayout from '@/Layouts/CmsLayout.vue'
  
  export default {
    layout: CmsLayout
  }
</script>

<script setup>
  import { Inertia } from '@inertiajs/inertia'
  import { useForm } from '@inertiajs/inertia-vue3'
  import TextInput from '@/Shared/TextInput'
  import SelectInput from '@/Shared/SelectInput'
  import LoadingButton from '@/Shared/LoadingButton'
  import useEmitter from '../../composables/useEmitter'

  const emitter = useEmitter()

  const props = defineProps({
    userToEdit: { type: Object, required: true },
    roles: { type: Object, required: true }
  })

  const form = useForm({
    name: props.userToEdit.name,
    email: props.userToEdit.email,
    role: props.userToEdit.role,
    password: null,
    password_confirmation: null,
  })

  const onUpdate = () => {
    form.put(`/cms/users/${props.userToEdit.id}`, {
      onSuccess: () => form.reset('password', 'password_confirmation')
    })
  }

  const onDelete = (user) => {
    let payload = {
      title: 'Delete User',
      message: `Are you sure you want to delete user '${user.name}'?`,
      confirmLabel: 'Delete',
      confirmCallback: () => {
        Inertia.post(`/cms/users/${user.id}`, { _method: 'DELETE' })
      }
    }
    emitter.emit('open-modal', payload)
  }
</script>
