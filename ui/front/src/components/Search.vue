<template>
    <LoadingSpinner v-if="loading"></LoadingSpinner>
    <div v-for="movie in movies" v-bind:key="movie" class="home-list">
        <MovieElement   :id="movie.id"
                        :title="movie.title"
                        :image="movie.poster_path"
                        :releaseDate="movie.release_date"
                        :overview="movie.overview"
                        :voteCount="movie.vote_count"
                        :voteAvg="movie.vote_average">
        </MovieElement>
    </div>
</template>

<script>
import axios from 'axios';
import MovieElement from '@/components/MovieElement';
import LoadingSpinner from '@/components/LoadingSpinner'

export default {
    name: 'Search',
    components: {
        MovieElement,
        LoadingSpinner
    },
    data() {
        return {
            key: this.$route.params.key,
            movies: [],
            loading: true
        }
    },
    created() {
        this.fetchMovies(this.key);
    },
    methods: {
        fetchMovies(key) {
            const data = {
                key: key
            }

            axios.post('http://localhost:8081/api/search/movie', data, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(response => {
                console.debug(response);
                this.movies = response.data.results;
                this.loading = false;
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

    .home-list {
        margin: 10px 0px 10px 0px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>