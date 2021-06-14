<template>
    <HomeTemplate>
        <Search></Search>
    </HomeTemplate>
</template>

<script>
import HomeTemplate from '@/components/HomeTemplate';
import Search from '@/components/Search';

export default {
    name: 'SearchView',
    components: {HomeTemplate, Search}
}
</script>

<style scoped>

</style>