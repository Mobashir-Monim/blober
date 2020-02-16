<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">Add Tags</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="tag" id="tag-create" class="form-control" placeholder="Tag Name">
                        </div>
                        <div class="col-md">
                            <a href="#/" class="btn btn-success w-100" @click="addTag()">Add Tag</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Existing Tags</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center my-1" v-for="(tag, index) in tags" :key="index">
                            <div class="py-4 label-info rounded" v-bind:id="'tag-' + index" @dblclick="editTag(index)">{{ tag }}</div>
                            <div v-bind:id="'inp-'+index" class="hidden">
                                <input type="text" name="tag" v-bind:id="'tag-inp-'+index" class="form-control" :value="tag" placeholder="Tag Name">
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <a href="#/" class="btn btn-success w-100" @click="updateTag(index)">Save</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#/" class="btn btn-danger w-100" @click="cancelEdit(index)">Cancel</a>  
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
            this.currentTags = JSON.parse(this.querytags);
        },
        props: ['querytags'],
        data() {
            return {
                currentTags: [],
            }
        },
        methods: {
            addTag() {
                let inp = document.getElementById('tag-create');

                (async () => {
                    const rawResponse = await fetch('/api/tags', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({name: inp.value})
                    });
                    let res = await rawResponse.json();
                    
                    if (res.success) {
                        inp.value = '';
                        this.currentTags = res.data.tags;
                    } else {
                        alert('Sorry, the tag could not be added for some reason :(');
                    }
                })();
            },
            editTag(id) {
                document.getElementById('tag-'+id).classList.add('hidden');
                document.getElementById('inp-'+id).classList.remove('hidden');
            },
            cancelEdit(id) {
                let inp = document.getElementById('inp-'+id);
                let tag = document.getElementById('tag-'+id);
                inp.classList.add('hidden');
                tag.classList.remove('hidden');
                document.getElementById('tag-inp-'+id).value = tags[id];
            },
            updateTag(id) {
                let inp = document.getElementById('tag-inp-'+id);
                let url = '/api/tags/'+id;
                
                (async () => {
                    const rawResponse = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({name: inp.value})
                    });
                    let res = await rawResponse.json();
                    
                    if (res.success) {
                        this.currentTags = res.data.tags;
                        document.getElementById('inp-'+id).classList.add('hidden');
                        document.getElementById('tag-'+id).classList.remove('hidden');
                    } else {
                        alert('Sorry, the tag could not be updated for some reason :(');
                    }
                })();
            }
        },
        computed: {
            tags: {
                get() {
                    return this.currentTags;
                },
            }
        }
    }
</script>
