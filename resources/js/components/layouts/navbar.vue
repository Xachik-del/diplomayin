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
                    <router-link class="navbar-brand" to="/home"><img src="/img/logo.png" alt=""></router-link>
                </div>


                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav text-uppercase">
                        <li>
                            <router-link to="/" tag="a">Homepage</router-link>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav text-uppercase pull-right" v-if="this.$store.getters.isLoggedIn">

                        <li><router-link to="/profile">My profile</router-link></li>
                        <li><router-link to="/users">All Users</router-link></li>
                        <li><router-link to="/my-posts">My Posts</router-link></li>
                        <li><router-link to="/logout">Logout</router-link></li>
                    </ul>
                    <ul class="nav navbar-nav text-uppercase pull-right" v-else>
                        <li><router-link to="/register">Register</router-link></li>
                        <li><router-link to="/login">Login</router-link></li>
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
            console.log(this.$store.getters.isLoggedIn)
        }
    }
</script>

<style scoped>

</style>
