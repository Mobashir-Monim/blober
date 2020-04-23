<template>
    <form :action="route" method="POST" id="db-inp-form">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="_token" :value="this.token">
                <input type="text" name="dp_name" :value="this.name" class="form-control mb-2" placeholder="Data Pool Name (Database name)">
                <div class="editor">
                    <div v-for="(table, index) in dpTables" :key="index">
                        <p class="tname">{{ index }}</p>
                        <table class="table table-sm table-striped dbts">
                            <tbody>
                                <tr v-for="(row, index) in table" :key="index">
                                    <td class="px-2 border" v-for="(col, colIndex) in row" :key="colIndex">{{ col }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="text-right mt-2">{{ status }}</p>
                <input type="hidden" name="tables" id="tables">
                <input type="hidden" name="tableNames" id="table-names">
                <a href="#/" class="btn btn-dark w-100" @click="makeDBInps()">Submit</a>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {
            this.tables = JSON.parse(this.content);

            ClassicEditor
                .create( document.querySelector( '.editor' ) )
                .then( editor => {
                    // console.log( 'Done' );
                } )
                .catch( error => {
                    console.error( error );
                } );
        },

        props: ['token', 'route', 'content', 'name'],

        data() {
            return {
                currentStatus: 0,
                poolName: '',
                tables: [],
            }
        },

        methods: {
            makeDBInps() {
                this.currentStatus = 1;
                let tables = document.getElementsByClassName('dbts');
                let inpRow = document.getElementById('db-div');
                let ps = document.getElementsByClassName('tname');
                let tableNames = [];
                let output = [];
                console.log(ps);
                console.log(tables);
                
                
                for (let i = 0; i < ps.length; i++) {
                    tableNames.push(ps[i].innerText);
                }
                
                for (let x = 0; x < tables.length; x++) {
                    let table = tables[x];
                    let data = [];
                    let headers = [];
                    
                    for (let i = 0; i < table.rows[0].cells.length; i++) {
                        headers[i] = table.rows[0].cells[i].innerText.toLowerCase();
                    }

                    for (let i = 0; i < table.rows.length; i++) {
                        let tableRow = table.rows[i];
                        let rowData = {};

                        for (let j = 0; j<tableRow.cells.length; j++) {
                            if (i <= 1) {
                                rowData[j] = tableRow.cells[j].innerText.toLowerCase();
                            } else {
                                rowData[j] = tableRow.cells[j].innerText;
                            }
                        }

                        data.push(rowData);
                    }

                    output.push(data);
                }

                document.getElementById('tables').value = JSON.stringify(output);
                document.getElementById('table-names').value = JSON.stringify(tableNames);

                this.currentStatus = 2;

                document.getElementById('db-inp-form').submit();
            },
        },

        computed: {
            status: {
                get() {
                    if (this.currentStatus == 0) {
                        return "Waiting for input submission";
                    } else if (this.currentStatus == 1) {
                        return "Generating table rows and columns";
                    } else {
                        return "Submitting input";
                    }
                },
                set() {

                }
            },
            dpTables: {
                get() {
                    return this.tables;
                },
                set() {

                }
            }
        }
    }
</script>
