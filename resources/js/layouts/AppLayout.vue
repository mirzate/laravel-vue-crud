<template>
  <component :is="layout">
    <slot/>
  </component>
</template>

<script>

const DefaultLayout = 'DefaultLayout'
import { defineAsyncComponent } from 'vue'
export default {
  name: "AppLayout",
  computed: {
   layout() {
      const layout = this.$route.meta.layout || DefaultLayout
       const CommonLayout = defineAsyncComponent(() => import(`../layouts/${layout}.vue`))
        return CommonLayout;
    }
  }
}
</script>