<template>
    <div class="movie-element">
        <img class="movie-img" :src="image">
        <div class="movie-info">
            <router-link :to="{ name: 'MoviePage', params: { id: id }}"><h1 class="movie-title">{{ title }}</h1></router-link>
            <div class="movie-meta">
                <p class="meta">Release date {{ releaseDate }}</p>
                <p class="meta">Average score {{ voteAvg }}</p>
                <p class="meta">Votes: {{ voteCount }}</p>
            </div>
            <p class="movie-overview"> {{ overview }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MovieElement',
    components: { },
    props: {
        id: {required: true, type: Number},
        title: {required: true, type: String},
        image: {required: true, type: String},
        releaseDate: {required:true, type: String},
        overview: {required:true, type: String},
        voteCount: {required:true, type: Number},
        voteAvg: {required:true, type: Number},
    }
}
</script>

<style scoped>
    * {
        font-family: Segoe UI;
    }

    .movie-element {
        width: 95%;
        display: flex;

        color: whitesmoke;
        border-radius: 5px;
        background-color: rgba(50, 50, 50, 0.4);
    }

    .movie-img {
        margin: 5px;
        border-radius: 5px;
    }

    .movie-info{
        margin: 5px;
    }

    .movie-title {
        color: #8cb8b2;
    }

    .movie-meta {
        display: flex;
    }

    .meta {
        margin-right: 30px;
        font-size: 0.8em;
        color: #8cb8b2;
    }

    .movie-overview {
        margin-top: 15px;
        width: 90%;

        font-size: 1em;
        color: #cecece;
        text-align: justify;
    }

    a {
        text-decoration: none;
    }

    .movie-title:hover {
        color: #61cbc4;
        text-decoration: underline;
        text-decoration-thickness: 1px;
    }

</style>