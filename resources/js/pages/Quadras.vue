<template>
  <div>
    <h1 class="text-3xl font-bold mb-6">Quadras</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="p-6">
        <button 
          @click="showForm = !showForm"
          class="mb-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
        >
          {{ showForm ? 'Cancelar' : '+ Nova Quadra' }}
        </button>

        <!-- Formulário -->
        <div v-if="showForm" class="mb-6 p-4 bg-gray-50 rounded">
          <form @submit.prevent="salvarQuadra">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Cemitério</label>
                <select v-model="form.cemiterio_id" class="w-full px-3 py-2 border rounded" required>
                  <option value="">Selecione um cemitério</option>
                  <option v-for="c in cemiterios" :key="c.id" :value="c.id">{{ c.nome }}</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Nome</label>
                <input v-model="form.nome" type="text" class="w-full px-3 py-2 border rounded" required>
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Descrição</label>
                <textarea v-model="form.descricao" class="w-full px-3 py-2 border rounded"></textarea>
              </div>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
              Salvar
            </button>
          </form>
          <div v-if="erro" class="mt-2 text-red-600">{{ erro }}</div>
        </div>

        <!-- Tabela -->
        <div v-if="quadras.length > 0" class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Nome</th>
                <th class="px-4 py-2 text-left">Cemitério</th>
                <th class="px-4 py-2 text-left">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="quadra in quadras" :key="quadra.id" class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ quadra.id }}</td>
                <td class="px-4 py-2">{{ quadra.nome }}</td>
                <td class="px-4 py-2">{{ quadra.cemiterio?.nome }}</td>
                <td class="px-4 py-2">
                  <button 
                    @click="deletarQuadra(quadra.id)"
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
          Nenhuma quadra cadastrada
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Quadras',
  data() {
    return {
      quadras: [],
      cemiterios: [],
      showForm: false,
      form: {
        cemiterio_id: '',
        nome: '',
        descricao: ''
      },
      erro: ''
    }
  },
  mounted() {
    this.carregarCemiterios();
    this.carregarQuadras();
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
    async carregarQuadras() {
      try {
        const response = await axios.get('http://localhost:8000/api/quadras');
        this.quadras = response.data;
      } catch (error) {
        console.error('Erro ao carregar quadras:', error);
      }
    },
    async salvarQuadra() {
      try {
        this.erro = '';
        await axios.post('http://localhost:8000/api/quadras', this.form);
        this.form = { cemiterio_id: '', nome: '', descricao: '' };
        this.showForm = false;
        this.carregarQuadras();
      } catch (error) {
        if (error.response?.data?.message) {
          this.erro = error.response.data.message;
        } else {
          this.erro = 'Erro ao salvar quadra';
        }
        console.error('Erro:', error);
      }
    },
    async deletarQuadra(id) {
      if (confirm('Tem certeza?')) {
        try {
          await axios.delete(`http://localhost:8000/api/quadras/${id}`);
          this.carregarQuadras();
        } catch (error) {
          console.error('Erro ao deletar:', error);
        }
      }
    }
  }
}
</script>
