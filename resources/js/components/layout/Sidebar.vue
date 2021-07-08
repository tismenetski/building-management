<template>
        <div class="sidebar">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="/finances"><i class="fas fa-hand-holding-usd"></i> Finances</a>
            </li>
            <li class="list-group-item">
                <a href="/news"><i class="fas fa-rss-square"></i> News</a>
            </li>
            <li class="list-group-item">
                <a href="/requests"><i class="fas fa-hands-helping"></i> Requests</a>
            </li>
            <li class="list-group-item">
                <a href="/events"><i class="fas fa-calendar-alt"></i> Events</a>
            </li>
            <li class="list-group-item">
                <a href="/pictures"><i class="fas fa-camera-retro"></i> Pictures</a>
            </li>
            <li class="list-group-item">
                <a href="/cameras"><i class="fas fa-video"></i> Cameras</a>
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
        /*display: inline-block;*/
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
        width : 12vw;
        padding: 20px;
        list-style: none;
    }
    .list-group-item > a {
        display: flex;
        text-decoration: none;
        font-size: 30px;
        color: #fff;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }
    .list-group-item > a > i {
        margin-right: 20px;
    }

</style>
