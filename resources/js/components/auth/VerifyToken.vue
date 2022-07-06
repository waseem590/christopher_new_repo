<template>
   
    <div class="login-title">
        <h1>Verify Code</h1>
    </div>
    <div class="logoin-logo"><img :src="'images/login-icon.png'" alt="Login icon">
    </div>
    
    <div class="login-form">
        <div class="email-feild">
            <input type="text" v-model="state.code" placeholder="Code" required />
            <div class="icon"><i class="far fa-envelope"></i></div>
        </div>
        <div v-if="v$.code.$error" style="text-align:center">
                <b style="color:red;">
                    {{ v$.code.$errors[0].$message }}
                </b>
        </div>
        <div class="login-form-btn">
            <div class="btn"><a @click.prevent="verifyCode()">Verify</a></div>
            <div class="forget" style="cursor:pointer"><a @click.prevent="resendCode()">Resend Code</a></div>
        </div>
    </div>
           

</template>

<script>
import { onMounted,reactive, ref} from 'vue';
import useVuelidate from '@vuelidate/core';
import { required,integer,helpers, minLength, maxLength } from '@vuelidate/validators';
import { useRouter } from 'vue-router';

export default {
    name: 'VerifyToken',
    setup() {
        const state = reactive({
            email: '',
            code: '',
            request_token: '',
        })
        const router = useRouter();
        const rules = {
            code:{
                required:helpers.withMessage('Code field is required.',required),
                integer:helpers.withMessage('Code field must contain numbers.',integer),
                minLength:minLength(6),
                maxLength:maxLength(6),
            }
        }
        const $externalResults = ref({})

        const v$ = useVuelidate(rules,state,{$externalResults})

        const verifyCode = async() => {
            v$.value.$clearExternalResults()
            v$.value.$validate()
            if(!v$.value.$error){
                axios.post('verify-forget-email-code', state).then(response => {
                    if (response.data.success == true) {
                        localStorage.setItem('reset_token', response.data.reset_token)
                        Toast.fire({
                            text: response.data.message,
                            timer: 2000,
                            icon:'success',
                            position: 'top-end',
                        });
                        router.push({
                            name: 'passwordForm'
                        });
                    }
                    else{
                        $externalResults.value = {
                            code: [
                                response.data.message
                            ]
                        }
                    }
                });
            
            }
        } 

        const resendCode = async() => {
            axios.post('send-forget-email-code', {email:state.email}).then(response => {
                        if (response.data.success == true) {
                            localStorage.removeItem('email')
                            localStorage.removeItem('request_token')
                            localStorage.setItem('email', state.email)
                            localStorage.setItem('request_token', response.data.request_token)
                            state.request_token = response.data.request_token;
                            Toast.fire({
                                text: response.data.message,
                                timer: 2000,
                                icon:'success',
                                position: 'top-end',
                            });
                        }
            })
        }
        
        onMounted(()=> {
            if(!localStorage.getItem('request_token') && !localStorage.getItem('email'))
            {
                router.push('/forget');
                Toast.fire({
                    text: 'Verification Failed.Please Try Again',
                    timer: 3000,
                    icon:'success',
                    position: 'top-end',
                });
            }
            else{
                state.email = localStorage.getItem('email');
                state.request_token = localStorage.getItem('request_token');
            }
        })

        return {
            state,
            v$,
            verifyCode,
            resendCode
        }
    }


}
</script>
