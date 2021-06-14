<template>
    <LoadingSpinner v-if="loading" class="spinner"></LoadingSpinner>
    <!-- <h2 class="head-title">Movies to watch</h2> -->
    <div v-for="movie in movies" v-bind:key="movie" class="home-list">
        <WatchedElement    :id="movie.id"
                                :id_movie="movie.id_movie"
                                :title="movie.title">
        </WatchedElement>
    </div>
</template>

<script>
import axios from 'axios';
import WatchedElement from '@/components/WatchedElement';
import LoadingSpinner from '@/components/LoadingSpinner.vue';

export default {
    name: 'Watched',
    components: {
        WatchedElement,
        LoadingSpinner
    },
    data() {
        return {
            movies: [],
            loading: true
        }
    },
    created() {
        this.fetchMovies();
    },
    methods: {
        fetchMovies() {
            axios.get('http://localhost:8081/api/watchlist', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(response => {
                console.debug(response);
                for(var i = 0, j = 0; i < response.data.watchlist.length; i++) {
                    if(response.data.watchlist[i].watched === "true"){
                        this.movies[j] = response.data.watchlist[i];
                        j++;
                    }
                }
                console.debug(this.movies);
                this.loading = false;
            })
            .catch(function(error) {
                console.log("Error: " + error);
            });
        }
    }
}
</script>

<style scoped>
    * {
        font-family: Segoe UI;
    }

    .home-list {
        margin: 10px 0px 10px 0px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .head-title{
        /* font-size: ; */
        text-align: center;
        font-weight: 100;
        color: #8cb8b2;
        /* background-color: violet; */
    }
</style>