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
/*:root {*/
/*    --primary-color: #15063A;*/
/*    --secondary-color : #8A7BAF*/
/*}*/
/** {*/
/*    margin: 0;*/
/*    padding: 0;*/
/*    box-sizing: border-box;*/
/*}*/



/*.wrapper {*/
/*    display: flex;*/
/*    !*justify-content: flex-start;*!*/
/*}*/

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

::-webkit-scrollbar {
    display: none;
}

* {
    margin : 0;
    padding : 0;
    box-sizing: border-box;
    font-family : 'Poppins',sans-serif;

}

body {
    min-height: 100vh;
    background: #fff;
    /*background: #150019;*/
    /*overflow: hidden; !* Hide scrollbars *!*/
}

.main {
    width: 80vw;
    margin: 0 auto;
    overflow-y: scroll;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}

/*.main::-webkit-scrollbar {*/
/*    display: none;*/
/*}*/

.navigation {
    margin-top: 60px;
    position : fixed;
    width : 60px;
    height : 100%;
    background: #3e0748;
    transition: 0.5s;
    /*//overflow: hidden;*/

}

.navigation:hover,
.navigation.active{
    width : 300px;
}

.navigation ul {
    position: absolute;
    top : 0;
    left :0;
    width : 100%;
    color : #fff;

}

.navigation ul li {
    position: relative;
    width : 100%;
    list-style: none;
}

.navigation ul li:hover {
    background: #ea1d63;
}
.navigation ul li a {
    position: relative;
    /*display: block;*/
    width: 100%;
    display: flex;
    text-decoration: none;
    color : #fff;
}

.navigation ul li a .icon {

    position: relative;
    display: block;
    min-width: 60px;
    height: 60px;
    line-height: 60px;
    text-align: center;
}

.navigation ul li a .icon .fa {
    font-size: 24px;
}

.navigation ul li a .title {

    position: relative;
    display: block;
    padding : 0 10px;
    height: 60px;
    line-height: 60px;
    text-align: start;
    white-space: nowrap;
}

.toggle {
    position: absolute;
    top: 0;
    right :0;
    width : 60px;
    height: 60px;
    background: #330748;
    cursor : pointer;
    /*margin-top: 60px;*/
    z-index: 2;
}

.toggle.active {
    background: #ea1d63;

}

.toggle:before {

    content : '\f0c9';
    font-family:  fontAwesome,serif;
    position: absolute;
    width: 100%;
    height: 100%;
    line-height: 60px;
    text-align: center;
    font-size: 24px;
    color: #fff;
}

.toggle.active:before {

    content : '\f00d';
}

@media(max-width:767px) {

    .navigation {
        left : -60px;

    }

    .navigation.active {
        left : 0px;
        width: 100%;
    }
}

</style>
