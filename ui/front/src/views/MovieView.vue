<template>
    <HomeTemplate>
        <Movie></Movie>
    </HomeTemplate>
</template>

<script>
import HomeTemplate from '@/components/HomeTemplate';
import Movie from '@/components/Movie';

export default {
    name: 'MovieView',
    components: {HomeTemplate, Movie}
}
</script>

<style scoped>
    * {
        font-family: Segoe UI;
    }
</style>