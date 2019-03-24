<template>
  <div id="app" class="container">
    <EntryForm/>
    <Weekly :categories="categories"/>
  </div>
</template>

<script>
import EntryForm from "./components/EntryForm.vue";
import Weekly from "./components/Weekly.vue";

export default {
  name: "app",
  data () {
    return {
      categories: [
          'Groceries',
          'Snacks',
          'Restaurants'
      ]
    }
  },
  components: {
    EntryForm,
    Weekly
  }
};
</script>

<style lang="scss">

$main-font-size: 1.4rem;

*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}

html {
  box-sizing: border-box;
  font-size: 62.5%;
}

body {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  font-size: $main-font-size;
  line-height: 2.2rem;
  padding: 2rem;
}

input, textarea, select {
  display: inline-block;
  width: 100%;
}

.container {
  display: grid;
  grid-auto-rows: 1fr;
  grid-template-columns: 1fr 1fr 1fr;
  grid-template-areas: "left center right";
  grid-column-gap: 2rem;
}

.entry-form {
  grid-area: left;
}

</style>
