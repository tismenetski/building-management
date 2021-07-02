<template>
    <navbar></navbar>
    <div class="wrapper">
        <div>
            <sidebar />
        </div>

    <div class="main">
        <router-view /> <!-- Here is your router view -->
    </div>
    </div>
<!--    <div id="app">-->
<!--        <sidebar></sidebar>-->
<!--        <router-view></router-view>-->

<!--    </div>-->

</template>
<script>
const default_layout = "default";
import Navbar from "../components/layout/Navbar";
import Sidebar from "../components/layout/Sidebar";
import TheFooter from "../components/layout/TheFooter";

export default {
    components : {
        TheFooter,
        Navbar,Sidebar
    },
    computed: {},
    data() {
        return {
            message:'Hello World'
        }
    },
    created() {
        this.$store.dispatch('tryLogin');
    }
};
</script>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.main {
    width: 75%;
}

.wrapper {
    display: flex;
    /*justify-content: flex-start;*/
}

</style>
