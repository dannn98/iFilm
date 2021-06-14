<template>
    <div class="header">
        <div class="header-content">
            <div class="header-content-box">
                <NavBar></NavBar>
            </div>
            <div class="header-content-box">
                <SearchBar></SearchBar>
            </div>
        </div>
    </div>
    <div class="under-header">
    </div>
</template>

<script>
import NavBar from '@/components/NavBar';
import SearchBar from '@/components/SearchBar';

export default {
    name: 'Header',
    components: {NavBar, SearchBar}
}
</script>

<style scoped>
    * {
        font-family: Segoe UI;
    }

    .under-header {
        width: 100%;
        height: 116px;
    }

    .header {
        width: 100%;
        height: 116px;
        position: fixed;
        top: 0px;
        left: 0px;
        background-color: rgba(39, 39, 39, 0.98);
    }

    .header-content {
        margin: 0 auto;
        width: 1056px;
        height: 100%;
    }

    .header-content-box {
        width: 100%;
        height: 50%;
        color: white;
        display: flex;
        justify-content: space-between;
    }
</style>