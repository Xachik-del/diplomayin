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
                        <label for="category">Category</label><br>
                        <select name="" id="category" v-model="data.category_id">
                            <option value="" v-for="category in categories" :key="category.id" :value="category.id">{{ category.title }}</option>
                        </select>
                        <hr>
                        <label for="is_published">Published</label><br>
                        <input type="checkbox" id="is_published" v-model="data.is_published">
                        <hr>
                        <label for="image">Add Image</label><br>
                        <input type="file" id="image" name="image" multiple>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal" @click="save">Save changes</button>
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
                    id: null,
                    is_published: 0,
                    title: null,
                    description: null,
                    file: null,
                    category_id: null
                },
                categories: null
            }
        },
        mounted() {
            if (this.post) {
                this.data.id = this.post.id;
                this.data.title = this.post.title;
                this.data.description = this.post.content;
                this.data.category_id = this.post.category_id;
                this.data.is_published = this.post.is_published;
            }
            this.getCategories();
        },
        methods: {
            save() {
                this.$store.commit('setPreloader', true);
                axios.post(this.$store.getters.getBasePath + '/api/posts', this.data).then(({data}) => {
                    if (data.success) {
                        alertify.success(this.action === 'create' ? 'New Post Added' : 'Post updated successfully', '5');
                        this.$store.commit('setPreloader', false);
                        this.closeModal(data.post);
                    }
                }).catch((error) => {
                    this.$store.commit('setPreloader', false);
                    alertify.error(error, '5')
                });
            },
            getCategories() {
                this.$store.commit('setPreloader', true);
                axios.get(this.$store.getters.getBasePath + '/api/categories').then(({data}) => {
                    this.categories = data.categories;
                    this.$store.commit('setPreloader', false);
                });
            },
            closeModal(new_post = null) {
                this.data = {
                    title: null,
                    description: null,
                    file: null
                };
                this.$emit('close', new_post);
            }
        },
    }
</script>

<style scoped>

</style>
