<template>
    <LoadingSpinner v-if="loading"></LoadingSpinner>
    <form @submit.prevent="handleRegister">
        <p class="message">{{ message }}</p>
        <input v-model="user.email" type="text" placeholder="email@email.com">
        <input v-model="user.password" name="password" type="password" placeholder="entry password">
        <input v-model="password" name="password" type="password" placeholder="re-entry password">
        <button type="submit">Sign in</button>
        <p>Already have an account? <router-link to="/login">Login here</router-link></p>
    </form>
</template>

<script>
import User from '@/models/user';
import LoadingSpinner from '@/components/LoadingSpinner';
import axios from 'axios';

export default {
    name: 'Register',
    components: {LoadingSpinner},
    data() {
        return {
            user: new User('', ''),
            password: "",
            message: "",
            loading: false
        }
    },
    methods: {
        handleRegister() {
            this.loading = true;

            const data = {
                email: this.user.email,
                password: this.user.password
            };

            if(this.user.password !== this.password) {
                this.message = "Passwords are not the same!";
            }
            else {
                axios.post('http://localhost:8081/api/user', data)
                .then(() => {
                    this.$router.push('/login');
                    this.loading = false
                })
                .catch(function(error){
                    console.log("Error: " + error);
                    this.message = error
                    this.loading = false
                })
            }
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

    .message {
        margin-bottom: 5px; 

        color: red;
        font-family: Segoe UI;
    }
</style>