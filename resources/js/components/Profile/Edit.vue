<template>
    <div class="card">
        <div class="card-header">Update Profile</div>
        <div class="card-body">
            <div class="row text-center alert alert-success push-down mb-3" v-if="profileUpdate != null">
                <div class="col-md-12">
                    {{ profileUpdate }}
                </div>
            </div>
            <h3 class="border-bottom mb-3">Personal Information</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right my-auto">Name:</div>
                        <div class="col-md">
                            <input type="text" name="name" class="form-control" placeholder="Name" v-model="username" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right my-auto">Email:</div>
                        <div class="col-md">
                            <input type="text" name="name" class="form-control disabled" placeholder="Email" v-model="useremail" disabled required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right my-auto">Role:</div>
                        <div class="col-md">
                            <input type="text" name="role" class="form-control disabled" placeholder="Role" v-model="userrole" disabled required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <a href="#/" class="btn btn-success w-100" @click="upadateProfile()">Update Personal Information</a>
                </div>
            </div>

            <h3 class="border-bottom mb-3">Password</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right my-auto">New Password:</div>
                        <div class="col-md my-auto">
                            <input type="password" name="password" class="form-control disabled" disabled placeholder="New Password" id="name" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right my-auto">Confirm Password:</div>
                        <div class="col-md my-auto">
                            <input type="password" name="password_confirmed" class="form-control disabled" disabled placeholder="Confirm Password" id="email" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right my-auto">Current Password:</div>
                        <div class="col-md my-auto">
                            <input type="password" name="current_password" class="form-control disabled" disabled placeholder="Current Password" id="role" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-auto">
                    <button type="submit" class="btn btn-danger w-100 disabled" disabled>Update Password</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetchUserData();
        },
        data() {
            return {
                name: '',
                email: '',
                role: '',
                update: null,
            }
        },
        props: ['user', 'editor'],
        methods: {
            fetchUserData() {
                (async () => {
                    const rawResponse = await fetch('/api/user/get', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({user: this.user, editor: this.editor})
                    });
                    let res = await rawResponse.json();

                    this.setData(res.data);
                })();
            },
            setData(data) {
                this.name = data.name;
                this.email = data.email;
                this.role = data.role;
            },
            upadateProfile() {
                (async () => {
                    const rawResponse = await fetch('/api/user/update', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.getProfileUpdateBody())
                    });
                    let res = await rawResponse.json();

                    this.update = res.data.update;
                })();
            },
            getProfileUpdateBody() {
                return {
                    user: this.user,
                    name: this.name,
                    email: this.email,
                    role: this.role,
                    editor: this.editor,
                };
            }
        },
        computed: {
            username: {
                get() {
                    return this.name;
                },
                set(value) {
                    this.name = value;
                }
            },
            useremail: {
                get() {
                    return this.email;
                },
                set(value) {
                    this.email = value;
                }
            },
            userrole: {
                get() {
                    return this.role;
                },
                set(value) {
                    this.role = value;
                }
            },
            profileUpdate: {
                get() {
                    return this.update;
                },
                set(value) {
                    this.update = value;
                }
            },
        }
    }
</script>
