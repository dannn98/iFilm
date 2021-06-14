<template>
    <Header></Header>
    <div class="main">
        <div class="main-content">
            <slot></slot>
        </div>
    </div>
    <div class="bg-image">
    </div>
</template>

<script>
import Header from '@/components/Header';

export default {
    name: 'HomeTemplate',
    components: {Header}
}
</script>

<style scoped>
    * {
        font-family: Segoe UI;
    }

    .bg-image {
        width: 100%;
        height: 100vh;
        position: fixed;
        top: 0px;
        left: 0px;
        z-index: -1000;

        background-image: url("../../public/img/bg.jpg");
        background-position: center;
        background-size: 100%;
        filter: grayscale(100%);
    }

    .main {
        margin: 0;
        padding: 0;
        width: 100%;
        min-height: calc(100vh - 116px);
        display: flex;
        justify-content: center;

        background-color: rgba(39, 39, 39, 0.8);
    }

    .main-content {
        width: 1056px;
        min-height: calc(100vh - 116px);
        background-color: rgba(39, 39, 39, 0.9);
    }
</style>