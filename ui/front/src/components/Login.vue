<template>
    <LoadingSpinner v-if="loading"></LoadingSpinner>
    <form @submit.prevent="handleLogin">
        <input v-model="user.email" type="text" placeholder="email@email.com">
        <input v-model="user.password" type="password" placeholder="password">
        <button>Sign in</button>
        <p>Don't have an account? <router-link to="/register">Create account here</router-link></p>
        <p>To Continue browsing movies, <router-link to="/home">click here</router-link></p>
    </form>
</template>

<script>
import User from '@/models/user';
import axios from 'axios';
import LoadingSpinner from '@/components/LoadingSpinner';

export default {
    name: 'Login',
    components: {LoadingSpinner},
    data() {
        return {
            user: new User('', ''),
            loading: false
        }
    },
    methods: {
        handleLogin() {
            this.loading = true;

            const data = {
                username: this.user.email,
                password: this.user.password
            };

            console.log(data);
            axios.post('http://localhost:8081/api/login_check', data)
            .then(response => {
                console.debug(response);

                localStorage.setItem('token', response.data.token);
                this.loading = false;
                this.$router.push('/home');
            })
            .catch(function(error) {
                this.loading = false;
                console.log("Error: " + error);
            })
        }
    }
}
</script>

<style scoped>
    form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        font-family: Segoe UI;
    }

    form > p {
        margin-top: 5px;
        font-size: 0.8em;
    }

    form > input {
        width: 300px;
        height: 30px;
        margin-bottom: 5px; 

        font-family: Segoe UI;
        text-align: center;
    }

    form > button {
        width: 300px;
        height: 30px;

        font-family: Segoe UI;
        background-color: #8cb8b2;
        border: 1px solid #487471;
    }

    button:hover {
        background-color: #6cc6bf;
    }
</style>