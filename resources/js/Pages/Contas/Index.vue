<template>
  <Head title="Contas" />
  
  <div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="mb-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-white">Contas</h1>
            <p class="mt-2 text-gray-300">Gerencie suas contas a pagar e receber</p>
          </div>
          <Link :href="route('contas.create')" class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-4 py-2 rounded-lg transition-all duration-200 shadow-lg hover:shadow-orange-500/25">
            Nova Conta
          </Link>
        </div>
      </div>

      <!-- Filtros -->
      <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl border border-orange-500/10 p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Status</label>
            <select class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
              <option value="">Todos</option>
              <option value="pendente">Pendente</option>
              <option value="pago">Pago</option>
              <option value="atrasado">Atrasado</option>
              <option value="cancelado">Cancelado</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Tipo</label>
            <select class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
              <option value="">Todos</option>
              <option value="receber">A Receber</option>
              <option value="pagar">A Pagar</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Data Início</label>
            <input type="date" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Data Fim</label>
            <input type="date" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
          </div>
        </div>
      </div>

      <!-- Tabela -->
      <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl border border-orange-500/10 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-700/50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Cliente</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Valor</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tipo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Vencimento</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
              <tr v-if="!contas.data || contas.data.length === 0">
                <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                  <div class="flex flex-col items-center">
                    <svg class="h-12 w-12 text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-lg font-medium">Nenhuma conta encontrada</p>
                    <p class="text-sm mt-1">Comece criando sua primeira conta</p>
                    <Link :href="route('contas.create')" class="mt-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-4 py-2 rounded-lg transition-all duration-200">
                      Criar primeira conta
                    </Link>
                  </div>
                </td>
              </tr>
              <tr v-for="conta in contas.data" :key="conta.id" class="hover:bg-gray-700/30 transition-colors duration-200">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-white">{{ conta.cliente?.nome }}</div>
                  <div v-if="conta.cliente?.razao_social" class="text-sm text-gray-400">{{ conta.cliente.razao_social }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-white">{{ formatCurrency(conta.valor) }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="getTipoClass(conta.tipo_movimentacao)" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium">
                    {{ getTipoLabel(conta.tipo_movimentacao) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="getStatusClass(conta.status)" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium">
                    {{ getStatusLabel(conta.status) }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                  {{ formatDate(conta.data_vencimento) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                  <Link :href="route('contas.show', conta.id)" class="text-blue-400 hover:text-blue-300">Ver</Link>
                  <Link :href="route('contas.edit', conta.id)" class="text-orange-400 hover:text-orange-300">Editar</Link>
                  <button @click="deleteConta(conta.id)" class="text-red-400 hover:text-red-300">Excluir</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Paginação -->
        <div v-if="contas.links && contas.links.length > 0" class="bg-gray-700/30 px-6 py-3 border-t border-gray-700">
          <div class="flex items-center justify-between">
            <div class="text-sm text-gray-300">
              Mostrando {{ contas.from }} a {{ contas.to }} de {{ contas.total }} resultados
            </div>
            <div class="flex space-x-1">
              <template v-for="link in contas.links" :key="link.label">
                <Link 
                  v-if="link.url"
                  :href="link.url"
                  v-html="link.label"
                  :class="[
                    'px-3 py-2 text-sm rounded-md transition-colors duration-200',
                    link.active 
                      ? 'bg-orange-500 text-white' 
                      : 'text-gray-300 hover:text-white hover:bg-gray-600'
                  ]"
                />
                <span 
                  v-else
                  v-html="link.label"
                  class="px-3 py-2 text-sm rounded-md text-gray-500 cursor-not-allowed"
                />
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3'

const props = defineProps({
  contas: {
    type: Object,
    default: () => ({
      data: [],
      links: [],
      from: 0,
      to: 0,
      total: 0
    })
  }
})

const formatCurrency = (value) => {
  return new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  }).format(value)
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('pt-BR')
}

const getTipoLabel = (tipo) => {
  return tipo === 'receber' ? 'A Receber' : 'A Pagar'
}

const getTipoClass = (tipo) => {
  return tipo === 'receber' 
    ? 'bg-green-100 text-green-800' 
    : 'bg-red-100 text-red-800'
}

const getStatusLabel = (status) => {
  const labels = {
    'pendente': 'Pendente',
    'pago': 'Pago',
    'atrasado': 'Atrasado',
    'cancelado': 'Cancelado'
  }
  return labels[status] || status
}

const getStatusClass = (status) => {
  const classes = {
    'pendente': 'bg-yellow-100 text-yellow-800',
    'pago': 'bg-green-100 text-green-800',
    'atrasado': 'bg-red-100 text-red-800',
    'cancelado': 'bg-gray-100 text-gray-800'
  }
  return classes[status] || 'bg-gray-100 text-gray-800'
}

const deleteConta = (id) => {
  if (confirm('Tem certeza que deseja excluir esta conta?')) {
    router.delete(route('contas.destroy', id))
  }
}
</script>