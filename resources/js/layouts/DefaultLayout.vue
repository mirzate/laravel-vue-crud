<template>
  <div class="tw-flex tw-flex-col tw-flex-grow">
    <Navbar />
    <slot />
  </div>
</template>

<script>
import Navbar from '../components/NavigationBar.vue'

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>
