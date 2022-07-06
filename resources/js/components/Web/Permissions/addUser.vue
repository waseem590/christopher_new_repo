<template>
    <main>
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between">
                <h1 class="mt-4 title-dashboard">Add User</h1>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12 col-lg-6">
                    <div class="user_input">
                        <input type="text" name="name" v-model="state.username" placeholder="username" required>
                    </div>
                    <div v-if="v$.username.$error">
                        <b style="color:red;">
                            {{ v$.username.$errors[0].$message }}
                        </b>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-lg-6">
                    <div class="user_input">
                        <input type="text" name="email" v-model="state.email" placeholder="Email" required>
                    </div>
                    <div v-if="v$.email.$error">
                        <b style="color:red;">
                            {{ v$.email.$errors[0].$message }}
                        </b>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-lg-6">
                    <div class="user_input">
                        <input type="text" style="width:100px;margin-right:10px" v-model="state.code" disabled
                            placeholder="+92" class="code-num" required="">
                        <input type="text" v-model="state.phone" placeholder="3xxxxxxxxx" class="f-num" required="">

                    </div>
                    <div v-if="v$.phone.$error">
                        <b style="color:red;">
                            {{ v$.phone.$errors[0].$message }}
                        </b>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-lg-6">
                    <div class="user_input">
                        <input type="password" name="password" v-model="state.password" placeholder="Password" required>
                    </div>
                    <div v-if="v$.password.$error">
                        <b style="color:red;">
                            {{ v$.password.$errors[0].$message }}
                        </b>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-lg-6">
                    <div class="user_input">
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                            v-model="state.role">
                            <option value="3">Admin</option>
                            <option value="2">Operator</option>
                            <option value="1">Player</option>
                        </select>
                    </div>
                    <div v-if="v$.role.$error">
                        <b style="color:red;">
                            {{ v$.role.$errors[0].$message }}
                        </b>
                    </div>
                </div>

                <div class="login-form-btn">
                    <div class="btn"><a @click.prevent="signup()">Save</a></div>
                </div>

            </div>

        </div>

    </main>
</template>
<script>
    import axios from 'axios';
    import useVuelidate from "@vuelidate/core";
    import {
        reactive,
        ref,
        onMounted
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
        useRouter, useRoute
    } from 'vue-router';
import store from '../../../stores'
    
    export default {
        name: 'addUser',
        setup() {
            const state = reactive({
                username: '',
                email: '',
                code: '',
                phone: '',
                password: '',
                role: '1',
                userId: 0
            })
            console.log(state.userId)
            const router = useRouter()
            const route = useRoute()
            const user = reactive(store.getters["auth/currentUser"])

            onMounted(()=>{
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
                            edit_user()
                        }
                    })
            
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
                    minLength: minLength(8)
                },
                role: {
                    required: helpers.withMessage('Role must be required', required),
                },
            }
            const v$ = useVuelidate(rules, state, {
                $externalResults
            })
            
         
            // const signup=async () => {
            //     v$.value.$clearExternalResults()
            //     v$.value.$validate() // checks all inputs
            //     if (!v$.value.$error) {
            //         const data = {
            //             username: state.username,
            //             email: state.email,
            //             phone: '+92' + state.phone,
            //             password: state.password,
            //             role: state.role,
            //         }
            //         axios.post("add_user", data).then(response => {
            //             if (response.data.success) {
            //                 router.push({
            //                     name: '/users'
            //                 });

            //                 Toast.fire({
            //                     text: response.data.message,
            //                     timer: 3000,
            //                     icon: 'success',
            //                     position: 'top-end',
            //                 });
            //             } else {
            //                 $externalResults.value = response.data.message
            //             }

            //         })
            //     }
            // }
            const path = ref('add_user')

             const signup = async() => {
            v$.value.$validate()
            if (!v$.value.$error) {
              let result = await axios.post(path.value, state)
                if (result.data.success == true) {
                  router.push({
                    name: 'users'
                  })
                    Toast.fire({
                        text: result.data.message,
                        timer: 2000,
                        icon: 'success',
                        position: 'top-end',
                    });
                }
                else{
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
                    const edit_user = async () => {
                        if (route.params.userId) {
                            const data = {
                                userId: route.params.userId
                            }
                            axios.post('edit-user', data)
                                .then((response) => {
                                    path.value = 'update-user'
                                    state.username = response.data.user.username
                                    state.email = response.data.user.email
                                    state.password =response.data.user.password 
                                    state.phone = response.data.user.phone
                                    state.role = response.data.user.role[0].id
                                    state.userId = data.userId
                                })
                        }
                    }


            return {
                state,
                signup,
                v$,
            }

        }
    }

</script>
