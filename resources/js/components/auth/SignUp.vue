<template>
    <div class="login-title">
        <h1>SignUp</h1>
    </div>
    <div class="logoin-logo"><img :src="'images/login-icon.png'" alt="Login icon">
    </div>
    <div class="login-form">
        <div class="email-feild">
            <input type="text" name="name" v-model="state.username" placeholder="username" required>
            <div class="icon"><img :src="'images/user.png'" alt=""></div>
        </div>
        <div v-if="v$.username.$error" style="text-align:center">
            <b style="color:red;">
                {{ v$.username.$errors[0].$message }}
            </b>
        </div>
        <div class="email-feild">
            <input type="text" name="email" v-model="state.email" placeholder="Email" required>
            <div class="icon"><img :src="'/assets/images/email.png'" alt=""></div>

        </div>
        <div v-if="v$.email.$error" style="text-align:center">
            <b style="color:red;">
                {{ v$.email.$errors[0].$message }}
            </b>
        </div>
        <div class="email-feild account-feild phone-num-inter">
            <input type="text" style="width:100px;margin-right:10px" v-model="state.code" disabled placeholder="+92"
                class="code-num" required="">
            <input type="text" v-model="state.phone" placeholder="3xxxxxxxxx" class="f-num" required="">

        </div>
        <div v-if="v$.phone.$error" style="text-align:center">
            <b style="color:red;">
                {{ v$.phone.$errors[0].$message }}
            </b>
        </div>
        <div class="email-feild">
            <input type="password" name="password" v-model="state.password" placeholder="Password" required>
            <div class="icon"><img :src="'/assets/images/password.png'" alt=""></div>

        </div>
        <div v-if="v$.password.$error" style="text-align:center">
            <b style="color:red;">
                {{ v$.password.$errors[0].$message }}
            </b>
        </div>
        <div class="login-form-btn">
            <div class="btn"><a @click.prevent="signup()">Sign Up</a></div>
            <div class="forget">
                <router-link to="/">Login</router-link>
            </div>
        </div>

    </div>
</template>

<script>
    import axios from 'axios';
    import useVuelidate from "@vuelidate/core";
    import {
        reactive,
        ref
    } from "vue";
    import {
        required,
        email,
        minLength,
        maxLength,
        helpers,
        alphaNum,
        integer
    } from "@vuelidate/validators";
    import {
        useRouter
    } from 'vue-router';
    export default {
        name: 'SignUp',
        setup() {
            const state = reactive({
                username: '',
                email: '',
                code: '',
                phone: '',
                password: '',

            })
            const router = useRouter()
            const $externalResults = ref({})
            const rules = {
                username: {
                    required: helpers.withMessage('Name must be required', required),
                    alphaNum: helpers.withMessage("Username must not contain spaces and dashes.", alphaNum),
                },
                email: {
                    required: helpers.withMessage('Email must be required', required),
                    email: helpers.withMessage("Enter valid email address.", email),
                },
                phone: {
                    required: helpers.withMessage("Phone field is required.", required),
                    integer: helpers.withMessage("Phone Number must conatin numbers.", integer),
                    minLength: minLength(10),
                    maxLength: maxLength(10),
                },

                password: {
                    required: helpers.withMessage('Password must be required', required),
                    minLength: minLength(6)
                },
            }
            const v$ = useVuelidate(rules, state, {
                $externalResults
            })

            const signup = async () => {
                v$.value.$clearExternalResults()
                v$.value.$validate() // checks all inputs
                if (!v$.value.$error) {
                    const data = {
                        username: state.username,
                        email: state.email,
                        phone: '+92' + state.phone,
                        password: state.password,
                    }
                    axios.post("signup", data).then(response => {
                        if (response.data.success) {
                            router.push({
                                name: 'login'
                            });

                            Toast.fire({
                                text: response.data.message,
                                timer: 3000,
                                icon: 'success',
                                position: 'top-end',
                            });
                        } else {
                            $externalResults.value = response.data.message
                        }

                    })
                }
            }



            return {
                state,
                signup,
                v$
            }

        }
    }

</script>
