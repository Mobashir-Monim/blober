<template>
    <div class="card">
        <div class="card-header">Edit Query</div>

        <div class="card-body">
            <form :action="this.route" id="query-form" method="POST">
                <input type="hidden" name="_token" :value="this.token">
                
                <div class="row mb-2">
                    <div class="col-md-12">
                        Query Question:
                        <textarea name="question" class="editor" cols="30" rows="10" :value="editQuery.question"></textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div id="correct-query">
                            {{ selectedType == 'query' ? 'Correct Query' : 'Query Output' }}:
                        </div>
                        <input type="hidden" name="output" id="output">
                        <textarea name="result" class="editor" cols="30" rows="10" id="result" :value="editQuery.query == null ? editQuery.output : editQuery.query"></textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">
                        Result Entry: <br>
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons" v-if="selectedType == 'query'">
                            <label class="btn btn-dark active" @click="changeResultType('query')">
                                <input type="radio" name="result_type" value="query" autocomplete="off" checked> Enter Query
                            </label>
                            <label class="btn btn-dark" @click="changeResultType('output')">
                                <input type="radio" name="result_type" value="output" autocomplete="off"> Enter Output
                            </label>
                        </div>
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons" v-else>
                            <label class="btn btn-dark" @click="changeResultType('query')">
                                <input type="radio" name="result_type" value="query" autocomplete="off"> Enter Query
                            </label>
                            <label class="btn btn-dark active" @click="changeResultType('output')">
                                <input type="radio" name="result_type" value="output" autocomplete="off" checked> Enter Output
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        Query Type: <br>
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons" v-if="editQuery.is_quiz_query == 1">
                            <label class="btn btn-dark active">
                                <input type="radio" name="query_type" value="1" autocomplete="off" checked> Quiz Query
                            </label>
                            <label class="btn btn-dark">
                                <input type="radio" name="query_type" value="0" autocomplete="off"> Practice Query
                            </label>
                        </div>
                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons" v-else>
                            <label class="btn btn-dark">
                                <input type="radio" name="query_type" value="1" autocomplete="off"> Quiz Query
                            </label>
                            <label class="btn btn-dark active">
                                <input type="radio" name="query_type" value="0" autocomplete="off" checked> Practice Query
                            </label>
                        </div>
                    </div>
                    <div class="col-md">
                        Difficulty:
                        <select name="difficulty" class="form-control">
                            <option :value="editQuery.difficulty">{{ editQuery.difficulty }}</option>
                            <option v-for="(difficulty, index) in levels" :key="index" :value="difficulty">{{ difficulty }}</option>
                        </select>
                    </div>
                    <div class="col-md">
                        Time Limit (minutes):
                        <input type="number" name="time" class="form-control" placeholder="Time Limit (minutes)" :value="editQuery.time">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4">
                        Points:
                        <input type="number" name="points" class="form-control" placeholder="Points" :value="editQuery.points">
                    </div>
                    <div class="col-md-4">
                        Deductible:
                        <input type="number" name="dedeductible" class="form-control" placeholder="Deductible" :value="editQuery.dedeductible">
                    </div>
                    <div class="col-md-4">
                        Data Pool:
                        <select name="data_pool_id" class="form-control">
                            <option :value="editQuery.data_pool_id">{{ this.poolname }}</option>
                            <option v-for="(pool, index) in dataPools" :key="index" :value="index">{{ pool }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        Tags: <br>
                        <input type="text" data-role="tagsinput" id="tags-inp" :value="this.ctags">
                        <input type="hidden" name="tags" id="tags">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="#/" class="btn btn-dark w-100" @click="objectifyOutput()">Submit</a>
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
            this.query = JSON.parse(this.qpool);
            this.resultType = this.query.query == null ? 'output' : 'query';
            console.log(this.resultType);
            let textFields = document.getElementsByClassName('editor');

            for (let i = 0; i < textFields.length; i++) {
                ClassicEditor
                    .create( textFields[i] )
                    .then( editor => {
                        // console.log( 'Done' );
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }
        },

        props: ['token', 'route', 'difficulties', 'pools', 'querytags', 'qpool', 'poolname', 'ctags'],

        data() {
            return {
                levels: [],
                dataPools: [],
                resultType: '',
                tags: [],
                query: {},
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
            },
            editQuery: {
                get() {
                    return this.query;
                },
                set() {
                    
                }
            }
        }
    }
</script>
