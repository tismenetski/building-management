<template>
<!--        <div class="sidebar">-->
<!--&lt;!&ndash;        <ul class="list-group">&ndash;&gt;-->
<!--&lt;!&ndash;            <li class="list-group-item">&ndash;&gt;-->
<!--&lt;!&ndash;                <a href="/finances"><i class="fas fa-hand-holding-usd"></i> Finances</a>&ndash;&gt;-->
<!--&lt;!&ndash;            </li>&ndash;&gt;-->
<!--&lt;!&ndash;            <li class="list-group-item">&ndash;&gt;-->
<!--&lt;!&ndash;                <a href="/news"><i class="fas fa-rss-square"></i> News</a>&ndash;&gt;-->
<!--&lt;!&ndash;            </li>&ndash;&gt;-->
<!--&lt;!&ndash;            <li class="list-group-item">&ndash;&gt;-->
<!--&lt;!&ndash;                <a href="/requests"><i class="fas fa-hands-helping"></i> Requests</a>&ndash;&gt;-->
<!--&lt;!&ndash;            </li>&ndash;&gt;-->
<!--&lt;!&ndash;            <li class="list-group-item">&ndash;&gt;-->
<!--&lt;!&ndash;                <a href="/events"><i class="fas fa-calendar-alt"></i> Events</a>&ndash;&gt;-->
<!--&lt;!&ndash;            </li>&ndash;&gt;-->
<!--&lt;!&ndash;            <li class="list-group-item">&ndash;&gt;-->
<!--&lt;!&ndash;                <a href="/pictures"><i class="fas fa-camera-retro"></i> Pictures</a>&ndash;&gt;-->
<!--&lt;!&ndash;            </li>&ndash;&gt;-->
<!--&lt;!&ndash;            <li class="list-group-item">&ndash;&gt;-->
<!--&lt;!&ndash;                <a href="/cameras"><i class="fas fa-video"></i> Cameras</a>&ndash;&gt;-->
<!--&lt;!&ndash;            </li>&ndash;&gt;-->
<!--&lt;!&ndash;        </ul>&ndash;&gt;-->
<!--            <ul>-->
<!--                <li>-->
<!--                    <router-link>-->
<!--                        <span class="icon"></span>-->
<!--                        <span class="title">Home</span>-->
<!--                    </router-link>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <router-link>-->
<!--                        <span class="icon"></span>-->
<!--                        <span class="title">Profile</span>-->
<!--                    </router-link>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <router-link>-->
<!--                        <span class="icon"></span>-->
<!--                        <span class="title">Messages</span>-->
<!--                    </router-link>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <router-link>-->
<!--                        <span class="icon"></span>-->
<!--                        <span class="title">Help</span>-->
<!--                    </router-link>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <router-link>-->
<!--                        <span class="icon"></span>-->
<!--                        <span class="title">Setting</span>-->
<!--                    </router-link>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <router-link>-->
<!--                        <span class="icon"></span>-->
<!--                        <span class="title">Password</span>-->
<!--                    </router-link>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <router-link>-->
<!--                        <span class="icon"></span>-->
<!--                        <span class="title">Sign Out</span>-->
<!--                    </router-link>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
    <div class="navigation">
        <ul>
            <li>
                <router-link to="/home">
                    <span class="icon"><i class="fas fa-home"></i></span>
                    <span class="title">Home</span>
                </router-link>
            </li>
            <li>
                <router-link to="/payments">
                    <span class="icon"><i class="fas fa-money-bill"></i></span>
                    <span class="title">Payments</span>
                </router-link>
            </li>
            <li>
                <router-link to="/expenses">
                    <span class="icon"><i class="fas fa-comment-dollar"></i></span>
                    <span class="title">Expenses</span>
                </router-link>
            </li>
            <li>
                <router-link to="/protocols">
                    <span class="icon"><i class="fas fa-clipboard-list"></i></span>
                    <span class="title">Protocols</span>
                </router-link>
            </li>
            <li>
                <router-link to="/settings">
                    <span class="icon"><i class="fas fa-user-cog"></i></span>
                    <span class="title">Settings</span>
                </router-link>
            </li>
            <li>
                <router-link to="/password">
                    <span class="icon"><i class="fas fa-key"></i></span>
                    <span class="title">Password</span>
                </router-link>
            </li>
            <li>
                <router-link to="/signout">
                    <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="title">Sign Out</span>
                </router-link>
            </li>
        </ul>
    </div>
    <div class="toggle">

    </div>
</template>

<script>
export default {
    name: "Sidebar",
    data () {
        return {

        }
    },


}
</script>

<style scoped>

</style>
