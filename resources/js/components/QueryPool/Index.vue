<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Queries</div>
                <div class="card-body">
                    <select id="dp" @change="getQueries()" class="form-control">
                        <option value="">Please select a Datapool to view queries for the pool</option>
                        <option :value="index" v-for="(pool, index) in datapools" :key="index">{{ pool }}</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3" v-if="queries != false">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">All Queries</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3" v-for="(query, index) in queries" :key="index">
                                    <div class="card card-rounded body-bg-hoverable" @click="goto(index)">
                                        <div class="card-body card-rounded body-bg-hoverable">
                                            <strong>Question:</strong> <p v-html="query.question"></p>
                                            <strong>Output Query(s):</strong> <p v-html="query.query"></p>
                                            <div class="row mb-2">
                                                <div class="col-md-4">
                                                    <strong>Points:</strong> {{ query.points }}
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Deductible:</strong> {{ query.deductible == null ? 0 : query.deductible }}
                                                </div>
                                                <div class="col-md-4">
                                                    <strong>Time:</strong> {{ query.time == null ? 'Not Defined' : query.time }}
                                                </div>
                                            </div>
                                            <div class="p-2 m-1 tag label-info float-left rounded" v-for="(tag, tIndex) in query.tags" :key="tIndex">{{ tag }}</div>
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
            this.dpools = JSON.parse(this.dps);
        },
        props:['dps', 'sessioncode'],
        data() {
            return {
                dpools: {},
                qpools: null,
            }
        },
        methods: {
            getQueries() {
                (async () => {
                    const rawResponse = await fetch('/api/query/' + document.getElementById('dp').value + '/get', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            sessioncode: this.sessioncode,
                        })
                    });
                    let res = await rawResponse.json();
                    this.qpools = res.data.queries;
                })();
            },
            goto(index) {
                window.open('/query/' + this.queries[index].id + '/edit', '_self');
            }
        },
        computed: {
            datapools: {
                get() {
                    return this.dpools;
                },
                set() {

                }
            },
            queries: {
                get() {
                    return this.qpools == null ? false : this.qpools;
                },
                set() {

                }
            }
        }
    }
</script>
