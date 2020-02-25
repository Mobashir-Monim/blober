<template>
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-2">
                <div class="col-md-6"></div>
                <div class="col-md-2 my-auto text-right">Search:</div>
                <div class="col-md"><input type="text" name="search" id="search" class="form-control" placeholder="Search" @keyup="updateTable()"></div>
            </div>
            <table class="table table-sm table-striped">
                <thead class="thead-light">
                    <tr>
                        <th class="border px-3 py-1" scope="col" v-for="(head, index) in this.headings" :key="index"><strong>{{ head }}</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, rowIndex) in resultTable" :key="rowIndex">
                        <td class="border px-3 py-1" v-for="(col, colIndex) in row" :key="colIndex">{{ col }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script defer="defer">
    export default {
        mounted() {
            this.tContent = JSON.parse(this.table);
            this.initTable = JSON.parse(this.table);
            this.headings = JSON.parse(this.headers);
        },
        props: ['headers', 'table', 'vals', 'hlen'],
        data() {
            return {
                headings: [],
                tContent: [],
                initTable: [],
                prevSeach: '',
            }
        },
        methods: {
            updateTable() {
                let val = document.getElementById('search').value;
                this.tContent = [];

                if (this.prevSeach != val) {
                    for (let i = 0; i < this.vals; i++) {
                        for (let j = 0; j < this.hlen; j++) {
                            if (this.initTable[i][j].toLowerCase().includes(val.toLowerCase())) {
                                this.tContent.push(this.initTable[i]);
                                break;
                            }
                        }
                    }

                    this.prevSeach = val;
                }
            }
        },
        computed: {
            resultTable: {
                get() {
                    return this.tContent;
                },
                set(val) {
                    this.tContent = [...val];
                }
            }
        },
    }
</script>
