<template>
    <div v-if="display" class="preloader">
        <img :src="'/img/preloader.gif'" alt="">
    </div>
</template>

<script>
    export default {
        name: "Preloader",
        computed: {
            display: function () {
                return this.$store.getters.getPreloader;
            }
        }
    }
</script>

<style scoped>
    .preloader{
        position: fixed;
        width: 100%;
        height: 100vh;
        z-index: 1000000;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(255,255,255,0.8);
    }

    .preloader img{
        width: 40%;
    }
</style>
