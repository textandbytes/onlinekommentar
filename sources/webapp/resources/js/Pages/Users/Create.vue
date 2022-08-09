<template>
  <Head title="Create User" />

  <h1 class="font-semibold text-2xl text-gray-800 leading-tight py-4 mb-8 border-b border-gray-200">
    <Link class="text-ok-blue-400 hover:text-ok-blue-600" href="/cms/users">
      Users
    </Link>
    <span class="text-ok-blue-400 font-medium">/</span> Create
  </h1>

  <div class="max-w-7xl bg-white rounded-md shadow overflow-hidden">
    <form @submit.prevent="store">
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

        <TextInput
          v-model="form.password"
          type="password"
          :error="form.errors.password"
          :required="true"
          class="pb-8 pr-6 w-full"
          label="Password"
        />

        <TextInput
          v-model="form.password_confirmation"
          type="password"
          :error="form.errors.password_confirmation"
          :required="true"
          class="pb-8 pr-6 w-full"
          label="Confirm password"
        />

        <SelectInput
          v-model="form.role"
          :error="form.errors.role"
          :required="true"
          class="pb-8 pr-6 w-full"
          label="Role">
          <option :value="null" />
          <option value="admin">Admin</option>
          <option value="editor">Editor</option>
          <option value="commentator">Commentator</option>
        </SelectInput>
      </div>

      <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
        <LoadingButton
          :loading="form.processing"
          class="btn-indigo"
          type="submit">
          Create User
        </LoadingButton>
      </div>
    </form>
  </div>
</template>

<script setup>
  import { useForm } from '@inertiajs/inertia-vue3'
  import TextInput from '@/Shared/TextInput'
  import SelectInput from '@/Shared/SelectInput'
  import LoadingButton from '@/Shared/LoadingButton'

  const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    role: null
  })

  const store = () => {
    form.post('/cms/users')
  }
</script>
