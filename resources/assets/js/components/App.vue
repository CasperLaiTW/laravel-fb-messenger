<template>
  <div class="container mt-1">
    <div class="row">
      <div class="col-sm-4">
        <h4>Requests</h4>
        <table class="table table-hover table-sm">
          <thead>
          <tr>
            <th>Event</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(item, key) in reverseData">
            <td @click="ShowRequest(key)">{{ key }}</td>
          </tr>
          </tbody>
        </table>
      </div>
      <div class="col-sm-8">
        <panel ref="panel" v-bind:broadcast="current" v-if=""></panel>
      </div>
    </div>
  </div>
</template>
<script>
  import _ from 'lodash';
  import Echo from 'laravel-echo';
  import stringify from 'json-stringify';
  import Panel from './Panel.vue';

  export default {
    data() {
      return {
        echo: null,
        data: {},
        current: {},
      };
    },
    components: {
      Panel,
    },
    methods: {
      ShowRequest(key) {
        this.current = this.data[key];
        this.$refs.panel.clear();
      },
    },
    computed: {
      reverseData() {
        return _(this.data).toPairs().orderBy(0, 'desc').fromPairs().value();
      }
    },
    mounted() {
      const echo = new Echo(Object.assign({
        broadcaster: 'pusher',
        namespace: 'Casperlaitw.LaravelFbMessenger.Events',
      }, window.pusherConfig));

      echo.channel('laravel-fb-messenger')
      .listen('Broadcast', (e) => {
        const item = {
          request: [],
          response: [],
          status: [],
        };

        if (e.webhook !== null) {
          this.$set(this.data, e.id, Object.assign(item, {webhook: stringify(e.webhook, null, 2)}));
        }

        this.data[e.id].request.push(stringify(e.request, null, 2));
        this.data[e.id].response.push(stringify(e.response, null, 2));
        this.data[e.id].status.push(e.status);
      });
    }
  };
</script>
