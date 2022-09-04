<template>
    <input
      :value="modelValue"
      @change="$emit('update:modelValue', $event.target.value)"
      type="text"
      class="appearance-none block w-full px-4 py-3 border border-solid 
      border-gray-n1 rounded-xl placeholder-gray-n1 focus:outline-none focus:ring-black 
      focus:border-black sm:text-sm"/>
</template>

<script>

export default {
  props: ['modelValue']
}

</script>
