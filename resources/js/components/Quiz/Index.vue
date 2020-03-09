<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Attempt Query</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="#/" class="btn btn-primary w-75" @click="startQuiz()">Begin Quiz</a>
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
        props: ['route'],
        data() {
            return {
                quizStarted: false,
                currentQuestion: 'N/A',
                currentOutput: '',
                currentPoints: 'N/A',
                currentDeductible: 'N/A',
                currentTime: 'N/A',
                currentTables: [],
                currentNames: [],
                currentError: null,
                queryOutput: null,
                attemptedQuestions: [],
                attemptResult: null,
                attemptStarted: false,
                attemptGroups: [],
            }
        },
        methods: {
            startQuiz() {
                console.log(screen.availWidth, screen.availHeight);
                let strWindowFeatures = "height=" + screen.availHeight + ",width=" + screen.availWidth + "location=no,menubar=no,scrollbars=no,resizable=no,fullscreen=yes";
                window.open(this.route, "Blober_Quiz", strWindowFeatures);
            },
        },
    }
</script>
