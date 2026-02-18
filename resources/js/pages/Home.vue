<template>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
      <h2 class="text-xl font-bold text-gray-800 mb-2">Cemitérios</h2>
      <p class="text-gray-600 mb-4">Gerencie os cemitérios cadastrados no sistema teste</p>
      <router-link to="/cemiterios" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Acessar
      </router-link>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
      <h2 class="text-xl font-bold text-gray-800 mb-2">Quadras</h2>
      <p class="text-gray-600 mb-4">Organize as quadras dentro dos cemitérios</p>
      <router-link to="/quadras" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
        Acessar
      </router-link>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
      <h2 class="text-xl font-bold text-gray-800 mb-2">Jazigos</h2>
      <p class="text-gray-600 mb-4">Gerencie os jazigos das quadras</p>
      <router-link to="/jazigos" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
        Acessar
      </router-link>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
      <h2 class="text-xl font-bold text-gray-800 mb-2">Sepultamentos</h2>
      <p class="text-gray-600 mb-4">Registre os sepultamentos realizados</p>
      <router-link to="/sepultamentos" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
        Acessar
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Home'
}
</script>
