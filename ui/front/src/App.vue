<template>
  <main>
    <router-view />
  </main>
</template>

<script>

export default {
  name: 'App',
  components: {
  }
}

</script>

<style>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
  }

  * {
    margin: 0;
    padding: 0;
  }

  main {
    margin: 0 auto;
    width: 100vw;
    height: 100vh;
    max-width: 100%;
  }
</style>
