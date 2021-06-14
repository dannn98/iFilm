<template>
    <LoginTemplate>
        <Login></Login>
    </LoginTemplate>
</template>

<script>
import LoginTemplate from '@/components/LoginTemplate'
import Login from '@/components/Login'

export default {
    name: 'LoginView',
    components: {LoginTemplate, Login}
}
</script>

<style scoped>

</style>