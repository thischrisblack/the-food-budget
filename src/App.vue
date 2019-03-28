<template>
    <div id="app" class="container">
        <EntryForm class="entry-form" :places="places" :trips="trips" :categories="categories" v-on:itemadded="getTrips"/>
        <Current class="current" :trips="trips" v-on:itemdeleted="getTrips" v-on:grocerytotal="groceryTotal"/>
        <div class="history">
            <h2>Previous Weeks</h2>
            <Category class="category" v-for="category in categories" :key="category" :category="category"/>
        </div>
        <Totals class="totals" :places="places"/>
        <Picture class="picture" :image="getImage"/>
    </div>
</template>

<script>
import EntryForm from "./components/EntryForm.vue";
import Category from "./components/Category.vue";
import Current from "./components/Current.vue";
import Totals from "./components/Totals.vue";
import Picture from "./components/Picture.vue";
import axios from 'axios';
import groupBy from 'lodash.groupby';

import { budget } from './config';
import { percentImages } from './config';


export default {
    name: "app",
    data () {
        return {
            trips: null,
            places: null,
            groceries: 0,
            budget: budget
        }
    },
	computed: {
		categories () {
			let cats = groupBy(this.trips, val => val.category);
			return Object.keys(cats);
        },
        percentSpent () {

                console.log(this.groceries, this.budget, 'balls');
                return this.groceries / budget;
          
        },
        getImage () {

                let vm = this;
                var images = require.context('./assets/', false, /\.gif$/);
                function overSpent(index) {
                    return vm.percentSpent < index.percent;
                };
                return images('./' + percentImages.find(overSpent).image);  
     
        }
	},
    components: {
        EntryForm,
        Category,
        Current,
        Totals,
        Picture
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
            },
            groceryTotal (value) {
                this.groceries = value ? value : 0;
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
