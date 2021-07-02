<template>
<header>
    <nav class="navbar">
        <router-link to="/"><h1><i class="fas fa-building"></i> Building Management</h1></router-link>
        <div class="navbar-brand">
            <ul v-if="!isLoggedIn">
                <li>
                    <router-link to="/auth">Login</router-link>
                </li>

            </ul>
            <ul v-else>
                <li>
                    <router-link to="/auth" @click="logout">Logout</router-link>
                </li>
                <li>
                    <router-link  to="/messages">Messages</router-link>
                </li>
            </ul>
        </div>
    </nav>
</header>
</template>

<script>
export default {
    name: "Navbar",
    computed: {
        isLoggedIn() {
            return this.$store.getters.isAuthenticated;
        }
    },
    methods: {
        logout() {
            this.$store.dispatch('logout');
            this.$router.replace('/auth');
        }
    }
}
</script>

<style scoped>



 .navbar {
     width: 100%;
     height: 50px;
     background-color: #687864;
     display: flex;
     flex-direction: row;
     justify-content: space-between;
     align-items: center;

 }
 a,a:focus,a:active {
     color: #fff;
 }

 .navbar a {
    text-decoration: none;
     margin-left: 20px;
 }

 .navbar ul {
     list-style: none;
     display: flex;
     flex-direction: row;
     justify-content: space-between;
 }

 li a {
     color: white;
     text-decoration: none;
     padding: 20px;
     margin-left: 20px;
     font-size: 20px;

 }


</style>
