<template>
    <main>
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between">
                <h1 class="mt-4 title-dashboard">Edit Role</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="user_input">
                        <input type="text" name="role" readonly v-model="state.role" placeholder="name" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input_select">
                        <!-- <select id="example-getting-started" v-model="perm" multiple="multiple">
                            <option >ahsan</option>
                            <option >ahsan</option>
                        </select> -->
                        <Select2 v-model="perm" :options="u_perm" :settings="{ width:'100%',
                        multiple: true, }"/>
                    </div>
                </div>

                <div class="login-form-btn">
                    <div class="btn"><a @click.prevent="assign_permission_role()">Update</a></div>
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
        helpers,
    } from "@vuelidate/validators";
    import {
        useRouter, useRoute
    } from 'vue-router';
    import store from '../../../stores'
    import Select2 from 'vue3-select2-component';

    export default {
        name: 'addUser',
        components: {Select2},
        setup() {
            const state = reactive({
                name: '',
                roleId: 0,
                role: ''
            })
            const router = useRouter()
            const route = useRoute()
            const user = reactive(store.getters["auth/currentUser"])
            const perm = ref([])
            const u_perm = ref([])

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
                            edit_role()
                            get_permissions()
                        }
                        
                    })
            
            const $externalResults = ref({})
            const rules = {
                name: {
                    required: helpers.withMessage('Name must be required', required),
                },
                permission: {
                    required: helpers.withMessage('Email must be required', required),
                },
            }
            const v$ = useVuelidate(rules, state, {
                $externalResults
            })
                        
            
            const edit_role = async () => {
                if (route.params.roleId) {
                    const data = {
                        roleId: route.params.roleId
                    }
                    axios.post('edit_roles', data)
                        .then((response) => {
                            state.roleId = data.roleId
                            state.role = response.data.role.name
                        })
                }
            }
        
            const get_permissions = async () => {
                    axios.get('get_permissions')
                        .then((response) => {
                            u_perm.value = response.data.data
                            console.log(u_perm.value);
                        })
            }
            const assign_permission_role = async () => {            
                const data = {
                    permissions:perm.value,
                    roleId: route.params.roleId
                }
                    axios.post('assign_permission_role', data)
                        .then((response) => {
                            router.push('/roles')
                        })
            }
            return {
                state,
                v$,
                perm,
                u_perm,
                assign_permission_role
            }

        }
    }

</script>
