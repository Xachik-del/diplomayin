<template>
    <nav class="navbar main-menu navbar-default">
        <div class="container">
            <div class="menu-content">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <router-link class="navbar-brand" to="/home"><img src="/img/new-logo.png" alt=""></router-link>
                </div>


                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav text-uppercase pull-right" v-if="this.$store.getters.isLoggedIn">

                        <li>
                            <router-link to="/profile">My profile</router-link>
                        </li>
                        <li>
                            <router-link to="/friends">Friends</router-link>
                        </li>
                        <li>
                            <router-link :to="{name: 'user_posts'}">My Posts</router-link>
                        </li>
                        <li><a href="" @click.prevent="logout">Logout</a></li>
                    </ul>
                    <ul class="nav navbar-nav text-uppercase pull-right" v-else>
                        <li>
                            <router-link to="/sign-up">Register</router-link>
                        </li>
                        <li>
                            <router-link to="/enter">Login</router-link>
                        </li>
                    </ul>

                </div>
                <!-- /.navbar-collapse -->


                <div class="show-search">
                    <form role="search" method="get" id="searchform" action="#">
                        <div>
                            <input type="text" placeholder="Search and hit enter..." name="s" id="s">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
</template>

<script>
    export default {
        name: "navbar",
        created() {
        },
        methods: {
            clearStorage() {
                this.$store.commit("setLoggedIn", false);
                this.$store.commit("setUser", null);
                this.$router.push({name: "login"});
            },
            logout() {
                axios.post('/logout').then(({data}) => {
                    alertify.notify(data.message, 'success', '5')
                    this.clearStorage();
                }).catch((error) => {
                    alertify.notify("Failed to log out" + error, 'danger', '5')
                    this.clearStorage();
                })
            }
        }
    }
</script>

<style scoped>

</style>
