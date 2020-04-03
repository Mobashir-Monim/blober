<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="row mb-2">
                        <!-- <div class="col-md-2 my-auto text-right">
                            Name:
                        </div> -->
                        <div class="col-md">
                            <input type="text" name="name" class="form-control" placeholder="User Name" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <!-- <div class="col-md-2 my-auto text-right">
                            Email:
                        </div> -->
                        <div class="col-md">
                            <input type="email" name="email" class="form-control" placeholder="User Email" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2" v-if="is_student">
                <div class="col-md-6">
                    <div class="row mb-2">
                        <!-- <div class="col-md-2 my-auto text-right">
                            Student ID:
                        </div> -->
                        <div class="col-md">
                            <input type="number" name="student_id" min="10000000" step="1" class="form-control" placeholder="Student ID" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <!-- <div class="col-md-2 my-auto text-right">
                            Section:
                        </div> -->
                        <div class="col-md">
                            <input type="number" name="section" min="1" step="1" class="form-control" placeholder="Section" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="row">
                        <!-- <div class="col-md-2 my-auto text-right">
                            Role:
                        </div> -->
                        <div class="col-md">
                            <select name="role" class="form-control" required @change="changeSelected()" id="role">
                                <option value="">Select Role</option>
                                <option v-for="(role, index) in this.roles" :key="index" :value="index">{{ role.toUpperCase() }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md">
                            <button type="submit" class="btn btn-dark w-100">Add User</button>
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
            this.roles = JSON.parse(this.systemroles);
        },
        props:['systemroles'],
        data() {
            return {
                roles: [],
                user_role: null,
            }
        },
        methods: {
            changeSelected() {
                this.user_role = document.getElementById('role').value;
            }
        },
        computed: {
            selected_role: {
                get() {
                    return this.user_role;
                },
                set() {

                }
            },
            is_student: {
                get() {
                    return this.roles[this.user_role] == 'student' ? true : false;
                },
                set() {

                }
            }
        }
    }
</script>
