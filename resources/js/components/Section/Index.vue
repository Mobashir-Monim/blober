<template>
    <div class="row">
        <div class="col-md-12">
            <div class=" card text-center mb-3 text-muted card-rounded">
                <div class="card-body h4 my-0">All Sections</div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 mb-2" v-for="(section, index) in sectionData" :key="index">
                    <div class="card mb-3 text-muted card-rounded">
                        <div class="card-body card-rounded">
                            <h5 class="card-title border-bottom">Section {{ section.section }}</h5>
                            <div class="row mb-2">
                                <div class="col-md-6 h6" v-for="(instructor, i) in section.instructors" :key="i">{{ instructor }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right" style="font-size: 0.8em">
                                    <a href="#/" class="pr-5 text-primary" @click="viewSection(index)">View Section</a>
                                    {{ section.students.length }} Students
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="hidden" id="modal-btn" data-toggle="modal" data-target=".bd-example-modal-xl"></button>
            
            <div class="modal fade bd-example-modal-xl text-muted" id="mod" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content card-rounded">
                        <div class="modal-header bg-dark text-white card-rounded-top">
                            <h5 class="modal-title" id="exampleModalLabel">Section {{ sectionData[current].section }}</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-white">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-12 mb-2">Instructors</div>
                                <div class="col-md-6 h6" v-for="(instructor, i) in sectionData[current].instructors" :key="i">{{ instructor }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6 mb-2" v-for="(student, i) in sectionData[current].students" :key="i">
                                    <div class="card card-rounded" @click="openProfile(student.dashboard)">
                                        <div class="card-body card-rounded body-bg-hoverable">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6 class="border-bottom mb-0">{{ student.name }}</h6>
                                                    ID: {{ student.sid }}
                                                    <div class="text-right">Points: {{ student.points }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row mb-2 border-bottom" v-for="(student, i) in sectionData[section].students" :key="i">
                                <div class="col-md-3">{{ student.sid }}</div>
                                <div class="col-md-5">{{ student.name }}</div>
                                <div class="col-md-2">{{ student.points }}</div>
                                <div class="col-md-2"><a :href="student.dashboard" target="_blank" class="pr-5 text-primary">View Profile</a></div>
                            </div> -->
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
            this.sections = JSON.parse(this.allsections);
        },
        props:['allsections'],
        data() {
            return {
                sections: [],
                selected: 0,
            }
        },
        methods: {
            viewSection(index) {
                this.selected = index;
                document.getElementById('modal-btn').click();
            },
            openProfile(link) {
                window.open(link, '_blank')
            }
        },
        computed: {
            sectionData: {
                get() {
                    return this.sections;
                },
                set() {

                }
            },
            current: {
                get() {
                    // console.log(this.sections[this.selected]);
                    return this.selected;
                },
                set() {

                }
            }
        }
    }
</script>