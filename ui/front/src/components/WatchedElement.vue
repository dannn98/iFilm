<template>
    <LoadingSpinner v-if="loading"></LoadingSpinner>
    <div class="watchlist-element">
        <router-link :to="{ name: 'MoviePage', params: { id: id_movie }}"><p class="watchlist-title">{{title}}</p></router-link>
        <div class="buttons">
            <button v-on:click="remove">Remove</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import LoadingSpinner from '@/components/LoadingSpinner.vue';

export default {
    name: 'WatchElementElement',
    components: {
        LoadingSpinner
    },
    data() {
        return {
            loading: false
        }
    },
    props: {
        id: {required: true, type: Number},
        id_movie: {required: true, type: Number},
        title: {required: true, type: String},
    },
    methods: {
        remove(){
            this.loading = true;

            const data = {
                id: this.id
            }

            axios.delete('http://localhost:8081/api/watchlist', {
                data,
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(() => {
                window.location.reload();
            })
            .catch(function(error){
                console.log("Error: " + error);
            })
        }
    }
}
</script>

<style scoped>
    * {
        font-family: Segoe UI;
    }

    .watchlist-element {
        width: 95%;
        height: 4em;

        border-radius: 5px;
        background-color: rgba(50, 50, 50, 0.4);
    }

    .watchlist-title {
        height: 100%;
        margin-left: 15px;
        float: left;

        display: flex;
        justify-content: center;
        align-items: center;

        color: whitesmoke;
        font-size: 1.3em;
        font-weight: 100;
    }

    .watchlist-title:hover {
        color: #61cbc4;
        text-decoration: underline;
        text-decoration-thickness: 1px;
    }

    .buttons {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        float: right;
    }

    .buttons > button {
        height: 39px;
        margin-right: 15px;
        padding: 0px 10px 0px 10px;
        
        font-size: 1em;
        font-weight: 100;
        font-family: Segoe UI;
        background-color: #8cb8b2;
        border: 1px solid #487471;
    }

    .buttons > button:hover {
        background-color: #6cc6bf;
    }
</style>