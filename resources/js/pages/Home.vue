<template>
    <section v-if="isLoggedIn">
        <h1>Hello World</h1>
    </section>

</template>

<script>
export default {
    name: "Home",
    data() {
        return {


        }
    },
    computed : {
        isLoggedIn() {
            console.log(this.$store.getters.isAuthenticated);
            return this.$store.getters.isAuthenticated;
        }
    }
}
</script>

<style scoped>

</style>
