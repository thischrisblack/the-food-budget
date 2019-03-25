<template>
  <div id="app" class="container">
    <EntryForm class="entry-form"/>
    <div class="week">
      <h2>Previous Weeks</h2>
      <Category class="category" v-for="category in categories" :key="category" :category="category"/>
    </div>
  </div>
</template>

<script>
import EntryForm from "./components/EntryForm.vue";
import Category from "./components/Category.vue";

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
    Category
  }
};
</script>

<style lang="scss">

  @import './styles/main.scss';

</style>
