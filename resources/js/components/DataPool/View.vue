<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">Datapools</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#/" class="btn btn-dark mr-4 mb-2" v-for="(dp, index) in datapools" :key="index" @click="changeSelectedPool(index)">{{ dp }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">Tables</div>
                <div class="card-body">
                    <div class="row mb-2" v-if="currentPool">
                        <div class="col-md-12">
                            <h4 class="text-center">Selected {{ currentPool }}</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="#/" class="btn btn-dark mr-4 mb-2" v-for="(table, index) in tables" :key="index" @click="changeSelectedTable(index)">{{ table }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2" v-else>
                        <div class="col-md-12">
                            <h4 class="text-center">No Pool selected</h4>
                        </div>
                    </div>

                    <div class="row mb-2" v-if="this.unassigned">
                        <div class="col-md-2 mb-2">
                            <a href="#/" class="btn btn-dark w-100" @click="changeSelectedPool(0)">Unassigned</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Table Data</div>
                <div class="card-body">
                    <div class="row" v-if="currentTable">
                        <div class="col-md-12 text-center">
                            <h4>Selected {{ currentTable }}</h4>
                            <table class="table table-sm table-striped">
                                <tbody>
                                    <tr v-for="(row, index) in this.table" :key="index">
                                        <td class="px-2 border" v-for="(col, colIndex) in row" :key="colIndex">{{ col }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" v-else>
                        <div class="col-md-12">
                            <h4 class="text-center">No Table selected</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a :href="this.addroute" class="add-btn btn-dark"></a>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.datapools = JSON.parse(this.dps);
        },

        props: ['dps', 'addroute'],

        data() {
            return {
                datapools: 0,
                selectedPool: null,
                selectedTable: null,
                tables: null,
                table: null,
            }
        },

        methods: {
            changeSelectedPool(value) {
                this.selectedPool = value;
                this.fetchDPTables();
            },
            changeSelectedTable(value) {
                this.selectedTable = value;
                this.fetchTableData();
            },
            fetchDPTables() {
                fetch('/api/datapools/' + this.selectedPool)
                    .then(res => res.json())
                    .then(res => {
                        this.tables = res.data.tables;
                    })
                    .catch(err => console.log(err));
            },
            fetchTableData() {
                fetch('/api/datapools/tables/' + this.selectedTable)
                    .then(res => res.json())
                    .then(res => {
                        this.table = res.data;
                    })
                    .catch(err => console.log(err));
            },
        },

        computed: {
            currentPool: {
                get() {
                    return this.selectedPool == null ? false : this.datapools[this.selectedPool];
                },
                set(value) {
                    this.selectedPool = value;
                }
            },
            currentTable: {
                get() {
                    return this.selectedTable == null ? false : this.tables[this.selectedTable];
                },
                set(value) {
                    this.selectedTable = value;
                }
            },
        }
    }
</script>
