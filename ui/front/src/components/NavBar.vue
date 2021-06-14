<template>
    <div class="header-content-box-item">
        <img class="logo" src="../../public/img/logo.svg">
    </div>
    <div class="header-content-box-item">
        <nav>
            <router-link to="/home" class="nav-elem">Home</router-link>
            <router-link to="/towatch" class="nav-elem">To watch</router-link>
            <router-link to="/watched" class="nav-elem">Watched</router-link>
            <router-link to="/ranks" class="nav-elem">Ranks</router-link>
        </nav>
    </div>
    <div class="header-content-box-item">
        <div id="logout" @click="handleLogout">Logout</div>
    </div>
</template>

<script>
export default {
    name: 'NavBar',
    components: {},
    methods: {
        handleLogout() {
            localStorage.removeItem('token');
            this.$router.push('/login');
        }
    }
}
</script>

<style scoped>
    * {
        font-family: Segoe UI;
    }

    .header-content-box-item {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .header-content-box-item > img {
        height: 80%;
    }

    #logout {
        width: 146px;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

        color: #8cb8b2;
        text-decoration: none;
        font-size: 1.2em;
        cursor: pointer;
    }

    #logout:hover {
        color: #6cc6bf;
        border-bottom: 1px solid #6cc6bf;
    }

    nav{
        height: 100%;
        display: flex;
    }

    .nav-elem {
        height: 100%;
        margin: 0px 10px 0px 10px;
        padding: 0px 3px 0px 3px;

        display: flex;
        justify-content: center;
        align-items: center;

        color: whitesmoke;
        text-decoration: none;
        font-weight: 100;
        font-size: 1.6em;
    }

    .nav-elem:hover{
        color: #6cc6bf;
        border-bottom: 1px solid #6cc6bf;
    }
</style>