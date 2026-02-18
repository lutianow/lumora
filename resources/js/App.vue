<template>
  <div id="app" class="min-h-screen bg-gray-50">
    <nav class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <h1 class="text-2xl font-bold text-blue-600">Lumora</h1>
            <span class="ml-2 text-gray-600 text-sm">Sistema de Cemitério</span>
          </div>
          <div class="flex items-center space-x-4">
            <router-link to="/" class="text-gray-700 hover:text-blue-600">Home</router-link>
            <router-link to="/cemiterios" class="text-gray-700 hover:text-blue-600">Cemitérios</router-link>
            <router-link to="/quadras" class="text-gray-700 hover:text-blue-600">Quadras</router-link>
            <router-link to="/jazigos" class="text-gray-700 hover:text-blue-600">Jazigos</router-link>
            <router-link to="/sepultamentos" class="text-gray-700 hover:text-blue-600">Sepultamentos</router-link>
          </div>
        </div>
      </div>
    </nav>
    
    <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
      <router-view />
    </main>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style scoped>
</style>
