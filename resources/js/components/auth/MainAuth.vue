<template>
    <div class="login-section">

    <div class="container">

        <div class="logo-top">
            <img :src="'images/login-logo.png'" alt="">
        </div>
        <div class="login-page">
            <div class="login-info">
                <router-view></router-view>
            </div>
        </div>

    </div>

    <div class="footer">
        <div class="container">
            <div class="footer-description">
                <p class="uper">2022 © All rights reserved by Zilla's Top Swap
                </p>
                <p class="lower">Designed and Developed by <a href=" http://www.leadconcept.com " target="_blank">LEADconcept</a></p>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name:'MainAuth'
}
</script>