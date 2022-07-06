<template>
    <main>
        <div class="container ">
            <div class="top-text-btn">
                <div class="view-text">
                    <p>Viewing MatchPay for:</p>
                </div>
                <div class="view-btn"><a href="">IGN</a></div>
            </div>

            <div class="row">
                <div class="account-detail">
                    <div class="account-info">
                        <div class="account-title">
                            <h4>Account Setting</h4>
                        </div>
                        <div class="account-conatct-detail">
                            <div class="account-description">
                                <p>We use your email and phone number to communicate with you. <br> if you wan</p>
                            </div>
                            <div class="account-form">
                                <form>
                                    <div class="email-feild account-feild">
                                        <input type="text" v-model="state.username" placeholder="Username" required="">
                                        <!-- <div class="icon"><img src="img/Layer174.png" alt=""></div> -->
                                    </div>
                                    <div v-if="v$.username.$error" style="text-align:center">
                                            <b style="color:red;">
                                                {{ v$.username.$errors[0].$message }}
                                            </b>
                                    </div>
                                    <div class="email-feild account-feild">
                                        <input type="text" v-model="state.email" placeholder="Email" required="">
                                        <!-- <div class="icon"><img src="img/Layer175.png" alt=""></div> -->
                                    </div>
                                    <div v-if="v$.email.$error" style="text-align:center">
                                            <b style="color:red;">
                                                {{ v$.email.$errors[0].$message }}
                                            </b>
                                    </div>
                                    <div class="email-feild account-feild phone-num-inter">
                                        <input type="text" v-model="state.code" disabled placeholder="+92" class="code-num"
                                            required="">
                                        <input type="text" v-model="state.phone" placeholder="3xxxxxxxxx" class="f-num" required="">
                                            
                                    </div>
                                    
                                    <div class="login-form-btn account-f-btn">
                                        <div class="btn account-b"><a @click.prevent="update()">Update</a></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { ref,onMounted,reactive } from 'vue'
import useVuelidate from "@vuelidate/core";
import { required,helpers,email,minLength,maxLength,integer,alphaNum } from "@vuelidate/validators";
import store from '../../stores'
import { useRouter } from 'vue-router';
export default {
    name: 'AccountSetting',

    setup() {

        const state = reactive({
            username: store.getters['auth/currentUser'].username,
            email: store.getters['auth/currentUser'].email,
            code: '+92',
            phone: '',

        })

        const router = useRouter()
        const $externalResults = ref({})

        const rules = {
            username:{
                required: helpers.withMessage("Username field is required.",required),
                alphaNum:helpers.withMessage("Username must not contain spaces and dashes.",alphaNum),
            },
            email:{
                required: helpers.withMessage("Email field is required.",required),
                email: helpers.withMessage("Enter valid email address.",email),
            },
            phone:{
                required: helpers.withMessage("Phone field is required.",required),
                integer: helpers.withMessage("Phone Number must conatin numbers.",integer),
                minLength: minLength(10),
                maxLength: maxLength(10),
            },
        }

        onMounted(() => {
            const phoneStr = store.getters['auth/currentUser'].phone;
            state.phone = phoneStr.slice(3,phoneStr.length);

        })

        const v$ = useVuelidate(rules,state,{ $externalResults });

        const update = () => {
            v$.value.$clearExternalResults()
            v$.value.$validate()
            if(!v$.value.$error)
            {
                const data = {
                    username: state.username,
                    email: state.email,
                    phone: '+92'+state.phone,
                }
                axios.post('/update-setting',data).then(response => {
                    if(response.data.success)
                    {
                        const user = response.data.user;
                        user.token = store.getters['auth/currentUser'].token;
                        localStorage.removeItem("currentUser");
                        const strUser = JSON.stringify(user);
                        localStorage.setItem("currentUser",strUser);
                        store.commit("auth/setCurrentUser",user);
                        Toast.fire({
                                text: response.data.message,
                                timer: 3000,
                                icon: 'success',
                                position: 'top-end',
                            });
                        if(user.is_phone_verified === 0)
                            router.push('/verify/phone');
                        else if(user.is_email_verified === 0)
                            router.push('/verify/email');
                    }
                    else{
                        $externalResults.value = response.data.message
                    }
                })
            }
        }

        return {
            state,
            update,
            v$,
        }
    },

}

</script>
