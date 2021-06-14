<template>
    <form @submit.prevent="handleSearch">
        <input v-model="searchKey" type="text" placeholder="Title">
        <button type="submit">Search</button>
    </form>
</template>

<script>
export default {
    name: 'SearchBar',
    components: {},
    data() {
        return {
            searchKey: ""
        }
    },
    methods: {
        handleSearch() {
            const finalKey = this.slugify(this.searchKey);
            this.$router.push({name: 'SearchPage', params: { key: finalKey}});
        },
        slugify(string) {
            const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;'
            const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------'
            const p = new RegExp(a.split('').join('|'), 'g')

            return string.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
                .replace(/&/g, '-and-') // Replace & with 'and'
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, '') // Trim - from end of text
            }
    }
}
</script>

<style scoped>
    * {
        font-family: Segoe UI;
    }

    form {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form > input {
        width: 320px;
        height: 35px;
        margin: 0px 5px 0px 5px;
        text-align: center;
        font-size: 0.9em;
    }

    form > button {
        height: 39px;
        margin: 0px 5px 0px 5px;
        padding: 0px 10px 0px 10px;
        
        font-size: 1em;
        font-weight: 100;
        font-family: Segoe UI;
        background-color: #8cb8b2;
        border: 1px solid #487471;
    }

    form > button:hover {
        background-color: #6cc6bf;
    }
</style>