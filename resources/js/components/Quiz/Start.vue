<template>
    <div class="row">
        <div class="col-md-3">
            <div class="card sidenav">
                <div class="card-header">Quiz Nav</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h3 class="text-center">
                                <span id="hours">0</span> : <span id="minutes">0</span> : <span id="seconds">0</span>
                            </h3>
                            <div class="text-center">Time Remaining</div>
                            <div class="row mt-3">
                                <div class="col-md-4 text-center p-2" v-for="(q, qid) in quesIDs" :key="qid" @click="getQuestion(qid)">
                                    <div class="question-tab rounded p-2" v-if="qid != currentQIndex">{{ qid + 1 }}</div>
                                    <div class="selected-question-tab rounded p-2" v-else>{{ qid + 1 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Quiz Panel</div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h3 class="border-bottom">Question</h3>
                            <p v-html="allQuestions[currentQIndex]['question']"></p>
                            <span class="block-inline"></span>

                            <div class="row mb-3">
                                <div class="col-md-12 text-right"><strong>({{ allQuestions[currentQIndex]['points'] }})</strong></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h3 class="border-bottom">Tables</h3>
                            <div v-for="(table, index) in allTables[currentQIndex]" :key="index">
                                <h5 class="text-center">Table Name: {{ allNames[currentQIndex][index] }}</h5>
                                <table class="table table-sm table-striped">
                                    <caption>Table Name: {{ allNames[currentQIndex][index] }}</caption>
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
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h3 class="border-bottom">Desired Output</h3>
                            <div v-if="true">
                                <table class="table table-sm table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="border px-3 py-1" scope="col" v-for="(head, headIndex) in Object.keys(JSON.parse(allQuestions[currentQIndex].output)[0])" :key="headIndex"><strong>{{ head }}</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in JSON.parse(allQuestions[currentQIndex].output)" :key="index">
                                            <td class="border px-3 py-1" v-for="(col, colIndex) in row" :key="colIndex">{{ col }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                {{  }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h3 class="border-bottom">Query Output</h3>
                            <div v-if="false">
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
                                <!-- {{ error }} -->
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
                            <a href="#/" class="btn btn-secondary w-100" @click="prevQuestion()"><i class="fa fas fa-caret-left"></i><i class="fa fas fa-caret-left mr-2"></i>Prev Question</a>
                        </div>
                        <div class="col-md">
                            <a href="#/" class="btn btn-success w-100">Submit answer</a>
                        </div>
                        <div class="col-md">
                            <a href="#/" class="btn btn-secondary w-100" @click="nextQuestion()">Next Question<i class="fa fas fa-caret-right ml-2"></i><i class="fa fas fa-caret-right"></i></a>
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
            this.questionsID = JSON.parse(this.qids);
            this.qlist = JSON.parse(this.questionslist);
            this.arrayOfTables = JSON.parse(this.tablelist);
            this.tnames = JSON.parse(this.names);
            this.time = this.settime;
            
            window.onload = () => {
                this.secs = document.getElementById('seconds');
                this.mins = document.getElementById('minutes');
                this.hours = document.getElementById('hours');

                setTimeout(() => {
                    this.decrementTime();
                }, 1000);
            }
        },
        props: ['qids', 'questionslist', 'tablelist', 'names', 'settime'],
        data() {
            return {
                questionsID: [],
                qlist: [],
                arrayOfTables: [],
                selectedQuestion: 0,
                tnames: [],
                qOutput: null,
                time: 0,
                secs: null,
                mins: null,
                hours: null,
            }
        },
        methods: {
            nextQuestion() {
                if (this.selectedQuestion + 1 <= this.questionsID.length) {
                    this.getQuestion(this.selectedQuestion + 1);
                }
            },
            prevQuestion() {
                if (this.selectedQuestion - 1 >= 0) {
                    this.getQuestion(this.selectedQuestion - 1);
                }
            },
            getQuestion(index) {
                this.selectedQuestion = index;
            },
            decrementTime() {
                if (this.time > 0) {
                    this.hours.innerText = parseInt(this.time / 3600);
                    this.mins.innerText = parseInt((this.time % 3600) / 60);
                    this.secs.innerText = this.time == 0 ? 0 : this.time % 60;
                    this.time--;

                    setTimeout(() => {
                        this.decrementTime(); 
                    }, 1000);
                } else {
                    // let x = confirm('Quiz time is over. Answers will no longer be accepted!');
                    this.time = 0;
                    this.secs.innerText = 0;
                }
            }
        },
        computed: {
            quesIDs: {
                get() {
                    return this.questionsID;
                },
                set(val) {
                    this.questionsID = val;
                }
            },
            currentQIndex: {
                get() {
                    return this.selectedQuestion;
                },
                set(val) {
                    this.selectedQuestion = val;
                }
            },
            allQuestions: {
                get() {
                    return this.qlist;
                },
                set(val) {

                }
            },
            allTables: {
                get() {
                    return this.arrayOfTables;
                },
                set(val) {

                }
            },
            allNames: {
                get() {
                    return this.tnames;
                },
                set(val) {
                    
                }
            }
        },
    }
</script>
