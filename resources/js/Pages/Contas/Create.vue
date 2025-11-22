<template>
  <Head title="Nova Conta" />
  
  <div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="mb-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-white">Nova Conta</h1>
            <p class="mt-2 text-gray-300">Cadastre uma nova conta a receber ou pagar</p>
          </div>
          <Link :href="route('contas.index')" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
            Voltar
          </Link>
        </div>
      </div>

      <!-- Formulário -->
      <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl border border-orange-500/10 p-6">
        <form @submit.prevent="submit" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Cliente -->
            <div>
              <label for="cliente_id" class="block text-sm font-medium text-gray-300 mb-2">
                Cliente *
              </label>
              <select 
                id="cliente_id"
                v-model="form.cliente_id"
                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                required
              >
                <option value="">Selecione um cliente</option>
                <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
                  {{ cliente.nome }} {{ cliente.razao_social ? `(${cliente.razao_social})` : '' }}
                </option>
              </select>
              <div v-if="errors.cliente_id" class="text-red-400 text-sm mt-1">{{ errors.cliente_id }}</div>
            </div>

            <!-- Valor -->
            <div>
              <label for="valor" class="block text-sm font-medium text-gray-300 mb-2">
                Valor *
              </label>
              <input 
                id="valor"
                v-model="form.valor"
                type="number"
                step="0.01"
                min="0.01"
                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                placeholder="0,00"
                required
              />
              <div v-if="errors.valor" class="text-red-400 text-sm mt-1">{{ errors.valor }}</div>
            </div>

            <!-- Tipo de Movimentação -->
            <div>
              <label for="tipo_movimentacao" class="block text-sm font-medium text-gray-300 mb-2">
                Tipo de Movimentação *
              </label>
              <select 
                id="tipo_movimentacao"
                v-model="form.tipo_movimentacao"
                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                required
              >
                <option value="">Selecione</option>
                <option value="receber">Conta a Receber</option>
                <option value="pagar">Conta a Pagar</option>
              </select>
              <div v-if="errors.tipo_movimentacao" class="text-red-400 text-sm mt-1">{{ errors.tipo_movimentacao }}</div>
            </div>

            <!-- Tipo de Pagamento -->
            <div>
              <label for="tipo_pagamento" class="block text-sm font-medium text-gray-300 mb-2">
                Tipo de Pagamento
              </label>
              <select 
                id="tipo_pagamento"
                v-model="form.tipo_pagamento"
                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
              >
                <option value="">Selecione</option>
                <option value="pix">PIX</option>
                <option value="transferencia">Transferência</option>
                <option value="boleto">Boleto</option>
                <option value="cartao">Cartão</option>
                <option value="dinheiro">Dinheiro</option>
              </select>
              <div v-if="errors.tipo_pagamento" class="text-red-400 text-sm mt-1">{{ errors.tipo_pagamento }}</div>
            </div>

            <!-- Status -->
            <div>
              <label for="status" class="block text-sm font-medium text-gray-300 mb-2">
                Status *
              </label>
              <select 
                id="status"
                v-model="form.status"
                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                required
              >
                <option value="pendente">Pendente</option>
                <option value="pago">Pago</option>
                <option value="atrasado">Atrasado</option>
                <option value="cancelado">Cancelado</option>
              </select>
              <div v-if="errors.status" class="text-red-400 text-sm mt-1">{{ errors.status }}</div>
            </div>

            <!-- Data de Vencimento -->
            <div>
              <label for="data_vencimento" class="block text-sm font-medium text-gray-300 mb-2">
                Data de Vencimento *
              </label>
              <input 
                id="data_vencimento"
                v-model="form.data_vencimento"
                type="date"
                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                required
              />
              <div v-if="errors.data_vencimento" class="text-red-400 text-sm mt-1">{{ errors.data_vencimento }}</div>
            </div>

            <!-- Data de Pagamento -->
            <div v-if="form.status === 'pago'">
              <label for="data_pagamento" class="block text-sm font-medium text-gray-300 mb-2">
                Data de Pagamento
              </label>
              <input 
                id="data_pagamento"
                v-model="form.data_pagamento"
                type="date"
                class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
              />
              <div v-if="errors.data_pagamento" class="text-red-400 text-sm mt-1">{{ errors.data_pagamento }}</div>
            </div>
          </div>

          <!-- Descrição -->
          <div>
            <label for="descricao" class="block text-sm font-medium text-gray-300 mb-2">
              Descrição
            </label>
            <textarea 
              id="descricao"
              v-model="form.descricao"
              rows="3"
              class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
              placeholder="Descreva os detalhes da conta..."
            ></textarea>
            <div v-if="errors.descricao" class="text-red-400 text-sm mt-1">{{ errors.descricao }}</div>
          </div>

          <!-- Botões -->
          <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-700">
            <Link 
              :href="route('contas.index')" 
              class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition-colors duration-200"
            >
              Cancelar
            </Link>
            <button 
              type="submit" 
              :disabled="form.processing"
              class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-2 rounded-lg transition-all duration-200 shadow-lg hover:shadow-orange-500/25 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="form.processing">Salvando...</span>
              <span v-else>Salvar Conta</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
  clientes: Array,
  errors: Object
})

const form = useForm({
  cliente_id: '',
  valor: '',
  tipo_movimentacao: '',
  tipo_pagamento: '',
  status: 'pendente',
  data_vencimento: '',
  data_pagamento: '',
  descricao: ''
})

const submit = () => {
  form.post(route('contas.store'))
}
</script>