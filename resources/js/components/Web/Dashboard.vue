<template>
    <main>
        <div class="container">
            <h1 class="mt-4 title-dashboard">Dashboard</h1>


            <div class="row">
                <div class="col-md-12 main-b">
                    <div class="row active-card">
                        <div class="col-xl-3 col-md-4 col-sm-4">
                            <div class="card card__one--wrapper text-white mb-4">
                                <div class="card-body">
                                    <div class="flex__wrapper-two">
                                        <div>
                                            <p class="card-label-one">Available Credit</p>
                                            <h3 class="card-heading-one">${{funds}}</h3>
                                        </div>
                                        <div>
                                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-4 col-sm-4">
                            <div class="card card__two--wrapper text-white mb-4">
                                <div class="card-body">
                                    <div class="flex__wrapper-two">
                                        <div>
                                            <p class="card-label-one">Active Offers</p>
                                            <h3 class="card-heading-one">$0.00</h3>
                                        </div>
                                        <div>
                                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="active-details">
                        <div class="active-title">
                            <h1>Active Offers</h1>
                        </div>

                        <div class="active-description">
                            <div v-if="offers.length === 0" class="active-info">
                                <p>You don't have active offer</p>
                            </div>
                            <div v-else class="acivity-details">
                            <template v-for="offer in offers" :key="offer.id">
                                
                                    <div class="activity-info">
                                        <div class="activity-shop">
                                            <div class="acivity-price">${{ offer.price }}</div>
                                        </div>
                                        <div class="activity-shop">
                                            <template v-for="(method, index) in offer.methods" :key="index">
                                                <div class="activity-date" v-if="method == 'apple_pay'">Apple Pay</div>
                                                <div class="activity-date" v-if="method == 'chime'">Chime</div>
                                                <div class="activity-date" v-if="method == 'paypal'">Paypal</div>
                                                <div class="activity-date" v-if="method == 'square_cash'">Square Cash</div>
                                                <div class="activity-date" v-if="method == 'venmo'">Venmo</div>
                                                <div class="activity-date" v-if="method == 'zelle'">Zelle</div>
                                            </template>
                                        </div>
                                        <div class="activity-shop">
                                            <div class="activity-date">
                                                <router-link :to="'/edit-offer/' + offer.id">edit</router-link>
                                            </div>
                                            <div class="activity-date"><a href=""
                                                    @click.prevent="removeOffer(offer.id)">remove</a></div>
                                        </div>
                                    </div>
                            </template>
                                </div>

                            <router-link to="/create-offers">
                                <div class="active-btn"><a href="">Create New Offer</a></div>

                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 main-b">
                    <div class="row">

                        <div class="col-xl-12 col-md-12 ">
                            <div class="active-title-2">
                                <h1>Activity</h1>
                            </div>
                            <div class="graph__wrapper-width">
                                <div class="hide-cancel">
                                    <div class="hide-detail">
                                        <input type="checkbox" name="" id="">
                                        <p>Hide canceled Trades</p>
                                    </div>
                                </div>
                                <div class="acivity-details">
                                    <div class="activity-info">
                                        <div class="activity-shop">
                                            <div class="activity-icon"><i class="fa fa-shopping-cart"
                                                    aria-hidden="true"></i></div>
                                            <div class="activity-name">eoaoela</div>
                                        </div>
                                        <div class="activity-shop">
                                            <div class="activity-date">11.05.2022</div>
                                            <div class="activity-time">12:00pm</div>
                                        </div>
                                        <div class="activity-shop">
                                            <div class="acivity-price">$500.00</div>
                                            <div class="activity-next-icon"><a href="#"><i class="fa fa-chevron-right"
                                                        aria-hidden="true"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="overlay">
            <div class="popup">
                <h2>confirm transfer</h2>
                <a class="close" href="#">&times;</a>
                <div class="content-pop">
                    <input type="checkbox" class="pop-chec">
                    <div class="tex"> <b>Offer Matched !</b></div>
                </div>
                <div class="pop-tos">
                    <div class="tos1"><a @click.prevent="cancelTrade()">Cancel</a></div>
                    <div class="tos2"><router-link to="/trade-in-process">Respond Now</router-link></div>
                </div>
            </div>
        </div>
    </main>

</template>

<script>
    import {
        onMounted,
        ref,
        reactive,
        computed,
        onUnmounted,
        onBeforeMount,
    } from 'vue'
import store from '../../stores'
import { useRouter } from 'vue-router'
    export default {
        name: 'Dashboard',
        setup() {

            const offers = ref([])
            const router = useRouter()
            const user = reactive(store.getters["auth/currentUser"])
            const funds = ref(0.0);
            const respond = ref(false);
            const matchOffer = ref({});
            let fundsInterval;

            onBeforeMount(() => {
                getFunds()
                fundsInterval =  setInterval(() => {
                    getFunds()
                    getMatchStatus()
                },5000)
            })

            onMounted(() => {
                if(user.is_phone_verified === 0)
                {
                    router.push('/verify/phone')
                }
                else if(user.is_email_verified === 0)
                {
                    router.push('/verify/email')
                }
                else
                {
                    getOffers()
                }
            })

            onUnmounted(()=>{
                clearInterval(fundsInterval);
            })

            const getOffers = async () => {
                axios.get('get-offers',)
                    .then((response) => {
                        offers.value = response.data.offers;
                    })
            }

            
            const getFunds = async() => {
                    
                    axios.get('get-funds')
                        .then((response) => {
                            funds.value = response.data;
                        })
                    }

            const getMatchStatus = async() => {
                    
                    axios.get('get-match-status')
                        .then((response) => {
                            if(response.data.status == true)
                            {
                                respond.value = true;
                                matchOffer.value = response.data.offer;
                                localStorage.setItem('matched-offer',JSON.stringify(matchOffer.value));
                            }
                        })
                    }

            const cancelTrade = async() => {
                    
                    axios.get('trade-cancel',matchOffer)
                        .then((response) => {
                            if(response.data == true)
                            {
                                respond.value = false;
                                matchOffer = {};
                                localStorage.removeItem('matched-offer');
                            }
                        })
                    }
                    

            const removeOffer = async (offerId) => {
                const data = {
                    offerId: offerId
                }
                axios.post('remove-offer', data)
                    .then((response) => {

                        getOffers()

                        Toast.fire({
                            text: response.data.message,
                            timer: 3000,
                            icon: 'success',
                            position: 'top-end',
                        });
                    })
            }

            return {
                offers,
                removeOffer,
                funds,
                respond,
                cancelTrade
            }
        }
    }

</script>