<template>
  <div>
    <div class="m-b-md">
        <h4 class="m-t-sm m-l-xs">
            Forge Sites
        </h4>
    </div>

    <div class="row">
      <div class="col-sm-12 m-l-xs" v-if="!loaded && !sites.length">
        <p>Loading...</p>
      </div>

      <div class="col-sm-12 m-l-xs" v-else-if="!sites.length">
        There are no sites linked to this project.
      </div>

      <div class="forge-site col-sm-12 col-md-6 m-b-md" v-for="site in sites" v-else>
          <div class="forge-site__inner">
              <h5 class="forge-site__heading">
                  <a target="_blank" :href="`https://${ site.name }`">
                      {{ site.name }}
                  </a>
              </h5>

              <div class="forge-site__content">
                  <ul class="no-bullet">
                      <li><strong>Repository:</strong> {{ site.repository }}</li>
                      <li><strong>Branch:</strong> {{ site.repositoryBranch }}</li>
                      <li><strong>Quick deploy:</strong> <i class="fa" :class="{ 'fa-check': site.quickDeploy, 'fa-remove': !site.quickDeploy }"></i></li>
                      <li><strong>Last deployment:</strong> {{ site.lastDeployment }}</li>
                  </ul>
                  <div class="forge-site__options">
                      <a class="btn btn-sm btn-primary" :href="`/forge-links/${ site.internalId }/deploy`">
                          Deploy
                      </a>
                      <div>
                          <a class="btn btn-sm btn-primary" :href="`/forge-links/${ site.internalId }/log`" title="View deployment log">
                              <i class="fa fa-file-text-o"></i>
                          </a>
                          <a class="btn btn-sm btn-primary disabled" :href="`/forge-links/${ site.internalId }/edit`" title="Coming soon">
                              <i class="fa fa-pencil"></i>
                          </a>
                          <a class="btn btn-sm btn-primary" :href="`/forge-links/${ site.internalId }/unlink`" title="Remove from project">
                              <i class="fa fa-chain-broken"></i>
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      pageId: {
        required: true,
      },
    },

    data() {
      return {
        sites: {},
        loaded: false,
      }
    },

    mounted() {
      this.$root.$on('tab-changed', e => {
        if (!this.loaded && e.tab.name === '<i class="fa fa-forge"></i>') {
          this.loadSites();
        }
      });
    },

    methods: {
      loadSites() {
        console.log('sra')
        axios.get(`/ajax/pages/${ this.pageId }/forge-sites`)
          .then(response => this.sites = response.data)
          .then(() => this.loaded = true);
      },
    },
  }
</script>
