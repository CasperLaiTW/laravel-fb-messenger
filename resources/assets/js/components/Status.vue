<template>
  <b-tags :variant="variant" type="pill">{{ status }}</b-badge>
</template>
<script>
  import BootstrapVue from 'bootstrap-vue';

  export default {
    props: {
      status: {
        type: String,
        required: true,
      },
    },
    computed: {
      variant() {
        return this.status === '200' ? 'success' : 'danger';
      },
    },
    components: {
      bTags: BootstrapVue.bTags,
    },
  };
</script>
