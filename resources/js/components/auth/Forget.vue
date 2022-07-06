<template>

    <div class="login-title">
        <h1>Forgot Password</h1>
    </div>
    <div class="logoin-logo"><img :src="'images/login-icon.png'" alt="Login icon">
    </div>

    <div class="login-form">

        <div class="email-feild">
            <input type="email" v-model="state.email" placeholder="Email" required />
            <div class="icon"><i class="far fa-envelope"></i></div>
        </div>
        <div v-if="v$.email.$error" style="text-align:center">
                <b style="color:red;">
                    {{ v$.email.$errors[0].$message }}
                </b>
        </div>

        <div class="login-form-btn">
            <div class="btn ml-auto mr-auto"><a @click.prevent="reset()">Send Verification Code</a></div>
        </div>

    </div>

    
</template>

<script>
import useVuelidate from "@vuelidate/core";
import { reactive,ref } from "vue";
import {  required,email,helpers } from "@vuelidate/validators";
import { useRouter } from 'vue-router';
export default {
    name: 'Forget',
    setup(){
        const state = reactive({
            email: ''
        })
        const router = useRouter()
        const $externalResults = ref({})
        const rules =  {
                email: {
                    required: helpers.withMessage('Email must be required', required),
                    email: helpers.withMessage("Enter valid email address.",email),
                },
            }

        const v$ = useVuelidate(rules, state,{$externalResults})

        const reset = async () => {
            v$.value.$clearExternalResults()
                v$.value.$validate() // checks all inputs
                        
                if (!v$.value.$error) {
                    axios.post('send-forget-email-code', state).then(response => {
                        if (response.data.success == true) {
                            localStorage.setItem('email', state.email)
                            localStorage.setItem('request_token', response.data.request_token)
                            router.push({
                                name: 'verify-token'
                            });
                            Toast.fire({
                                text: response.data.message,
                                timer: 2000,
                                icon:'success',
                                position: 'top-end',
                            });
                        }
                        else {
                            $externalResults.value = {
                                email:[
                                    response.data.message
                                    ]
                                }
                        }
                    });
                }

        }
        return {
            state,
            reset,
            v$,
        }
    }
}
</script>
