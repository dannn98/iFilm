<template>
    <LoginTemplate>
        <Register></Register>
    </LoginTemplate>
</template>

<script>
import LoginTemplate from '@/components/LoginTemplate'
import Register from '@/components/Register'

export default {
    name: 'RegisterView',
    components: {LoginTemplate, Register}
}
</script>

<style scoped>

</style>