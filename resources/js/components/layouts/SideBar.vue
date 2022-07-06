<template>
 
            <nav
              class="sb-sidenav accordion sidebar--gradient"
              id="sidenavAccordion"
            >
              <div class="sb-sidenav-menu">
                <div class="nav">
                  <div class="text-center mr-top-2">
                    <img
                      class="dashboard-icon-border"
                      :src="'assets/images/dashboard-profile.png'"
                      alt=""
                    />
                    <p class="heading-wrapper--one">Scarlett Johansson</p>
                    <p class="label__wrapper--one">Steven tailr</p>
                  </div>
                  

                  <router-link class="nav-link"  to="/dashboard"><div  class="sb-nav-link-icon ">
                      <i class="fa fa-tachometer-alt" aria-hidden="true"></i>
                    </div> 
                    Dashboard
                    </router-link>
                  <router-link class="nav-link"  to="/users"><div  class="sb-nav-link-icon ">
                      <i class="fa fa-user" aria-hidden="true"></i>
                    </div> 
                    Users
                  </router-link>
                  <router-link class="nav-link"  to="/roles"><div  class="sb-nav-link-icon ">
                      <i class="fa fa-user" aria-hidden="true"></i>
                    </div> 
                    Roles
                  </router-link>  
                  <router-link class="nav-link"  to="/match-request"><div  class="sb-nav-link-icon ">
                      <i class="fa fa-search" aria-hidden="true"></i>
                    </div> 
                    Getting Match
                  </router-link>
                  
                  
                  <router-link class="nav-link"  to="/trade-setting"><div  class="sb-nav-link-icon ">
                      <i class="fa fa-tachometer-alt" aria-hidden="true"></i>
                    </div> 
                    Trade Setting
                  </router-link>
                  <!-- <router-link class="nav-link"  to="/trade-in-process"><div  class="sb-nav-link-icon ">
                      <i class="fa fa-tachometer-alt" aria-hidden="true"></i>
                    </div> 
                    Trade In Process
                    </router-link> -->


                  <router-link class="nav-link"  to="/account-setting"><div  class="sb-nav-link-icon ">
                      <i class="fa fa-tachometer-alt" aria-hidden="true"></i>
                    </div> 
                    Account Setting
                    </router-link>

                  <router-link class="nav-link"  to="/add-funds"><div  class="sb-nav-link-icon ">
                      <i class="fa fa-tachometer-alt" aria-hidden="true"></i>
                    </div> 
                    Add Funds
                    </router-link>
                  
                  <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon">
                      <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    Contact us
                  </a>
                 
                 
                </div>
              </div>
            </nav>
         
</template>
<script>
export default {
    name:'SideBar'
}
</script>