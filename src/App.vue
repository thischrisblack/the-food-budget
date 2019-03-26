<template>
    <div id="app" class="container">
        <EntryForm class="entry-form" :places="places" :trips="trips" :categories="categories"/>
        <Current class="current" :trips="trips"/>
        <div class="history">
            <h2>Previous Weeks</h2>
            <Category class="category" v-for="category in categories" :key="category" :category="category"/>
        </div>
    <Totals class="totals" :places="places"/>
    </div>
</template>

<script>
import EntryForm from "./components/EntryForm.vue";
import Category from "./components/Category.vue";
import Current from "./components/Current.vue";
import Totals from "./components/Totals.vue";
import axios from 'axios';
import groupBy from 'lodash.groupby';


export default {
    name: "app",
    data () {
        return {
            trips: null,
            places: null
        }
    },
	computed: {
		categories () {
			let cats = groupBy(this.trips, val => val.category);
			return Object.keys(cats);
		}
	},
    components: {
        EntryForm,
        Category,
        Current,
        Totals
    },
    methods: {
            getTrips (date) {
            // Make a request 
                    axios.get('http://localhost/the-food-budget/src/api/?query=trips', {crossdomain: true})
                    .then((response) => {
                            // handle success
                            this.trips = response.data;
                    })
                    .catch(function (error) {
                            // handle error
                            console.log(error);
                    })
            },
            getPlaces () {
            // Make a request 
                    axios.get('http://localhost/the-food-budget/src/api/?query=totals', {crossdomain: true})
                    .then((response) => {
                            // handle success
                            this.places = response.data;
                    })
                    .catch(function (error) {
                            // handle error
                            console.log(error);
                    })
            }
    },
    mounted: function () {
            this.getTrips();
            this.getPlaces();
    }
};
</script>

<style lang="scss">

    @import './styles/main.scss';

</style>
