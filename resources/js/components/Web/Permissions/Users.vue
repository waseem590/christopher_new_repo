<template>
    <main>
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between">
                <h1 class="mt-4 title-dashboard">Users</h1>
                <div class="box1 mt-4">
                    <router-link class="btn btn-primary" to="/add_user">
                        Add
                    </router-link>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12 main-b">
                    <div class="row">

                        <div class="col-xl-12 col-md-12 ">

                            <div class="graph__wrapper-width pd">

                                <div class="table-container">
                                    <table class="table-rwd" id="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(user,index) in users"  :key="index">
                                                <td>{{index+1}}</td>
                                                <td>{{user.username}}</td>
                                                <td>{{user.email}}</td>
                                                <td>{{user.phone}}</td>
                                                <td><div v-if="user.roles.length !== 0">{{user.roles[0].name}}</div></td>
                                                <td><router-link :to="'/edit_user/'+ user.id">
                                                        <ion-icon class="pencil" name="pencil-outline"></ion-icon>
                                                    </router-link>
                                                    <!-- <a href="" class="view">
                                                        <ion-icon name="eye-outline"></ion-icon>
                                                    </a> -->
                                                    <a href="#" @click="delete_user(user.id)">
                                                        <ion-icon class="delete" name="trash-outline"></ion-icon>
                                                    </a></td>

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
        reactive,
        onUnmounted
    } from 'vue'
    import store from '../../../stores'
 import {
        useRouter, useRoute
    } from 'vue-router';
    export default {
        name: 'Users',
        setup() {
            const users = ref([])
            const user = reactive(store.getters["auth/currentUser"])
            
            const router = useRouter()
            const route = useRoute()
            onUnmounted(()=>{
                getUsers()
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
                    getUsers()
                }
            })
            const getUsers = async () => {
                axios.get('all_users', )
                    .then((response) => {
                        users.value = response.data.users;
                    })
            }
            
            const delete_user = async (id) => {
                  const data = {
                    user_id: id
                }
                axios.post('delete-user', data)
                    .then((response) => {
                        getUsers()
                        Toast.fire({
                            text: response.data.message,
                            timer: 3000,
                            icon: 'success',
                            position: 'top-end',
                        });
                    })
            }
            return {
                users,
                delete_user
            }

        }
    }
</script>
