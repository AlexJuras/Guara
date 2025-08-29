<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-800">
    <!-- Header -->
    <header class="bg-black shadow-2xl border-b border-orange-500/20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">
                Guara
              </h1>
            </div>
          </div>

          <!-- Navigation -->
          <nav class="hidden md:flex space-x-8">
            <a href="#" class="text-gray-300 hover:text-orange-400 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
              Dashboard
            </a>
            <a href="#" class="text-gray-300 hover:text-orange-400 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
              Projetos
            </a>
            <a href="#" class="text-gray-300 hover:text-orange-400 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
              Equipe
            </a>
            <a href="#" class="text-gray-300 hover:text-orange-400 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
              Configurações
            </a>
          </nav>

          <!-- User Menu -->
          <div class="flex items-center space-x-4">
            <button class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 shadow-lg hover:shadow-orange-500/25">
              Novo Projeto
            </button>
            <div class="relative">
              <button class="flex items-center text-gray-300 hover:text-orange-400 transition-colors duration-200">
                <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                  <span class="text-white text-sm font-medium">U</span>
                </div>
              </button>
            </div>
          </div>

          <!-- Mobile menu button -->
          <div class="md:hidden">
            <button @click="toggleMobileMenu" class="text-gray-300 hover:text-orange-400 p-2">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Mobile Navigation -->
        <div v-show="mobileMenuOpen" class="md:hidden border-t border-orange-500/20 pt-4 pb-3">
          <div class="space-y-1">
            <a href="#" class="block text-gray-300 hover:text-orange-400 px-3 py-2 text-base font-medium">Dashboard</a>
            <a href="#" class="block text-gray-300 hover:text-orange-400 px-3 py-2 text-base font-medium">Projetos</a>
            <a href="#" class="block text-gray-300 hover:text-orange-400 px-3 py-2 text-base font-medium">Equipe</a>
            <a href="#" class="block text-gray-300 hover:text-orange-400 px-3 py-2 text-base font-medium">Configurações</a>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content Area -->
    <div class="flex">
      <!-- Sidebar -->
      <aside class="hidden lg:flex lg:flex-shrink-0">
        <div class="w-64 bg-gray-900/50 backdrop-blur-sm border-r border-orange-500/10 h-screen sticky top-0">
          <div class="p-6">
            <nav class="space-y-2">
              <div class="mb-6">
                <h3 class="text-orange-400 text-xs font-semibold uppercase tracking-wider mb-3">
                  Menu Principal
                </h3>
                <div class="space-y-1">
                  <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-300 rounded-lg hover:bg-orange-500/10 hover:text-orange-400 transition-all duration-200">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                    </svg>
                    Dashboard
                  </a>
                  <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-300 rounded-lg hover:bg-orange-500/10 hover:text-orange-400 transition-all duration-200">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Projetos
                  </a>
                  <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-300 rounded-lg hover:bg-orange-500/10 hover:text-orange-400 transition-all duration-200">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Equipe
                  </a>
                </div>
              </div>

              <div class="mb-6">
                <h3 class="text-orange-400 text-xs font-semibold uppercase tracking-wider mb-3">
                  Ferramentas
                </h3>
                <div class="space-y-1">
                  <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-300 rounded-lg hover:bg-orange-500/10 hover:text-orange-400 transition-all duration-200">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Analytics
                  </a>
                  <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-300 rounded-lg hover:bg-orange-500/10 hover:text-orange-400 transition-all duration-200">
                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Configurações
                  </a>
                </div>
              </div>
            </nav>

            <!-- Sidebar Footer -->
            <div class="mt-8 p-4 bg-gradient-to-r from-orange-500/10 to-orange-600/10 rounded-lg border border-orange-500/20">
              <h4 class="text-orange-400 text-sm font-medium mb-2">Dica do dia</h4>
              <p class="text-gray-300 text-xs leading-relaxed">
                Use atalhos do teclado para navegar mais rapidamente pela plataforma.
              </p>
            </div>
          </div>
        </div>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 min-h-screen">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
          <!-- Page Header -->
          <div class="mb-8">
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-6 border border-orange-500/10">
              <h2 class="text-3xl font-bold text-white mb-2">
                Bem-vindo ao Guara
              </h2>
              <p class="text-gray-300">
                Gerencie seus projetos de forma eficiente e organizada.
              </p>
            </div>
          </div>

          <!-- Content Area -->
          <div class="space-y-6">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
              <div class="bg-gray-800/50 backdrop-blur-sm p-6 rounded-xl border border-orange-500/10 hover:border-orange-500/30 transition-all duration-200">
                <div class="flex items-center">
                  <div class="p-3 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                  </div>
                  <div class="ml-4">
                    <p class="text-sm font-medium text-gray-300">Projetos Ativos</p>
                    <p class="text-2xl font-bold text-white">12</p>
                  </div>
                </div>
              </div>

              <div class="bg-gray-800/50 backdrop-blur-sm p-6 rounded-xl border border-orange-500/10 hover:border-orange-500/30 transition-all duration-200">
                <div class="flex items-center">
                  <div class="p-3 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                  </div>
                  <div class="ml-4">
                    <p class="text-sm font-medium text-gray-300">Membros da Equipe</p>
                    <p class="text-2xl font-bold text-white">8</p>
                  </div>
                </div>
              </div>

              <div class="bg-gray-800/50 backdrop-blur-sm p-6 rounded-xl border border-orange-500/10 hover:border-orange-500/30 transition-all duration-200">
                <div class="flex items-center">
                  <div class="p-3 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                  </div>
                  <div class="ml-4">
                    <p class="text-sm font-medium text-gray-300">Tarefas Concluídas</p>
                    <p class="text-2xl font-bold text-white">245</p>
                  </div>
                </div>
              </div>

              <div class="bg-gray-800/50 backdrop-blur-sm p-6 rounded-xl border border-orange-500/10 hover:border-orange-500/30 transition-all duration-200">
                <div class="flex items-center">
                  <div class="p-3 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                  </div>
                  <div class="ml-4">
                    <p class="text-sm font-medium text-gray-300">Produtividade</p>
                    <p class="text-2xl font-bold text-white">+15%</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Main Content Slot -->
            <div class="bg-gray-800/30 backdrop-blur-sm rounded-xl border border-orange-500/10 min-h-96">
              <div class="p-6">
                <slot />
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

    <!-- Footer -->
    <footer class="bg-black border-t border-orange-500/20 mt-12">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
          <div class="text-gray-400 text-sm">
            © 2025 Guara. Todos os direitos reservados.
          </div>
          <div class="flex space-x-6">
            <a href="#" class="text-gray-400 hover:text-orange-400 text-sm transition-colors duration-200">
              Privacidade
            </a>
            <a href="#" class="text-gray-400 hover:text-orange-400 text-sm transition-colors duration-200">
              Termos
            </a>
            <a href="#" class="text-gray-400 hover:text-orange-400 text-sm transition-colors duration-200">
              Suporte
            </a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const mobileMenuOpen = ref(false)

const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value
}
</script>

<style scoped>
/* Adicione estilos customizados se necessário */
</style>
