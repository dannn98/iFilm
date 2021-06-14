<template>
    <div class="movie-container">
        <LoadingSpinner v-if="loading"></LoadingSpinner>
        <div v-if="movieVisible" class="movie">
            <img :src="movie.poster_path">
            <div class="movie-info">
                <h1 class="movie-title">{{ movie.title }}</h1>
                <p class="movie-tagline">"{{ movie.tagline }}"</p>
                <div class="movie-meta">
                    <p class="meta">Release date {{ movie.release_date }} |</p>
                    <p class="meta">Average score {{ movie.vote_average }} |</p>
                    <p class="meta">Votes: {{ movie.vote_count }}</p>
                </div>
                <p class="movie-overview">{{ movie.overview }}</p>
                <div class="movie-more-info">
                    <table>
                        <tr>
                            <td><p class="info">Runtime:</p></td>
                            <td><p class="info to-right">{{movie.runtime}}min</p></td>
                        </tr>
                        <tr>
                            <td><p class="info">Budget:</p></td>
                            <td><p class="info to-right">{{movie.budget}}$</p></td>
                        </tr>
                        <tr>
                            <td><p class="info">Revenue:</p></td>
                            <td><p class="info to-right">{{movie.revenue}}$</p></td>
                        </tr>
                    </table>
                    <p class="info">Production companies: {{companies}}</p>
                </div>
                <div class="buttons">
                    <button v-on:click="toWatch">Add to watch</button>
                    <button v-on:click="watched">Watched</button>
                </div>
                <p class="message">{{ message }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import LoadingSpinner from '@/components/LoadingSpinner.vue';

export default {
    name: 'Movie',
    components: { LoadingSpinner },
    data() {
        return {
            id: this.$route.params.id,
            movie: {},
            companies: "",
            comments: [],
            message: "",
            movieVisible: false,
            loading: true
        }
    },
    created() {
        this.fetchMovie(this.id);
    },
    methods: {
        fetchMovie(id = 1) {
            axios.get('http://localhost:8081/api/movie/' + id, {
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(response => {
            console.debug(response);
            this.movie = response.data.movie;
            this.comments = response.data.comments;

            for(let i = 0; i < this.movie.production_companies.length; i++){
                this.companies += this.movie.production_companies[i].name + ", ";
            }
            this.loading = false;
            this.movieVisible = true;
        })
        .catch(function(error) {
            console.log("Error: " + error);
        });
        },
        toWatch() {
            const data = {
                id_movie: this.movie.id,
                watched: "false"
            }

            axios.post('http://localhost:8081/api/watchlist', data, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(response => {
                console.debug(response);
                this.message = "Movie added to watch";
            })
            .catch(function(error){
                console.log("Error: " + error);
            })
        },
        watched() {
            const data = {
                id_movie: this.movie.id,
                watched: "true"
            }

            axios.post('http://localhost:8081/api/watchlist', data, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(response => {
                console.debug(response);
                this.message = "Movie watched";
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

    .movie-container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .movie {
        width: 95%;
        margin: 10px 0px 10px 0px;
        display: flex;

        border-radius: 5px;
        background-color: rgba(50, 50, 50, 0.4);
    }

    .movie > img {
        margin: 5px;
        border-radius: 5px;
    }

    .movie-info {
        width: 100%;
        margin: 5px;
    }

    .movie-title {
        color: #61cbc4;
    }

    .movie-tagline {
        color: #61cbc4;
        font-style: italic;
    }

    .movie-meta {
        margin-top: 5px;
        display: flex;
    }

    .meta {
        margin-right: 5px;
        font-size: 0.8em;
        color: #8cb8b2;
    }

    .movie-overview {
        margin-top: 15px;
        width: 95%;

        font-size: 1em;
        color: #cecece;
        text-align: justify;
    }

    .movie-more-info {
        margin-top: 10px;
    }

    .info {
        margin-right: 0px;
        font-size: 0.85em;
        color: #8cb8b2;
    }

    .to-right {
        text-align: end;
        padding-left: 5px;
    }

    .buttons {
        margin-top: 15px;
    }

    .buttons > button {
        height: 39px;
        margin: 0px 10px 0px 0px;
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

    .message {
        margin-top: 10px;

        font-size: 0.7em;
        color: #6cc6bf;
    }
</style>