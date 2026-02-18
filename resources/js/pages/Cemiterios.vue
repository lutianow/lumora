<template>
  <div>
    <h1 class="text-3xl font-bold mb-6">Cemitérios</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="p-6">
        <button 
          @click="showForm = !showForm"
          class="mb-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
        >
          {{ showForm ? 'Cancelar' : '+ Novo Cemitério' }}
        </button>

        <!-- Formulário -->
        <div v-if="showForm" class="mb-6 p-4 bg-gray-50 rounded">
          <form @submit.prevent="salvarCemiterio">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Nome</label>
                <input v-model="form.nome" type="text" class="w-full px-3 py-2 border rounded" required>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Cidade</label>
                <input v-model="form.cidade" type="text" class="w-full px-3 py-2 border rounded" required>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Estado</label>
                <input v-model="form.estado" type="text" class="w-full px-3 py-2 border rounded" placeholder="SP" required>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">CEP</label>
                <input v-model="form.cep" type="text" class="w-full px-3 py-2 border rounded" placeholder="01310-100" required>
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Endereço</label>
                <input v-model="form.endereco" type="text" class="w-full px-3 py-2 border rounded" required>
              </div>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
              Salvar
            </button>
          </form>
          <div v-if="erro" class="mt-2 text-red-600">{{ erro }}</div>
        </div>

        <!-- Tabela -->
        <div v-if="cemiterios.length > 0" class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Nome</th>
                <th class="px-4 py-2 text-left">Cidade</th>
                <th class="px-4 py-2 text-left">Estado</th>
                <th class="px-4 py-2 text-left">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="cemiterio in cemiterios" :key="cemiterio.id" class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ cemiterio.id }}</td>
                <td class="px-4 py-2">{{ cemiterio.nome }}</td>
                <td class="px-4 py-2">{{ cemiterio.cidade }}</td>
                <td class="px-4 py-2">{{ cemiterio.estado }}</td>
                <td class="px-4 py-2">
                  <button 
                    @click="deletarCemiterio(cemiterio.id)"
                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm"
                  >
                    Deletar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-else class="text-gray-500 text-center py-4">
          Nenhum cemitério cadastrado
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Cemiterios',
  data() {
    return {
      cemiterios: [],
      showForm: false,
      form: {
        nome: '',
        endereco: '',
        cidade: '',
        estado: '',
        cep: ''
      },
      erro: ''
    }
  },
  mounted() {
    this.carregarCemiterios();
  },
  methods: {
    async carregarCemiterios() {
      try {
        const response = await axios.get('http://localhost:8000/api/cemiterios');
        this.cemiterios = response.data;
      } catch (error) {
        console.error('Erro ao carregar cemitérios:', error);
      }
    },
    async salvarCemiterio() {
      try {
        this.erro = '';
        await axios.post('http://localhost:8000/api/cemiterios', this.form);
        this.form = { nome: '', endereco: '', cidade: '', estado: '', cep: '' };
        this.showForm = false;
        this.carregarCemiterios();
      } catch (error) {
        if (error.response?.data?.message) {
          this.erro = error.response.data.message;
        } else {
          this.erro = 'Erro ao salvar cemitério';
        }
        console.error('Erro:', error);
      }
    },
    async deletarCemiterio(id) {
      if (confirm('Tem certeza?')) {
        try {
          await axios.delete(`http://localhost:8000/api/cemiterios/${id}`);
          this.carregarCemiterios();
        } catch (error) {
          console.error('Erro ao deletar:', error);
        }
      }
    }
  }
}
</script>
