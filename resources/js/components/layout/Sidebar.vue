<template>
        <div class="sidebar">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="/finances">Finances</a>
            </li>
            <li class="list-group-item">
                <a href="/news">News</a>
            </li>
            <li class="list-group-item">
                <a href="/requests">Requests</a>
            </li>
            <li class="list-group-item">
                <a href="/events">Events</a>
            </li>
            <li class="list-group-item">
                <a href="/pictures">Pictures</a>
            </li>
            <li class="list-group-item">
                <a href="/cameras">Cameras</a>
            </li>
        </ul>
        </div>
</template>

<script>
export default {
    name: "Sidebar"
}
</script>

<style scoped>
    .sidebar {
        display: inline-block;
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        height: calc(100vh - 50px);
        background-color: #31708E;
        overflow: hidden;
    }

    .list-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }

    .list-group-item {
        padding: 20px;
        list-style: none;
    }
    .list-group-item > a {
        text-decoration: none;
        font-size: 30px;
        color: #fff;
    }

</style>
