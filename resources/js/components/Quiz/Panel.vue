<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Attempt Query</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="#/" class="btn btn-dark w-75" @click="startQuiz()">Begin Quiz</a>
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
            console.log(this.sessioncode);
        },
        props: ['route', 'time', 'sessioncode'],
        data() {
            return {
                
            }
        },
        methods: {
            startQuiz() {
                let strWindowFeatures = "height=" + screen.availHeight + ",width=" + screen.availWidth + "location=no,menubar=no,scrollbars=no,resizable=no,fullscreen=yes";
                let win = window.open(this.route + '?sessioncode=' + this.sessioncode, "Blober_Quiz", strWindowFeatures);

                win.onload = () => {
                    setTimeout(() => {
                        win.close();
                        win.close();
                    }, this.time * 1000);
                }
            },
        },
    }
</script>
