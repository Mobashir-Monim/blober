<template>
    <div class="card">
        <div class="card-header">Attempt Query</div>
        <div class="card-body">
            <form :action="this.route" method="POST">
                <input type="hidden" name="_token" :value="this.token">

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
                    <div class="col-md-6">
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
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <a href="#/" class="btn btn-secondary w-100" @click="fetchQuestion()">Attempt another Question</a>
                    </div>
                    <div class="col-md-6">
                        <a href="#/" class="btn btn-success w-100" @click="submitQuery()">Submit answer</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetchQuestion();
        },

        props: ['token', 'route'],

        data() {
            return {
                currentQuestion: '',
                currentOutput: '',
                currentPoints: '',
                currentDeductible: '',
                currentTime: '',
                currentTables: '',
                currentNames: '',
                currentError: null,
                queryOutput: null,
                attemptedQuestions: [],
                attemptResult: null,
            }
        },

        methods: {
            fetchQuestion() {
                (async () => {
                    const rawResponse = await fetch('/api/query/get-question', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({attempted: [...this.attemptedQuestions]})
                    });
                    let res = await rawResponse.json();
                    this.setValues(res.data);
                })();

                document.getElementById('query').value = '';
            },
            setValues(res) {
                    this.attemptedQuestions.push(res.query.id);
                    this.currentQuestion = res.query.question;
                    this.currentPoints = res.query.points;
                    this.currentOutput = JSON.parse(res.query.output);
                    this.currentDeductible = res.query.deductible;
                    this.currentTime = res.query.time;
                    this.currentTables = res.tables;
                    this.currentNames = res.names;
                    this.attemptResult = res.result;
            },
            submitQuery() {
                (async () => {
                    const rawResponse = await fetch('/api/query/submit-query', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({answer: document.getElementById('query').value, question: this.attemptedQuestions[this.attemptedQuestions.length - 1]})
                    });
                    let res = await rawResponse.json();
                    this.attemptResult = res.data.result;
                    this.currentError = res.data.error;
                    this.queryOutput = res.data.output;
                })();
            }
        },

        computed: {
            question: {
                get() {
                    return this.currentQuestion;
                },
                set(value) {
                    this.currentQuestion = value;
                }
            },
            output: {
                get() {
                    return this.currentOutput;
                },
                set(value) {
                    this.currentOutput = value;
                }
            },
            time: {
                get() {
                    return this.currentTime == '' || this.currentTime == null ? 'N/A' : this.currentTime;
                },
                set(value) {
                    this.currentTime = value;
                }
            },
            points: {
                get() {
                    return this.currentPoints == '' || this.currentPoints == null ? 'N/A' : this.currentPoints;
                },
                set(value) {
                    this.currentPoints = value;
                }
            },
            deductible: {
                get() {
                    return this.currentDeductible == '' || this.currentDeductible == null ? 'N/A' : this.currentDeductible;
                },
                set(value) {
                    this.currentDeductible = value;
                }
            },
            tableNames: {
                get() {
                    return this.currentNames == '' ? null : this.currentNames;
                },
                set(value) {
                    this.currentNames = value;
                }
            },
            tables: {
                get() {
                    return this.currentTables == '' ? null : this.currentTables;
                },
                set(value) {
                    this.currentTables = value;
                }
            },
            result: {
                get() {
                    return this.attemptResult;
                },
                set(value) {
                    this.attemptResult = value;
                }
            },
            error: {
                get() {
                    return this.currentError;
                },
                set(value) {
                    this.currentError = value;
                }
            },
            qOutput: {
                get() {
                    return this.queryOutput;
                },
                set(value) {
                    this.queryOutput = value;
                }
            }
        }
    }
</script>
