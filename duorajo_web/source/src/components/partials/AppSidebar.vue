<template lang="html">

  <section class="app-sidebar">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item nav-profile">
          <div class="nav-link">
            <div class="profile-image"> <img src="../../assets/images/faces/gzeinnumer.png" alt="image"/> <span class="online-status online"></span> </div>
            <div class="profile-name">
              <p class="name">GZeinNumer</p>
              <p class="designation">Developers</p>
              <div class="badge badge-teal mx-auto mt-3">Online</div>
            </div>
          </div>
        </li>
        <li class="nav-item"><router-link class="nav-link" to="/"><img class="menu-icon" src="../../assets/images/menu_icons/01.png" alt="menu icon"><span class="menu-title">Dashboard</span></router-link></li>
        <li class="nav-item">
          <span class="nav-link" v-b-toggle="'transaksi'">
            <img class="menu-icon" src="../../assets/images/menu_icons/03.png" alt="menu icon"><span class="menu-title">Transaksi</span><i class="menu-arrow"></i>
          </span>
          <b-collapse id="transaksi">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><router-link class="nav-link" to="/service/">Service</router-link></li>
            </ul>
          </b-collapse>
        </li>
        <li class="nav-item">
          <span class="nav-link" v-b-toggle="'data_master'">
            <img class="menu-icon" src="../../assets/images/menu_icons/04.png" alt="menu icon"><span class="menu-title">Data Master</span><i class="menu-arrow"></i>
          </span>
          <b-collapse id="data_master">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><router-link class="nav-link" to="/brand_mobil/">Brand Mobil</router-link></li>
              <li class="nav-item"><router-link class="nav-link" to="/type_mobil/">Type Mobil</router-link></li>
              <li class="nav-item"><router-link class="nav-link" to="/spare_part/">Spare Part</router-link></li>
            </ul>
          </b-collapse>
        </li>
        <li class="nav-item">
          <span class="nav-link" v-b-toggle="'data_pelanggan'">
            <img class="menu-icon" src="../../assets/images/menu_icons/08.png" alt="menu icon"><span class="menu-title">Data Pelanggan</span><i class="menu-arrow"></i>
          </span>
          <b-collapse id="data_pelanggan">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><router-link class="nav-link" to="/daftar_pelanggan/">Daftar Pelanggan</router-link></li>
              <li class="nav-item"><router-link class="nav-link" to="/calender/">Calender</router-link></li>
            </ul>
          </b-collapse>
        </li>
      </ul>
    </nav>
  </section>

</template>

<script lang="js">
export default {
  name: 'app-sidebar'
}
</script>

<style scoped lang="scss">
.app-sidebar {

}
</style>
