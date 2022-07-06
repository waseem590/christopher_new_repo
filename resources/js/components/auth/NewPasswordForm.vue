<template>
<div class="login-title">
    <h1>New Password</h1>
</div>
<div class="logoin-logo"><img :src="'images/login-icon.png'" alt="Login icon">
</div>

<div class="login-form">
    <input type="hidden" name="code" v-model="state.code">
    <input type="hidden" name="email" v-model="state.email">
    <div class="email-feild">
        <input type="password" v-model="state.password" name="password" placeholder="Password" required>
        <div class="icon"><img :src="'images/password.png'" alt=""></div>
    </div>
    <div v-if="v$.password.$error" style="text-align:center">
            <b style="color:red;">
                {{ v$.password.$errors[0].$message }}
            </b>
    </div>
    <div class="email-feild">
        <input type="password" name="confirm_password" v-model="state.confirm_password" placeholder="confirm Password" required>
        <div class="icon"><img :src="'images/password.png'" alt=""></div>
    </div>
    <div v-if="v$.confirm_password.$error" style="text-align:center">
            <b style="color:red;">
                {{ v$.confirm_password.$errors[0].$message }}
            </b>
    </div>
    <div class="login-form-btn">
        <div class="btn ml-auto mr-auto"><a @click.prevent="updatePassword()">Update Password</a></div>
    </div>

</div>
</template>

<script>
import axios from 'axios';
import  useVuelidate from "@vuelidate/core";
import {
    onMounted,
    reactive,
    computed,
    ref
} from "vue";
import {
    required,
    minLength,
    helpers
} from "@vuelidate/validators";
import { useRouter } from 'vue-router';

export default {
    name: 'NewPasswordForm',
    setup() {
        const state = reactive({
            email: '',
            reset_token: '',
            password: '',
            confirm_password: '',

        })
        const router = useRouter()
        const $externalResults = ref({})
        const rules =  {

                password: {
                    required: helpers.withMessage('Password is required', required),
                    minLength: minLength(6)
                },
                confirm_password: {
                    required: helpers.withMessage('Confirm Password is required', required),
                },

            }
            onMounted(() => {
                    if (!localStorage.getItem('reset-token') && !localStorage.getItem('email')) {
                        router.push('/forget');
                        Toast.fire({
                            icon: 'success',
                            text: 'Verification Failed.Please Try Again',
                            timer: 3000,
                            position: 'top-end',
                        });
                    }
                    else{
                        state.email = localStorage.getItem('email');
                        state.reset_token = localStorage.getItem('reset_token');
                    }
                })

            const updatePassword = async() => {
                v$.value.$clearExternalResults()
                v$.value.$validate()
                if (!v$.value.$error) {
                        axios.post("update-password", state).then(response => {
                        if (response.data.success == true) {
                            localStorage.removeItem("email");
                            localStorage.removeItem("request_token");
                            localStorage.removeItem("reset_token");
                            Toast.fire({
                                icon: 'success',
                                text: response.data.message,
                                timer: 3000,
                                position: 'top-end',
                            });
                            router.push({
                                name: 'login'
                            });
                        }
                        else {
                            $externalResults.value = response.data.message;
                        }

                    })
                }
            }  

        const v$ = useVuelidate(rules, state,{$externalResults})

        return {
            state,
            v$,
            updatePassword
        }
    }
    
}
</script>
