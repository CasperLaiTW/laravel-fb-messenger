<template>
  <div>
    <b-nav type="pills" :vertical="false">
      <b-nav-item v-for="(item, key) in broadcast.request" :link="key.toString()" v-on:click="onClick">
        #{{ key }} <Status :status="broadcast.status[key].toString()"></Status>
      </b-nav-item>
    </b-nav>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            Webhook Request
          </div>
          <div class="card-block">
            <pre><code class="json">{{ broadcast.webhook }}</code></pre>
          </div>
        </div>
      </div>
      <div class="col-sm-12" v-show="current.status !== 500">
        <div class="card">
          <div class="card-header">
            Message Request
          </div>
          <div class="card-block">
            <pre><code class="json">{{ current.request }}</code></pre>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header" v-show="current.status === 500">
            Internal Server Error
          </div>
          <div class="card-header" v-show="current.status !== 500">
            Facebook Response
          </div>
          <div class="card-block">
            <pre><code class="json">{{ current.response }}</code></pre>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import BootstrapVue from 'bootstrap-vue';
  import Status from './Status.vue';

  export default {
    data() {
      return {
        current: {
          request: null,
          response: null,
          status: null,
        },
      };
    },
    props: {
      broadcast: {
        type: Object,
        required: true,
      },
    },
    components: {
      bNav: BootstrapVue.bNav,
      bNavItem: BootstrapVue.bNavItem,
      Status
    },
    methods: {
      onClick(id) {
        const key = parseInt(id);
        this.current = {
          request: this.broadcast.request[key],
          response: this.broadcast.response[key],
          status: this.broadcast.status[key],
        };
      },
      clear() {
        this.current = {
          request: null,
          response: null,
        };
      },
    },
  };
</script>
