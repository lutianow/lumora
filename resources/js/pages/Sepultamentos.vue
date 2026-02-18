<template>
  <div>
    <h1 class="text-3xl font-bold mb-6">Sepultamentos</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="p-6">
        <button 
          @click="showForm = !showForm"
          class="mb-4 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded"
        >
          {{ showForm ? 'Cancelar' : '+ Novo Sepultamento' }}
        </button>

        <!-- Formulário -->
        <div v-if="showForm" class="mb-6 p-4 bg-gray-50 rounded">
          <form @submit.prevent="salvarSepultamento">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Jazigo</label>
                <select v-model="form.jazigo_id" class="w-full px-3 py-2 border rounded" required>
                  <option value="">Selecione um jazigo</option>
                  <option v-for="j in jazigos" :key="j.id" :value="j.id">
                    {{ j.numero }} ({{ j.quadra?.nome }})
                  </option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Nome do Falecido</label>
                <input v-model="form.nome_falecido" type="text" class="w-full px-3 py-2 border rounded" required>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                <input v-model="form.data_nascimento" type="date" class="w-full px-3 py-2 border rounded">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Data de Falecimento</label>
                <input v-model="form.data_falecimento" type="date" class="w-full px-3 py-2 border rounded" required>
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Observações</label>
                <textarea v-model="form.observacoes" class="w-full px-3 py-2 border rounded"></textarea>
              </div>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
              Salvar
            </button>
          </form>
          <div v-if="erro" class="mt-2 text-red-600">{{ erro }}</div>
        </div>

        <!-- Tabela -->
        <div v-if="sepultamentos.length > 0" class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Nome</th>
                <th class="px-4 py-2 text-left">Jazigo</th>
                <th class="px-4 py-2 text-left">Data Falecimento</th>
                <th class="px-4 py-2 text-left">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="sep in sepultamentos" :key="sep.id" class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ sep.id }}</td>
                <td class="px-4 py-2">{{ sep.nome_falecido }}</td>
                <td class="px-4 py-2">{{ sep.jazigo?.numero }}</td>
                <td class="px-4 py-2">{{ formatarData(sep.data_falecimento) }}</td>
                <td class="px-4 py-2">
                  <button 
                    @click="deletarSepultamento(sep.id)"
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
          Nenhum sepultamento registrado
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Sepultamentos',
  data() {
    return {
      sepultamentos: [],
      jazigos: [],
      showForm: false,
      form: {
        jazigo_id: '',
        nome_falecido: '',
        data_nascimento: '',
        data_falecimento: '',
        observacoes: ''
      },
      erro: ''
    }
  },
  mounted() {
    this.carregarJazigos();
    this.carregarSepultamentos();
  },
  methods: {
    async carregarJazigos() {
      try {
        const response = await axios.get('http://localhost:8000/api/jazigos');
        this.jazigos = response.data;
      } catch (error) {
        console.error('Erro ao carregar jazigos:', error);
      }
    },
    async carregarSepultamentos() {
      try {
        const response = await axios.get('http://localhost:8000/api/sepultamentos');
        this.sepultamentos = response.data;
      } catch (error) {
        console.error('Erro ao carregar sepultamentos:', error);
      }
    },
    async salvarSepultamento() {
      try {
        this.erro = '';
        await axios.post('http://localhost:8000/api/sepultamentos', this.form);
        this.form = {
          jazigo_id: '',
          nome_falecido: '',
          data_nascimento: '',
          data_falecimento: '',
          observacoes: ''
        };
        this.showForm = false;
        this.carregarSepultamentos();
      } catch (error) {
        if (error.response?.data?.message) {
          this.erro = error.response.data.message;
        } else {
          this.erro = 'Erro ao salvar sepultamento';
        }
        console.error('Erro:', error);
      }
    },
    async deletarSepultamento(id) {
      if (confirm('Tem certeza?')) {
        try {
          await axios.delete(`http://localhost:8000/api/sepultamentos/${id}`);
          this.carregarSepultamentos();
        } catch (error) {
          console.error('Erro ao deletar:', error);
        }
      }
    },
    formatarData(data) {
      if (!data) return '-';
      return new Date(data).toLocaleDateString('pt-BR');
    }
  }
}
</script>
