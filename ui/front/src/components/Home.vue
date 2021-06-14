<template>
    <LoadingSpinner v-if="loading" class="spinner"></LoadingSpinner>
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
import LoadingSpinner from '@/components/LoadingSpinner.vue';

export default {
    name: 'Home',
    components: {
        MovieElement,
        LoadingSpinner
    },
    data() {
        return {
            page: this.$route.params.page,
            movies: [],
            loading: true
        }
    },
    created() {
        this.fetchMovies(this.page);
    },
    methods: {
        fetchMovies(page = 1) {
            axios.get('http://localhost:8081/api/movie/page/' + page, {
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(response => {
            console.debug(response);
            this.movies = response.data.results;
            this.loading = false;
            console.debug(this.movies);
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
</style>