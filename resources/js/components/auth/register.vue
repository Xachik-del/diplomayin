<template>
    <div class="main-content">
        <div class="container">

            <div class="row">
                <div class="alert alert-danger alert-dismissable show" v-if="errors.response_errors" role="alert">
                    <div v-for="error in errors.response_errors">
                        <small v-if="error">
                            {{ error[0] }}
                        </small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>
                <div class="col-md-8">

                    <div class="leave-comment mr0">
                        <!--leave comment-->

                        <h3 class="text-uppercase">Register</h3>
                        <!--                        @include('admin.errors')-->
                        <br>
                        <div class="form-horizontal contact-form">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input v-model="register_data.full_name" type="text" class="form-control" id="name" name="name"
                                           placeholder="Name" @blur="ValidateName">
                                    <small v-if="errors.full_name" class="alert--error text-danger" role="alert">
                                        {{ errors.full_name }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input v-model="register_data.email" type="text" class="form-control" id="email" name="email"
                                           placeholder="Email" @blur="ValidateEmail">
                                    <small v-if="errors.email" class="alert--error text-danger" role="alert">
                                        {{ errors.email }}
                                    </small>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <input v-model="register_data.city" type="text" class="form-control" id="city" name="city" placeholder="City">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input v-model="register_data.password" type="password" class="form-control" id="password" name="password"
                                           placeholder="password" @blur="ValidatePassword">
                                    <small v-if="errors.password" class="alert--error text-danger" role="alert">
                                        {{ errors.password }}
                                    </small>
                                </div>
                            </div>

                            <input type="hidden" name="is_admin" value="0">
                        </div>
                        <button class="btn send-btn" @click="register">Register</button>

                    </div>
                    <!--end leave comment-->
                </div>
                <Sidebar/>
            </div>
        </div>
    </div>
</template>

<script>
    import Sidebar from "../pages/sidebar"

    export default {
        name: "register",
        components: {
            Sidebar
        },
        data() {
            return {
                register_data: {
                    full_name: '',
                    email: '',
                    city: '',
                    password: ''
                },
                errors: {
                    email : '',
                    full_name : '',
                    password : '',
                    response_errors: null
                }
            }
        },
        methods: {
            register() {
                if (this.validForm()){
                    axios.post('/register', this.register_data).then(({data}) => {
                        console.log(data);
                            if (data.success) {
                                this.$router.push({name: 'login'});
                            } else {
                                this.errors.response_errors = data.errors;
                            }
                    })
                }
            },
            /**
             * @return {boolean}
             */
            validForm(){
                return this.ValidateEmail() && this.ValidatePassword() && this.ValidateName();
            },
            /**
             * @return {boolean}
             */
            ValidateEmail() {
                if (/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(this.register_data.email)) {
                    this.errors.email = '';
                    return true;
                }
                this.errors.email = 'You have entered an invalid email address!';
                return false;
            },
            /**
             * @return {boolean}
             */
            ValidateName() {
                if (!this.register_data.full_name.length) {
                    this.errors.full_name = "Please enter your name";
                    return false;
                } else if (this.register_data.full_name.length < 6) {
                    this.errors.full_name = "Name must be at least 8 characters";
                    return false;
                } else {
                    this.errors.full_name = null;
                    return true;
                }
            },
            /**
             * @return {boolean}
             */
            ValidatePassword() {
                if(!this.register_data.password.length){
                    this.errors.password = "Please enter your name";
                    return false;
                }else if(this.register_data.password.length < 6) {
                    this.errors.password = "Password must be at least 8 characters";
                    return false
                } else{
                    this.errors.password = null;
                    return true;
                }
            },
        }
    }
</script>

<style scoped>

</style>
