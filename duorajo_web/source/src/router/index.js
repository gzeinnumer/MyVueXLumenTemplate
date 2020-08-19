import Vue from 'vue'
import Router from 'vue-router'

import dashboard from '../views/dashboard'

import error404 from '../views/sample-pages/error-404'
import error500 from '../views/sample-pages/error-500'
import login from '../views/sample-pages/login'
import register from '../views/sample-pages/register'

import service from '../views/service/service'

import brandMobil from '../views/brand-mobil/brand-mobil'
import typeMobil from '../views/type-mobil/type-mobil'
import sparePart from '../views/spare-part/spare-part'

import daftarPelanggan from '../views/daftar-pelanggan/daftar-pelanggan'
import calender from '../views/calender/calender'

import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(Router)

Vue.use(VueAxios, axios)

Vue.config.productionTip = false

export default new Router({
  linkActiveClass: 'active',
  routes: [
    {
      path: '/',
      name: 'login',
      component: login
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: dashboard
    },
    {
      path: '/service',
      name: 'service',
      component: service
    },
    {
      path: '/brand_mobil',
      name: 'brandMobil',
      component: brandMobil
    },
    {
      path: '/type_mobil',
      name: 'typeMobil',
      component: typeMobil
    },
    {
      path: '/spare_part',
      name: 'sparePart',
      component: sparePart
    },
    {
      path: '/daftar_pelanggan',
      name: 'daftarPelanggan',
      component: daftarPelanggan
    },
    {
      path: '/calender',
      name: 'calender',
      component: calender
    },
    {
      path: '/404',
      name: 'error-404',
      component: error404
    },
    {
      path: '/500',
      name: 'error-500',
      component: error500
    },
    {
      path: '/register',
      name: 'register',
      component: register
    }
  ]
})
