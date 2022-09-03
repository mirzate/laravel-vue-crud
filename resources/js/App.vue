<template>
    <div id="app">
        <AppLayout>
            <router-view v-slot="{ Component }">
            <transition>
                <component :is="Component" />
            </transition>
            </router-view>
        </AppLayout>  
    </div>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
</style>

<script>

import AppLayout from './layouts/AppLayout.vue'

export default {
  name: 'App',
  components: {
    AppLayout,
  },
}

</script>
