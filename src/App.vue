<template>
  <div id="app" class="container">
    <EntryForm class="entry-form"/>
    <Current class="current" :trips="trips" v-if="(trips)"/>
    <div class="history">
      <h2>Previous Weeks</h2>
      <Category class="category" v-for="category in categories" :key="category" :category="category"/>
    </div>
  <Totals class="totals"/>
  </div>
</template>

<script>
import EntryForm from "./components/EntryForm.vue";
import Category from "./components/Category.vue";
import Current from "./components/Current.vue";
import Totals from "./components/Totals.vue";
import axios from 'axios';

export default {
  name: "app",
  data () {
    return {
      categories: [
        'Groceries',
        'Snacks',
        'Restaurants'
      ],
      trips: null
    }
  },
  components: {
    EntryForm,
    Category,
    Current,
    Totals
  },
  methods: {
      getTrips () {
      // Make a request 
          axios.get('http://localhost/the-food-budget/src/api/?query=trips', {crossdomain: true})
          .then((response) => {
              // handle success
              console.log(response.data);
              this.trips = response.data;
          })
          .catch(function (error) {
              // handle error
              console.log(error);
          })
      }
  },
  mounted: function () {
      this.getTrips();
  }
};
</script>

<style lang="scss">

  @import './styles/main.scss';

</style>
