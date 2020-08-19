<template lang="html">
  <div id="app" style="background-color:#F6F8FA;">
    <div v-if="showMenu" class="container-scroller">
      <app-header/>
      <div class="container-fluid page-body-wrapper">
        <app-sidebar/>
        <div class="main-panel">
          <div class="content-wrapper">
            <router-view></router-view>
          </div>
          <app-footer/>
        </div>
      </div>
    </div>
    <div v-else class="container">
      <b-navbar class="fixed-top" toggleable="md" type="dark" variant="info">
        <div class="navbar-menu-wrapper d-flex align-items-center ml-auto ml-lg-0">
        </div>
      </b-navbar>
      <div class="container-fluid page-body-wrapper">
        <div class="content-wrapper">
          <div class="content-wrapper">
            <router-view></router-view>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="js">
import AppHeader from '../src/components/partials/AppHeader'
import AppSidebar from '../src/components/partials/AppSidebar'
import AppFooter from '../src/components/partials/AppFooter'
export default{
  name: 'app',
  components: {
    AppHeader,
    AppSidebar,
    AppFooter
  },
  computed: {
    showMenu () {
      return this.$route.name !== 'login' && this.$route.name !== 'register'
    }
  }
}
</script>

<style>
  @import "../node_modules/mdi/css/materialdesignicons.min.css";
  @import "../node_modules/flag-icon-css/css/flag-icon.min.css";
  @import "../node_modules/font-awesome/css/font-awesome.min.css";
</style>

<style lang="scss">
@import "./assets/scss/style";
</style>
