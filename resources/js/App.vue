<template>
    <div>
        <Navbar/>
        <transition>
            <router-view></router-view>
        </transition>
        <MyFooter/>
        <preloader></preloader>
    </div>
</template>

<script>
    import Navbar from "./components/layouts/navbar";
    import MyFooter from "./components/layouts/footer";
    import Preloader from "./components/Preloader";

    export default {
        name: "App",
        components: {Navbar, MyFooter, Preloader}
    }
</script>

<style scoped>
</style>
