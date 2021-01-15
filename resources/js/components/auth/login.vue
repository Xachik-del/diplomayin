<template>
    <div class="main-content">
        <div class="container">
            <!--            @if(session('success'))-->
            <!--            <div class="alert alert-success">-->
            <!--                {{session('success')}}-->

            <!--            </div>-->
            <!--            @endif-->
            <div class="row">
                <div class="col-md-8">

                    <div class="leave-comment mr0">

                        <!--                        @if(session('error'))-->
                        <!--                        <div class="alert alert-danger">-->
                        <!--                            {{session('error')}}-->

                        <!--                        </div>-->
                        <!--                        @endif-->
                        <h3 class="text-uppercase">Login</h3>
                        <!--                        @include('admin.errors')-->
                        <br>
                        <div class="form-horizontal contact-form">
                            <!--                            {{csrf_field()}}-->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input v-model="login_data.email" type="text" class="form-control" id="email" name="email" placeholder="Email" @blur="ValidateEmail">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input v-model="login_data.password" type="password" class="form-control" id="password" name="password"
                                           placeholder="password" @blur="ValidatePassword">
                                </div>
                            </div>
                            <button class="btn send-btn" @click="login">Login</button>

                        </div>
                        <br>
                        <span style="font-size: 25px;font-style: italic">Login with</span>
                        <br>
                        <br>
                        <router-link to="" title="GitHub">
                            <i class="fab fa-github-square" style="font-size: 30px;margin-right: 15px"></i>
                        </router-link>
                        <router-link to="" title="Facebook">
                            <i class="fab fa-facebook" style="font-size: 30px; margin-right: 15px"></i>
                        </router-link>
                        <router-link to="" title="Google">
                            <i class="fab fa-google" style="font-size: 30px;margin-right: 15px"></i>
                        </router-link>
                        <router-link to="" title="Twitter">
                            <i class="fab fa-twitter" style="font-size: 30px;margin-right: 15px"></i>
                        </router-link>
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
        name: "login",
        components: {
            Sidebar
        },
        data() {
            return {
                login_data: {
                    email: '',
                    password: ''
                },
                errors: {
                    email : '',
                    password : '',
                    response_errors: null
                }
            }
        },
        methods: {
            login() {
                if (this.validForm()){
                    axios.post('/login', this.login_data).then(({data}) => {
                        if (data.success){
                            this.$store.commit("setLoggedIn", true);
                            this.$router.push({name: 'home'})
                        }else{
                            this.errors.response_errors = data.errors;
                        }
                    })
                }
            },
            /**
             * @return {boolean}
             */
            ValidatePassword() {
                if(!this.login_data.password.length){
                    this.errors.password = "Please enter your name";
                    return false;
                }else if(this.login_data.password.length < 6) {
                    this.errors.password = "Password must be at least 8 characters";
                    return false
                } else{
                    this.errors.password = null;
                    return true;
                }
            },
            /**
             * @return {boolean}
             */
            validForm(){
                return this.ValidateEmail() && this.ValidatePassword();
            },
            /**
             * @return {boolean}
             */
            ValidateEmail() {
                if (/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(this.login_data.email)) {
                    this.errors.email = '';
                    return true;
                }
                this.errors.email = 'You have entered an invalid email address!';
                return false;
            },
        }
    }
</script>

<style scoped>

</style>
