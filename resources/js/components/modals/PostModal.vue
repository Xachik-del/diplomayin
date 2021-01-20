<template>
    <transition name="modal">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ this.action === "create" ? "Create Post" : "Update Post"}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="title">Title</label><br>
                        <input type="text" id='title' name="title" v-model="data.title">
                        <hr>
                        <label for="content">Content</label><br>
                        <textarea name="content" id="content" cols="30" rows="10" style="width: 200px;height: 40px;"
                                  v-model="data.description"></textarea>
                        <hr>
                        <label for="image">Add Image</label><br>
                        <input type="file" id="image" name="image" multiple>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" @click="save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </transition>
</template>

<script>

    const toBase64 = file => new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });

    export default {
        name: "PostModal",
        props: ['post', 'action'],
        data() {
            return {
                data: {
                    title: null,
                    description: null,
                    file: null
                }
            }
        },
        mounted() {

        },
        methods: {
            save() {
                axios.post('posts', this.data).then(({data}) => {
                    console.log(data);
                });
            },
            closeModal() {
                this.data = {
                    title: null,
                    description: null,
                    file: null
                };
                console.log(this.data);
                this.$emit('close');
            }
        },
    }
</script>

<style scoped>

</style>
