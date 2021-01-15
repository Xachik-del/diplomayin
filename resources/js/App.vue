<template>
    <div>
        <Navbar/>
        <transition>
            <router-view></router-view>
        </transition>
        <MyFooter/>
    </div>
</template>

<script>
    import Navbar from "./components/layouts/navbar";
    import MyFooter from "./components/layouts/footer";

    export default {
        name: "App",
        components: {Navbar, MyFooter}
    }
</script>

<style scoped>
</style>
