<template>
    <div class="">
        <div class=" card text-center mb-3 text-muted" style="border-radius: 20px">
            <div class="card-body h4 my-0">All Quizzes</div>
        </div>
        <div class="card mb-3 text-muted" style="border-radius: 25px" :id="'quiz-' + quiz.id" v-for="(quiz, index) in list" :key="index">
            <div class="card-body">
                <h5 class="card-title border-bottom">Section: {{ quiz.section }}</h5>
                <div class="row mb-3" style="font-size: 0.9em">
                    <div class="col-md-6">
                        <div class="row border-bottom pt-2 ml-1">
                            <div class="col-md-6">Total Questions:</div>
                            <div class="col-md-6 text-right">{{ quiz.qCount }}</div>
                        </div>
                        <div class="row border-bottom pt-2 ml-1">
                            <div class="col-md-6">Total Groups:</div>
                            <div class="col-md-6 text-right">{{ quiz.gCount }}</div>
                        </div>
                        <div class="row border-bottom pt-2 ml-1">
                            <div class="col-md-6">Duration:</div>
                            <div class="col-md-6 text-right">{{ quiz.duration }}</div>
                        </div>
                        <div class="row border-bottom pt-2 ml-1">
                            <div class="col-md-6">Start Time:</div>
                            <div class="col-md-6 text-right">{{ quiz.start }}</div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-auto text-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div style="font-size: 0.8em; margin-bottom: -3px;">Created</div>
                                    <i>{{ quiz.creator }}</i>
                                    <div style="font-size: 0.8em; margin-bottom: -3px;">Last Updated</div>
                                    <i>{{ quiz.updator }}</i>
                                </div>
                                <a href="#/" class="pl-5 text-primary" @click="viewQuiz(quiz.id)">View Quiz</a>
                                <a :href="'/quiz/' + quiz.id + '/edit'" target="_blank" class="pl-5 text-secondary" v-if="quiz.edit">Edit Quiz</a>
                                <a href="#/" @click="deleteQuiz(quiz.id)" v-if="quiz.delete" class="pl-5 text-danger">Delete Quiz</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="hidden" id="modal-btn" data-toggle="modal" data-target=".bd-example-modal-xl"></button>

        <div class="modal fade bd-example-modal-xl text-muted" id="mod" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" style="font-size: 0.9em">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Section {{ quiz_data.section }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="row border-bottom pt-2 ml-1">
                                    <div class="col-md-6">Total Questions:</div>
                                    <div class="col-md-6 text-right">{{ quiz_data.qCount }}</div>
                                </div>
                                <div class="row border-bottom pt-2 ml-1">
                                    <div class="col-md-6">Total Groups:</div>
                                    <div class="col-md-6 text-right">{{ quiz_data.gCount }}</div>
                                </div>
                                <div class="row border-bottom pt-2 ml-1">
                                    <div class="col-md-6">Duration:</div>
                                    <div class="col-md-6 text-right">{{ quiz_data.duration }}</div>
                                </div>
                                <div class="row border-bottom pt-2 ml-1">
                                    <div class="col-md-6">Start Time:</div>
                                    <div class="col-md-6 text-right">{{ quiz_data.start }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-auto text-right">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div style="font-size: 0.8em; margin-bottom: -3px;">Created</div>
                                            <i>{{ quiz_data.creator }}</i>
                                            <div style="font-size: 0.8em; margin-bottom: -3px;">Last Updated</div>
                                            <i>{{ quiz_data.updator }}</i>
                                        </div>
                                        <a :href="'/quiz/' + quiz.id + '/edit'" target="_blank" class="pl-5 text-secondary" v-if="quiz_data.edit">Edit Quiz</a>
                                        <a href="#/" @click="deleteQuiz(quiz_data.id)" v-if="quiz_data.delete" class="pl-5 text-danger">Delete Quiz</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-rounded text-muted mb-2" v-for="(deet, index) in quiz_data.details" :key="index">
                            <div class="card-body bg-grey">
                                <div class="row">
                                    <div class="col-md-4 my-auto">
                                        <div class="row border-bottom">
                                            <div class="col-md-6">
                                                Difficulty Range:
                                            </div>
                                            <div class="col-md-6 text-right">
                                                {{ deet.diff }}
                                            </div>
                                        </div>
                                        <div class="row border-bottom mt-2">
                                            <div class="col-md-6">
                                                Number of Questions:
                                            </div>
                                            <div class="col-md-6 text-right">
                                                {{ deet.qNo }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 my-auto text-center">
                                        <div class="p-2 m-1 tag label-info float-left rounded" v-for="(tag, rIndex) in deet.tags" :key="rIndex">
                                            <span v-if="tag != undefined && tag != null">{{ tag }}</span>
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
            this.quizzes = JSON.parse(this.qlist);
        },
        props:['sessioncode', 'qlist'],
        data() {
            return {
                quizzes: [],
                quiz_details: null,
            }
        },
        methods: {
            deleteQuiz(id) {
                (async () => {
                    const rawResponse = await fetch('/api/quiz/' + id + '/delete', {
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
                    alert(res.message);

                    if (res.success) {
                        document.getElementById('quiz-'+id).remove();
                    }
                })();
            },
            viewQuiz(id) {
                this.quiz_details = null;

                (async () => {
                    const rawResponse = await fetch('/api/quiz/' + id + '/show', {
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

                    if (res.success) {
                        this.quiz_details = res.data;
                    } else {
                        alert('Data could not be loaded, please try again');
                    }
                })();

                document.getElementById('modal-btn').click();
            },
        },
        computed: {
            list: {
                get() {
                    return this.quizzes;
                },
                set(val) {
                    this.quizzes = val;
                }
            },
            quiz_data: {
                get() {
                    return this.quiz_details == null ? false : this.quiz_details;
                },
                set(val) {
                    this.quiz_details = val;
                }
            }
        }
    }
</script>
