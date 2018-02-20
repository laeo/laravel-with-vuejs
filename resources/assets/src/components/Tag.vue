<template>
  <div class="tag">
    <div class="tag-name">{{ name }}</div>
    <slot></slot>
  </div>
</template>

<script>
  export default {
    name: 'Tag',
    props: {
      name: { type: String, required: true }
    }
  }
</script>

<style type="less">
  .tag {
    border: 1px solid #009876;
  }

  .tag-name {
    line-height: 16px;
  }
</style>