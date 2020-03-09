<template>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Quiz Panel</div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h3 class="border-bottom">Question</h3>
                            <p v-html="question"></p>

                            <div class="row mb-3">
                                <div class="col-md-4">Points: {{ points }}</div>
                                <div class="col-md-4">Deductible: {{ deductible }}</div>
                                <div class="col-md-4">Time: {{ time }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h3 class="border-bottom">Tables</h3>
                            <div v-if="tables != null">
                                <div v-for="(table, index) in tables" :key="index">
                                    <h5 class="text-center">Table Name: {{ tableNames[index] }}</h5>
                                    <table class="table table-sm table-striped">
                                        <caption>Table Name: {{ tableNames[index] }}</caption>
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="border px-3 py-1" scope="col" v-for="(head, headIndex) in Object.keys(table[0])" :key="headIndex"><strong>{{ head }}</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(row, rowIndex) in table" :key="rowIndex">
                                                <td class="border px-3 py-1" v-for="(col, colIndex) in row" :key="colIndex">{{ col }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div v-else>
                                N/A
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h3 class="border-bottom">Desired Output</h3>
                            <div v-if="output != null">
                                <table class="table table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="border px-3 py-1" scope="col" v-for="(head, headIndex) in Object.keys(output[0])" :key="headIndex"><strong>{{ head }}</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in output" :key="index">
                                            <td class="border px-3 py-1" v-for="(col, colIndex) in row" :key="colIndex">{{ col }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                N/A
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h3 class="border-bottom">Query Output</h3>
                            <div v-if="qOutput != null">
                                <table class="table table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="border px-3 py-1" scope="col" v-for="(head, headIndex) in Object.keys(qOutput[0])" :key="headIndex"><strong>{{ head }}</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in qOutput" :key="index">
                                            <td class="border px-3 py-1" v-for="(col, colIndex) in row" :key="colIndex">{{ col }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                {{ error }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div v-if="result != null">
                                <div class="row text-center alert alert-success push-down" v-if="result == true">
                                    <div class="col-md-12">
                                        Hurry!! You were correct! 
                                    </div>
                                </div>
                                <div class="row text-center alert alert-danger push-down" v-else>
                                    <div class="col-md-12">
                                        Oh no, seems like the query was wrong :'(
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <textarea name="query" class="form-control" cols="30" rows="3" placeholder="Write your query here" id="query"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md">
                            <a href="#/" class="btn btn-secondary w-100"><i class="fa fas fa-caret-left"></i><i class="fa fas fa-caret-left mr-2"></i>Prev Question</a>
                        </div>
                        <div class="col-md">
                            <a href="#/" class="btn btn-success w-100" @click="submitQuery()">Submit answer</a>
                        </div>
                        <div class="col-md">
                            <a href="#/" class="btn btn-secondary w-100">Next Question<i class="fa fas fa-caret-right ml-2"></i><i class="fa fas fa-caret-right"></i></a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Quiz Nav</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h3 class="text-center">
                                <span id="hours">0</span> : <span id="minutes">15</span> : <span id="seconds">30</span>
                            </h3>
                            <div class="text-center">Time Remaining</div>
                            <div class="row mt-3">
                                <div class="col-md-4 text-center py-2">1</div>
                                <div class="col-md-4 text-center py-2">2</div>
                                <div class="col-md-4 text-center py-2">3</div>
                                <div class="col-md-4 text-center py-2">4</div>
                                <div class="col-md-4 text-center py-2">5</div>
                                <div class="col-md-4 rounded text-center py-2 bg-primary">6</div>
                                <div class="col-md-4 text-center py-2">7</div>
                                <div class="col-md-4 text-center py-2">8</div>
                                <div class="col-md-4 text-center py-2">9</div>
                                <div class="col-md-4 text-center py-2">10</div>
                                <div class="col-md-4 text-center py-2">11</div>
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
            
        },
        props: [],
        data() {
            return {

            }
        },
        methods: {

        },
        computed: {

        },
    }
</script>
