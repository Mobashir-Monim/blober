<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-2" v-for="(ulist, index) in cards" :key="index">
                <div class="card-header">{{ index.charAt(0).toUpperCase() + index.slice(1) }} List</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-2" v-for="(user, uindex) in ulist" :key="uindex" @click="gotoStudent(user.email)">
                            <div class="card card-rounded">
                                <div class="card-body card-rounded body-bg-hoverable">
                                    <div class="row">
                                        <div class="col-md-3 text-center my-auto border-right">
                                            <i class="fa fas fa-user-circle fa-5x text-dark"></i>
                                        </div>
                                        <div class="col-md-9 my-auto">
                                            <div class="row mb-1 border-bottom"><div class="col-md-12"><b>{{ user.name }}</b></div></div>
                                            <div class="row mb-1"><div class="col-md-12">Member Since: <b>{{ user.member_since }}</b></div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.users = JSON.parse(this.userlist);
            this.filtered = JSON.parse(this.userlist);
            this.roles = JSON.parse(this.systemroles);
        },
        props:['userlist', 'systemroles'],
        data() {
            return {
                users: [],
                filtered: [],
                roles: [],
            }
        },
        methods: {
            gotoStudent(email) {
                window.open('/home/' + email, '_self')
            }
        },
        computed: {
            cards: {
                get() {
                    return this.filtered;
                },
                set() {

                }
            }
        }
    }
</script>