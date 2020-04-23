<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">Quiz Information</div>

                <div class="card-body">
                    <form action="#/" method="POST" id="qForm">
                        <input type="hidden" name="_token" :value="this.token">
                        <input type="hidden" name="qData" id="qData">
                        <div class="row mb-3">
                            <div class="col-md">
                                Date:
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="col-md">
                                Starting Time:
                                <input type="time" name="start" class="form-control">
                            </div>
                            <div class="col-md">
                                Ending Time:
                                <input type="time" name="end" class="form-control">
                            </div>
                            <div class="col-md-2">
                                Lab Section:
                                <select name="section" class="form-control">
                                    <option value="">Select Section</option>
                                    <option v-for="(section, index) in this.sections" :key="index" :value="index + 1">{{ index }}</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div v-for="(obj, index) in classes" :key="index">
                        <div class="row mb-3 border card-rounded mx-1">
                            <div class="col-md-12 body-bg card-rounded">
                                <h5 class="border-bottom py-3">Questions {{ index + 1 }} Class <span class="q-cancel-sm q-class-close btn-dark px-2" @click="removeClass(index)"></span></h5>
                                <div class="row mb-3">
                                    <div class="col-md">
                                        Difficulty Range:
                                        <input type="text" name="difficulty" class="form-control" @keyup="updateDiff(index, $event)" :value="obj.diff" placeholder="2 - 5">
                                    </div>
                                    <div class="col-md">
                                        No. of Questions:
                                        <input type="number" name="no_questions" class="form-control" placeholder="3" @keyup="updateQNo(index, $event)" :value="obj.qNo" step="1" min="1">
                                    </div>
                                    <!-- <div class="col-md">
                                        Points:
                                        <input type="number" name="points" class="form-control" placeholder="5.25" @keyup="updatePoints(index, $event)" :value="obj.points" step="0.25" min="0">
                                    </div> -->
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-7">
                                        <h6 class="border-bottom">All Tags</h6>
                                        <div class="row">
                                            <div class="col-md-12 tags-cont">
                                                <div class="p-2 m-1 tag label-info float-left rounded" @click="selectTag(index, rIndex)" v-for="(tag, rIndex) in obj.allTags" :key="rIndex">
                                                    <span v-if="tag != undefined && tag != null">{{ tag }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <h6 class="border-bottom">Selected Tags</h6>
                                        <div class="row mb-2">
                                            <div class="col-md-12 tags-cont">
                                                <div class="p-2 m-1 tag label-info float-left rounded" @click="unselectTag(index, sIndex)" v-for="(tag, sIndex) in obj.tags" :key="sIndex">
                                                    <span v-if="tag != undefined && tag != null">{{ tag }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <span class="q-add-lg btn-dark" @click="addClass()"></span>
                            <span class="q-tick-lg btn-secondary" @click="submitData()"></span>
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
            this.sections = JSON.parse(this.labsections);
            this.sTags = JSON.parse(this.systemtags);
            this.qClasses[0].allTags = Object.assign({}, this.sTags);
            this.qClasses[0].tags = new Object;
        },
        props: ['systemtags', 'labsections', 'token'],
        data() {
            return {
                sections: [],
                sTags: new Object(),
                qClasses: [
                    {
                        diffTag: false,
                        allTags: [],
                        tags: [],
                        diff: '',
                        qNo: null,
                        points: null,
                    },
                ],
            }
        },
        methods: {
            addClass() {
                this.qClasses.push(
                    {
                        diffTag: false,
                        allTags: Object.assign({}, this.sTags),
                        tags: new Object,
                        diff: '',
                        qNo: null,
                        points: null,
                    },
                );
            },
            removeClass(index) {
                this.qClasses.splice(index, 1);
            },
            updateDiff(index, el) {
                this.qClasses[index].diff = el.target.value;
            },
            updateQNo(index, el) {
                this.qClasses[index].qNo = el.target.value;
            },
            updatePoints(index, el) {
                this.qClasses[index].points = el.target.value;
            },
            selectTag(index, rIndex) {
                this.qClasses[index].tags[rIndex] = this.qClasses[index].allTags[rIndex];
                delete this.qClasses[index].allTags[rIndex];
                this.qClasses.diffTag = !this.qClasses.diffTag;
                this.$forceUpdate();
            },
            unselectTag(index, sIndex) {
                this.qClasses[index].allTags[sIndex] = this.qClasses[index].tags[sIndex];
                delete this.qClasses[index].tags[sIndex];
                this.qClasses.diffTag = !this.qClasses.diffTag;
                this.$forceUpdate();
            },
            submitData() {
                document.getElementById('qData').value = JSON.stringify(this.qClasses);
                document.getElementById('qForm').submit();
            }
        },
        computed: {
            classes: {
                get() {
                    return this.qClasses;
                },
                set(val) {
                    this.qClasses = [...val];
                }
            },
            rejectedTags: {
                get() {
                    
                }
            }
        }
    }
</script>
