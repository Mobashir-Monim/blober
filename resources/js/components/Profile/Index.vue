<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-rounded top-fixed">
                <div class="card-body card-rounded body-bg">
                    <input type="text" name="search" class="form-control" placeholder="Search" id="search" @keyup="updateTable()">
                </div>
            </div>
            <br class=""><br class=""><br class=""><br class="">
            <div class="card mb-3" v-for="(ulist, index) in cards" :key="index">
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
            Object.size = function(obj) {
                var size = 0, key;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) size++;
                }
                return size;
            };

            Object.key = function(obj, n) {
                var size = 0, key;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) {
                        if (size == n) return key;
                        size++;
                    }
                }
            };
        },
        props:['userlist', 'systemroles'],
        data() {
            return {
                users: [],
                filtered: [],
                roles: [],
                prevSeach: '',
            }
        },
        methods: {
            gotoStudent(email) {
                window.open('/home/' + email, '_self')
            },
            updateTable() {                
                let val = document.getElementById('search').value;
                this.filtered = {};

                if (val != '') {
                    if (this.prevSeach != val) {
                        for (let i = 0; i < Object.size(this.users); i++) {
                            let role = Object.key(this.users, i);

                            for (let j = 0; j < Object.size(this.users[role]); j++) {
                                if (this.checkUser(role, j, val)) {
                                    if (!this.filtered.hasOwnProperty(role)) {
                                        this.filtered[role] = [];
                                    }

                                    this.filtered[role].push(this.users[role][j]);
                                }
                            }
                        }

                        this.prevSeach = val;
                    }
                } else {
                    this.filtered = this.users;
                }
            },
            checkUser(role, j, val) {
                let x = false;

                x |= this.users[role][j].email.toLowerCase().includes(val.toLowerCase());
                x |= this.users[role][j].name.toLowerCase().includes(val.toLowerCase());

                return x;
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