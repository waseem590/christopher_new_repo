<template>
    <main>
        <div class="container ">


            <div class="row">
                <div class="account-detail">
                    <div class="account-info">
                        <div class="account-title">
                            <h4>Trade Setting</h4>
                        </div>
                        <div class="trade-conatct-detail">
                            <div class='faq'>
                                <div class="main-lb-a">
                                    <div class="toggle-btn faq-a">
                                        <p class="faq-heading">Apple Pay</p>
                                        <div class='faq-btn'>
                                            <div class="switch ">
                                                <input type="checkbox" class="check">
                                                <span class="slider">
                                                    <div class="silder-circle"></div>
                                                </span>

                                            </div>

                                        </div>
                                    </div>

                                    <label for='faq-a' class="lb">

                                        <div class="account-form">
                                            <form>
                                                <div class="email-feild trade-feild">
                                                    <input type="text" name="" id="apple_pay" placeholder="cash tag"
                                                        v-model="state.apple_pay" required>
                                                    <!-- <div class="icon"><img src="img/Layer174.png" alt=""></div> -->
                                                </div>
                                                <div v-if="v$.apple_pay.$error" style="text-align:left; margin-left:15px">
                                                    <b style="color:red;">
                                                        {{ v$.apple_pay.$errors[0].$message }}
                                                    </b>
                                                </div>
                                            </form>
                                        </div>
                                    </label>
                                </div>
                                <div class="main-lb-b">
                                    <div class="toggle-btn faq-b">
                                        <p class="faq-heading">Chime</p>
                                        <div class='faq-btn'>
                                            <div class="switch ">
                                                <input type="checkbox" class="check">
                                                <span class="slider">
                                                    <div class="silder-circle"></div>
                                                </span>

                                            </div>

                                        </div>
                                    </div>

                                    <label for='faq-a' class="lb">

                                        <div class="account-form">
                                            <form>
                                                <div class="email-feild trade-feild">
                                                    <input type="text" name="" id="chime" placeholder="cash tag"
                                                        v-model="state.chime" required>
                                                    <!-- <div class="icon"><img src="img/Layer174.png" alt=""></div> -->
                                                </div>
                                                <div v-if="v$.chime.$error" style="text-align:left; margin-left:15px">
                                                    <b style="color:red;">
                                                        {{ v$.chime.$errors[0].$message }}
                                                    </b>
                                                </div>

                                            </form>
                                        </div>
                                    </label>
                                </div>
                                <div class="main-lb-c">
                                    <div class="toggle-btn faq-c">
                                        <p class="faq-heading">Venmo</p>
                                        <div class='faq-btn'>
                                            <div class="switch ">
                                                <input type="checkbox" class="check">
                                                <span class="slider">
                                                    <div class="silder-circle"></div>
                                                </span>

                                            </div>

                                        </div>
                                    </div>

                                    <label for='faq-a' class="lb">

                                        <div class="account-form">
                                            <form>
                                                <div class="email-feild trade-feild">
                                                    <input type="text" name="" id="venmo" placeholder="cash tag"
                                                        v-model="state.venmo" required>
                                                    <!-- <div class="icon"><img src="img/Layer174.png" alt=""></div> -->
                                                </div>
                                                <div v-if="v$.venmo.$error" style="text-align:left; margin-left:15px">
                                                    <b style="color:red;">
                                                        {{ v$.venmo.$errors[0].$message }}
                                                    </b>
                                                </div>

                                            </form>
                                        </div>
                                    </label>
                                </div>
                                <div class="main-lb-d">
                                    <div class="toggle-btn faq-d">
                                        <p class="faq-heading">Square Cash</p>
                                        <div class='faq-btn'>
                                            <div class="switch ">
                                                <input type="checkbox" class="check">
                                                <span class="slider">
                                                    <div class="silder-circle"></div>
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <label for='faq-a' class="lb">

                                        <div class="account-form">
                                            <form>
                                                <div class="email-feild trade-feild">
                                                    <input type="text" name="" id="venmo" placeholder="cash tag"
                                                        v-model="state.square_cash" required>
                                                    <!-- <div class="icon"><img src="img/Layer174.png" alt=""></div> -->
                                                </div>
                                                <div v-if="v$.square_cash.$error" style="text-align:left; margin-left:15px">
                                                    <b style="color:red;">
                                                        {{ v$.square_cash.$errors[0].$message }}
                                                    </b>
                                                </div>

                                            </form>
                                        </div>
                                    </label>
                                </div>
                                <div class="main-lb-e">
                                    <div class="toggle-btn faq-e">
                                        <p class="faq-heading">PayPal</p>
                                        <div class='faq-btn'>
                                            <div class="switch ">
                                                <input type="checkbox" class="check">
                                                <span class="slider">
                                                    <div class="silder-circle"></div>
                                                </span>

                                            </div>

                                        </div>
                                    </div>

                                    <label for='faq-a' class="lb">

                                        <div class="account-form">
                                            <form>
                                                <div class="email-feild trade-feild">
                                                    <input type="text" name="" id="paypal" placeholder="cash tag"
                                                        v-model="state.paypal" required>
                                                    <!-- <div class="icon"><img src="img/Layer174.png" alt=""></div> -->
                                                </div>
                                                <div v-if="v$.paypal.$error" style="text-align:left; margin-left:15px">
                                                    <b style="color:red;">
                                                        {{ v$.paypal.$errors[0].$message }}
                                                    </b>
                                                </div>

                                            </form>
                                        </div>
                                    </label>
                                </div>
                                <div class="main-lb-f">
                                    <div class="toggle-btn faq-f">
                                        <p class="faq-heading">Zelle</p>
                                        <div class='faq-btn'>
                                            <div class="switch">
                                                <input type="checkbox" class="check">
                                                <span class="slider">
                                                    <div class="silder-circle"></div>
                                                </span>

                                            </div>

                                        </div>
                                    </div>

                                    <label for='faq-a' class="lb">

                                        <div class="account-form">
                                            <form>
                                                <div class="email-feild trade-feild">
                                                    <input type="text" name="" id="zelle" placeholder="cash tag"
                                                        v-model="state.zelle" required>
                                                    <!-- <div class="icon"><img src="img/Layer174.png" alt=""></div> -->
                                                </div>
                                                <div v-if="v$.zelle.$error" style="text-align:left; margin-left:15px">
                                                    <b style="color:red;">
                                                        {{ v$.zelle.$errors[0].$message }}
                                                    </b>
                                                </div>

                                            </form>
                                        </div>
                                    </label>
                                </div>
                                <div class="login-form-btn account-f-btn">
                                        <div class="btn account-b"><a @click.prevent="create_trade_setting()">Save</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</template>

<script>
    import useVuelidate from '@vuelidate/core';
    import {
        useRoute,
        useRouter
    } from 'vue-router';
    import {
        ref,
        reactive,
        computed,
        onMounted
    } from "vue";
    import {
        required,
        helpers
    } from "@vuelidate/validators";

    export default {
        name: 'TradeSetting',
        setup() {
            const path = ref('create-trade-settings')
            const route = useRoute()
            const router = useRouter()
            const state = reactive({
                apple_pay: '',
                chime: '',
                venmo: '',
                square_cash: '',
                paypal: '',
                zelle: '',
            })

            const rules = {
                apple_pay: {
                    required: helpers.withMessage('The Apple Pay Cash Tag is required', required),
                },
                chime: {
                    required: helpers.withMessage('The Chime Cash Tag is required', required),
                },
                venmo: {
                    required: helpers.withMessage('Venmo Cash Tag is required', required),
                },
                square_cash: {
                    required: helpers.withMessage('Square Cash Tag is required', required),
                },
                paypal: {
                    required: helpers.withMessage('Paypal Cash Tag is required', required),
                },
                zelle: {
                    required: helpers.withMessage('Zelle Cash Tag is required', required),
                },
            }


            const v$ = useVuelidate(rules, state)

            onMounted(() => {})

            const create_trade_setting = async () => {
                v$.value.$validate()
                console.log(v$.value.$errors)
                if (!v$.value.$error) {
                    let result = await axios.post(path.value, state)
                    console.log(result)
                    if (result.data.success == true) {
                        router.push({
                            name: 'dashboard'
                        })
                        Toast.fire({
                            text: result.data.message,
                            timer: 2000,
                            icon: 'success',
                            position: 'top-end',
                        });
                    }

                } else {
                    console.log('Form failed validation')
                }

            }


            return {
                state,
                v$,
                create_trade_setting,
            }
        },
    }

</script>
