<template>
<header>
    <nav class="navbar">
        <router-link to="/"><h1>Find A Coach</h1></router-link>
        <div class="navbar-brand">
            <ul>
                <li>
                    <router-link to="/auth">Login</router-link>
                </li>
                <li>
                    <router-link to="/messages">Messages</router-link>
                </li>
            </ul>
        </div>
    </nav>
</header>
</template>

<script>
export default {
    name: "Navbar"
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

 li a {
     color: white;
 }


</style>
