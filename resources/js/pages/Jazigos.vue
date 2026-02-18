<template>
  <div>
    <h1 class="text-3xl font-bold mb-6">Jazigos</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="p-6">
        <button 
          @click="showForm = !showForm"
          class="mb-4 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded"
        >
          {{ showForm ? 'Cancelar' : '+ Novo Jazigo' }}
        </button>

        <!-- Formulário -->
        <div v-if="showForm" class="mb-6 p-4 bg-gray-50 rounded">
          <form @submit.prevent="salvarJazigo">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Quadra</label>
                <select v-model="form.quadra_id" class="w-full px-3 py-2 border rounded" required>
                  <option value="">Selecione uma quadra</option>
                  <option v-for="q in quadras" :key="q.id" :value="q.id">{{ q.nome }}</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Número</label>
                <input v-model="form.numero" type="text" class="w-full px-3 py-2 border rounded" placeholder="A-001" required>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Tipo</label>
                <select v-model="form.tipo" class="w-full px-3 py-2 border rounded" required>
                  <option value="">Selecione um tipo</option>
                  <option value="simples">Simples</option>
                  <option value="duplo">Duplo</option>
                  <option value="triplo">Triplo</option>
                  <option value="cripta">Cripta</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Disponível</label>
                <select v-model.boolean="form.disponivel" class="w-full px-3 py-2 border rounded">
                  <option :value="true">Sim</option>
                  <option :value="false">Não</option>
                </select>
              </div>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
              Salvar
            </button>
          </form>
          <div v-if="erro" class="mt-2 text-red-600">{{ erro }}</div>
        </div>

        <!-- Tabela -->
        <div v-if="jazigos.length > 0" class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Número</th>
                <th class="px-4 py-2 text-left">Tipo</th>
                <th class="px-4 py-2 text-left">Quadra</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="jazigo in jazigos" :key="jazigo.id" class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ jazigo.id }}</td>
                <td class="px-4 py-2">{{ jazigo.numero }}</td>
                <td class="px-4 py-2">{{ jazigo.tipo }}</td>
                <td class="px-4 py-2">{{ jazigo.quadra?.nome }}</td>
                <td class="px-4 py-2">
                  <span :class="jazigo.disponivel ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" class="px-2 py-1 rounded text-sm">
                    {{ jazigo.disponivel ? 'Disponível' : 'Ocupado' }}
                  </span>
                </td>
                <td class="px-4 py-2">
                  <button 
                    @click="deletarJazigo(jazigo.id)"
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
          Nenhum jazigo cadastrado
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Jazigos',
  data() {
    return {
      jazigos: [],
      quadras: [],
      showForm: false,
      form: {
        quadra_id: '',
        numero: '',
        tipo: '',
        disponivel: true
      },
      erro: ''
    }
  },
  mounted() {
    this.carregarQuadras();
    this.carregarJazigos();
  },
  methods: {
    async carregarQuadras() {
      try {
        const response = await axios.get('http://localhost:8000/api/quadras');
        this.quadras = response.data;
      } catch (error) {
        console.error('Erro ao carregar quadras:', error);
      }
    },
    async carregarJazigos() {
      try {
        const response = await axios.get('http://localhost:8000/api/jazigos');
        this.jazigos = response.data;
      } catch (error) {
        console.error('Erro ao carregar jazigos:', error);
      }
    },
    async salvarJazigo() {
      try {
        this.erro = '';
        await axios.post('http://localhost:8000/api/jazigos', this.form);
        this.form = { quadra_id: '', numero: '', tipo: '', disponivel: true };
        this.showForm = false;
        this.carregarJazigos();
      } catch (error) {
        if (error.response?.data?.message) {
          this.erro = error.response.data.message;
        } else {
          this.erro = 'Erro ao salvar jazigo';
        }
        console.error('Erro:', error);
      }
    },
    async deletarJazigo(id) {
      if (confirm('Tem certeza?')) {
        try {
          await axios.delete(`http://localhost:8000/api/jazigos/${id}`);
          this.carregarJazigos();
        } catch (error) {
          console.error('Erro ao deletar:', error);
        }
      }
    }
  }
}
</script>
