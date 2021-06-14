<template>
    <HomeTemplate>
        <Watched></Watched>
    </HomeTemplate>
</template>

<script>
import HomeTemplate from '@/components/HomeTemplate'
import Watched from '@/components/Watched';

export default {
    name: 'WatchedView',
    components: {HomeTemplate, Watched}
}

</script>

<style scoped>

</style>