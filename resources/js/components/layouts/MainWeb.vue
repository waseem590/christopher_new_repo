<template>
<div class="custom__container-wrapper">
    <div class="dboard-inner">
        <Header />
        <div id="layoutSidenav">
          <div id="layoutSidenav_nav">
            <SideBar />
            
           </div>
            <div id="layoutSidenav_content">
          <router-view></router-view>
          <Footer />
 </div>
 </div>
 </div>
 </div>
</template>

<script>
import Header from './Header.vue'
import SideBar from './SideBar.vue'
import Footer from './Footer.vue'
import Dashboard from '../Web/Dashboard.vue'
export default {
    name:'MainWeb',
  components:{
     Header,
     SideBar,
     Dashboard,
     Footer
   }
}
</script>