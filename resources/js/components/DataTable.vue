<template>
  <div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 bg-gray-50 border-b">
      <h2 class="text-lg font-bold text-gray-800">{{ title }}</h2>
    </div>

    <div class="p-6">
      <button 
        @click="showForm = !showForm"
        class="mb-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
      >
        {{ showForm ? 'Cancelar' : 'Novo' }}
      </button>

      <div v-if="showForm" class="mb-6 p-4 bg-gray-50 rounded">
        <slot name="form"></slot>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-100">
            <tr>
              <slot name="headers"></slot>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item.id" class="border-t hover:bg-gray-50">
              <slot name="row" :item="item"></slot>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DataTable',
  props: {
    title: String,
    items: Array,
    default: () => []
  },
  data() {
    return {
      showForm: false
    }
  }
}
</script>
