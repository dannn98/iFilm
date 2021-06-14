<template>
    <div class="bg-image">
    </div>
    <div class="main">
        <img src="../../public/img/logo.svg">
        <div class="login-form">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'LoginTemplate',
    components: {}
}
</script>

<style scoped>
    .bg-image {
        position: fixed;
        width: 100vw;
        height: 100vh;
        z-index: -1000;

        background-image: url("../../public/img/bg.jpg");
        background-position: center;
        background-size: 100%;
        filter: grayscale(100%);
    }

    .main {
        width: 100vw;
        height: 100vh;
        background-color: rgba(39, 39, 39, 0.8);
        
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    
    .main > img {
        margin-bottom: 5px;
    }

    .login-form {
        padding: 12px 105px 12px 105px;
        margin-top: 5px;
        background-color: whitesmoke;

        border-radius: 5px;
    }
</style>