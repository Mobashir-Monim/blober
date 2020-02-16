<template>
    <div class="card">
        <div class="card-header">Add Query</div>

        <div class="card-body">
            <form :action="this.route" id="query-form" method="POST">
                <input type="hidden" name="_token" :value="this.token">
                
                <div class="row mb-2">
                    <div class="col-md-12">
                        Query Question:
                        <textarea name="question" class="editor" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div id="correct-query">
                            {{ selectedType == 'query' ? 'Correct Query' : 'Query Output' }}:
                        </div>
                        <input type="hidden" name="output" id="output">
                        <textarea name="result" class="editor" cols="30" rows="10" id="result"></textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        Result Entry: <br>
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                            <label class="btn btn-primary active" @click="changeResultType('query')">
                                <input type="radio" name="result_type" value="query" autocomplete="off" checked> Enter Query
                            </label>
                            <label class="btn btn-primary" @click="changeResultType('output')">
                                <input type="radio" name="result_type" value="output" autocomplete="off"> Enter Output
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        Difficulty:
                        <select name="difficulty" class="form-control">
                            <option value="">Difficulty</option>
                            <option v-for="(difficulty, index) in levels" :key="index" :value="difficulty">{{ difficulty }}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        Time Limit (minutes):
                        <input type="number" name="time" class="form-control" placeholder="Time Limit (minutes)">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        Points:
                        <input type="number" name="points" class="form-control" placeholder="Points">
                    </div>
                    <div class="col-md-4">
                        Deductible:
                        <input type="number" name="dedeductible" class="form-control" placeholder="Deductible">
                    </div>
                    <div class="col-md-4">
                        Data Pool:
                        <select name="data_pool_id" class="form-control">
                            <option value="">Data Pool for Query</option>
                            <option v-for="(pool, index) in dataPools" :key="index" :value="index">{{ pool }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        Tags: <br>
                        <input type="text" data-role="tagsinput" id="tags-inp">
                        <input type="hidden" name="tags" id="tags">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="#/" class="btn btn-success w-100" @click="objectifyOutput()">Submit</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.levels = JSON.parse(this.difficulties);
            this.dataPools = JSON.parse(this.pools);
            this.tags = JSON.parse(this.querytags);

            let textFields = document.getElementsByClassName('editor');

            for (let i = 0; i < textFields.length; i++) {
                ClassicEditor
                    .create( textFields[i] )
                    .then( editor => {
                        console.log( 'Done' );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }
        },

        props: ['token', 'route', 'difficulties', 'pools', 'querytags'],

        data() {
            return {
                levels: [],
                dataPools: [],
                resultType: 'query',
                tags: [],
            }
        },

        methods: {
            objectifyOutput() {
                if (this.resultType == 'output') {
                    let tables = document.getElementsByTagName('tbody');
                    let output = [];
                    
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

                    document.getElementById('output').value = JSON.stringify(output);
                }

                $("#tags").val($("#tags-inp").tagsinput('items'));
                document.getElementById('query-form').submit();
            },
            changeResultType(type) {
                this.selectedType = type;
            }
        },

        computed: {
            selectedType: {
                get() {
                    return this.resultType;
                },
                set(value) {
                    this.resultType = value;
                }
            }
        }
    }
</script>
