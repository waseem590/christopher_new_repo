<template>
    <main>
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between">
                <h1 class="mt-4 title-dashboard">Roles</h1>
                <!-- <div class="box1 mt-4">
                    <a class="btn btn-primary" href="#">Add</a>
                </div> -->
            </div>

            <div class="row">

                <div class="col-md-12 main-b">
                    <div class="row">

                        <div class="col-xl-12 col-md-12 ">

                            <div class="graph__wrapper-width pd">

                                <div class="table-container">
                                    <table class="table-rwd">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Permissions</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <tr v-for="(role,index) in roles"  :key="index">
                                                <td>{{index+1}}</td>
                                                <td>{{role.name}}</td>
                                                <td>
                                                <span class="badge badge-success" v-for="permission in role.permissions" :key="permission.id">{{permission.name}}</span>
                                                </td>
                                                <td><router-link :to="'/edit_role/'+ role.id">
                                                        <ion-icon class="pencil" name="pencil-outline"></ion-icon>
                                                    </router-link>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    import axios from 'axios';
    import {
        onMounted,
        ref,
        reactive
    } from 'vue'
    import store from '../../../stores'
    import {
        useRouter,
        useRoute
    } from 'vue-router';

    export default {
        name: 'Role',
        setup() {
            const roles = ref([])
            const user = reactive(store.getters["auth/currentUser"])
            const router = useRouter()
            const route = useRoute()

            onMounted(() => {
                if (user.is_phone_verified === 0) {
                    router.push('/verify/phone')
                } else if (user.is_email_verified === 0) {
                    router.push('/verify/email')
                } else {
                    getRoles()
                }
            })
            const getRoles = async () => {
                axios.get('get_roles', )
                    .then((response) => {
                        roles.value = response.data.roles
                    })
            }
            return {
                roles,
            }

        }
    }

</script>
