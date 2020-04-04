<template>
    <div class="col-md-3 col-sm-3 col-3" id="s-nav">
        <div class="row">
            <div class="col-md-12">
                <div class="card sidenav" v-if="navStat">
                    <div class="card-header text-white">Side Nav <span @click="toggleNav()"><span class="float-right"><i class="fa fas fa-angle-left"></i><i class="fa fas fa-angle-left"></i></span></span></div>
                    <div class="card-body py-2">
                        <div class="row mb-2" v-for="(item, index) in navItems" :key="index">
                            <div class="col-md-12 text-right">
                                <a :href="item.route" :class="'btn btn-dark ' + item.width">{{ item.name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card sidenav-btn card-rounded" @click="toggleNav()" v-else>
                    <div class="card-body bg-dark card-rounded text-white text-center"><span><i class="fa fas fa-angle-right"></i><i class="fa fas fa-angle-right"></i></span></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.navs = JSON.parse(this.items);
        },
        props:['items'],
        data() {
            return {
                navs: [],
                stat: true,
            }
        },
        methods: {
            toggleNav() {
                let nav = document.getElementById('s-nav');

                if (this.stat) {
                    this.stat = false;
                    nav.classList.remove('col-md-3', 'col-sm-3', 'col-3');
                    nav.classList.add('col-md-1', 'col-sm-1', 'col-1');
                } else {
                    this.stat = true;
                    nav.classList.add('col-md-3', 'col-sm-3', 'col-3');
                    nav.classList.remove('col-md-1', 'col-sm-1', 'col-1');
                }
            }
        },
        computed: {
            navItems: {
                get() {
                    return this.navs;
                },
                set() {

                }
            },
            navStat: {
                get() {
                    return this.stat;
                },
                set() {

                }
            }
        }
    }
</script>
