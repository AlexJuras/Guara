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
                Guara Corps
              </h1>
            </div>
          </div>

          <!-- Navigation -->
          <nav class="hidden md:flex space-x-8">
            <a href="#" class="text-gray-300 hover:text-orange-400 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
              Dashboard
            </a>
            <a href="#" class="text-gray-300 hover:text-orange-400 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
              Receita
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
            <a href="#" class="block text-gray-300 hover:text-orange-400 px-3 py-2 text-base font-medium">Receita</a>
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
                  <a href="#" class="group flex items-center px-3 py-2 text-sm font-bold text-gray-300 rounded-lg hover:bg-orange-500/10 hover:text-orange-400 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="h-7 w-7 group-hover:text-orange-400" fill="currentColor">
                      <path d="M240-200h120v-200q0-17 11.5-28.5T400-440h160q17 0 28.5 11.5T600-400v200h120v-360L480-740 240-560v360Zm-80 0v-360q0-19 8.5-36t23.5-28l240-180q21-16 48-16t48 16l240 180q15 11 23.5 28t8.5 36v360q0 33-23.5 56.5T720-120H560q-17 0-28.5-11.5T520-160v-200h-80v200q0 17-11.5 28.5T400-120H240q-33 0-56.5-23.5T160-200Zm320-270Z"/>
                    </svg>
                    <p class="pl-2">INÍCIO</p>
                  </a>
                  <a href="#" class="group flex items-center px-3 py-2 text-sm font-bold text-gray-300 rounded-lg hover:bg-orange-500/10 hover:text-orange-400 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 -960 960 960" fill="currentColor">
                      <path d="M40-272q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v32q0 33-23.5 56.5T600-160H120q-33 0-56.5-23.5T40-240v-32Zm800 112H738q11-18 16.5-38.5T760-240v-40q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v40q0 33-23.5 56.5T840-160ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z"/>
                    </svg>
                    <p class="pl-2">CLIENTES</p>
                  </a>
                  <a href="#" class="group flex items-center px-3 py-2 text-sm font-bold text-gray-300 rounded-lg hover:bg-orange-500/10 hover:text-orange-400 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="h-7 w-7 group-hover:text-orange-400" fill="currentColor">
                      <path d="M440-200h80v-40h40q17 0 28.5-11.5T600-280v-120q0-17-11.5-28.5T560-440H440v-40h160v-80h-80v-40h-80v40h-40q-17 0-28.5 11.5T360-520v120q0 17 11.5 28.5T400-360h120v40H360v80h80v40ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-560v-160H240v640h480v-480H520ZM240-800v160-160 640-640Z"/>
                    </svg>
                    <p class="pl-2">RECEITA</p>
                  </a>
                  <a href="#" class="group flex items-center px-3 py-2 text-sm font-bold text-gray-300 rounded-lg hover:bg-orange-500/10 hover:text-orange-400 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 -960 960 960" fill="currentColor">
                      <path d="M480-520q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM200-400q-33 0-56.5-23.5T120-480v-320q0-33 23.5-56.5T200-880h560q33 0 56.5 23.5T840-800v320q0 33-23.5 56.5T760-400H200Zm80-80h400q0-33 23.5-56.5T760-560v-160q-33 0-56.5-23.5T680-800H280q0 33-23.5 56.5T200-720v160q33 0 56.5 23.5T280-480Zm-80 0v-320 320Zm240 248-36-36q-11-11-28-11t-28 11q-11 11-11 28t11 28l104 104q6 6 13 8.5t15 2.5q8 0 15-2.5t13-8.5l104-104q11-11 11-28t-11-28q-11-11-28-11t-28 11l-36 36v-88q0-17-11.5-28.5T480-360q-17 0-28.5 11.5T440-320v88Z"/>
                    </svg>
                    <p class="pl-2">CONTAS</p>
                  </a>
                  <a href="#" class="group flex items-center px-3 py-2 text-sm font-bold text-gray-300 rounded-lg hover:bg-orange-500/10 hover:text-orange-400 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 -960 960 960" fill="currentColor">
                      <path d="M200-120q-33 0-56.5-23.5T120-200v-600q0-17 11.5-28.5T160-840q17 0 28.5 11.5T200-800v600h600q17 0 28.5 11.5T840-160q0 17-11.5 28.5T800-120H200Zm80-120q-17 0-28.5-11.5T240-280v-280q0-17 11.5-28.5T280-600h80q17 0 28.5 11.5T400-560v280q0 17-11.5 28.5T360-240h-80Zm200 0q-17 0-28.5-11.5T440-280v-480q0-17 11.5-28.5T480-800h80q17 0 28.5 11.5T600-760v480q0 17-11.5 28.5T560-240h-80Zm200 0q-17 0-28.5-11.5T640-280v-120q0-17 11.5-28.5T680-440h80q17 0 28.5 11.5T800-400v120q0 17-11.5 28.5T760-240h-80Z"/>
                    </svg>
                    <p class="pl-2">RELATÓRIOS</p>
                  </a>
                  <a href="#" class="group flex items-center px-3 py-2 text-sm font-bold text-gray-300 rounded-lg hover:bg-orange-500/10 hover:text-orange-400 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 -960 960 960" fill="currentColor">
                      <path d="M480-120q-126 0-223-76.5T131-392q-4-15 6-27.5t27-14.5q16-2 29 6t18 24q24 90 99 147t170 57q117 0 198.5-81.5T760-480q0-117-81.5-198.5T480-760q-69 0-129 32t-101 88h70q17 0 28.5 11.5T360-600q0 17-11.5 28.5T320-560H160q-17 0-28.5-11.5T120-600v-160q0-17 11.5-28.5T160-800q17 0 28.5 11.5T200-760v54q51-64 124.5-99T480-840q75 0 140.5 28.5t114 77q48.5 48.5 77 114T840-480q0 75-28.5 140.5t-77 114q-48.5 48.5-114 77T480-120Zm40-376 100 100q11 11 11 28t-11 28q-11 11-28 11t-28-11L452-452q-6-6-9-13.5t-3-15.5v-159q0-17 11.5-28.5T480-680q17 0 28.5 11.5T520-640v144Z"/>
                    </svg>
                    <p class="pl-2">HISTÓRICO</p>
                  </a>
                </div>
              </div>

              <!-- <div class="mb-6">
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
              </div> -->
            </nav>

            <!-- Sidebar Footer -->
            <div class="mt-8 p-4 bg-gradient-to-r from-orange-500/10 to-orange-600/10 rounded-lg border border-orange-500/20">
              <h4 class="text-orange-400 text-sm font-medium mb-2">Dica do dia</h4>
              <p class="text-gray-300 text-xs leading-relaxed">
                Não esqueça de bater o ponto
              </p>
            </div>
          </div>
        </div>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 min-h-screen">
        <div class="py-6 px-4 sm:px-6 lg:px-8">
          <!-- Page Header -->
          <!-- <div class="mb-8">
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-6 border border-orange-500/10">
              <h2 class="text-3xl font-bold text-white mb-2">
                Bem-vindo ao Guara
              </h2>
              <p class="text-gray-300">
                Gerencie seus projetos de forma eficiente e organizada.
              </p>
            </div>
          </div> -->

          <!-- Content Area -->
          <div class="space-y-6">
            <!-- Stats Grid -->
            <!-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
            </div> -->

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
