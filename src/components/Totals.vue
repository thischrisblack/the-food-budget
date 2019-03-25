<template>
    <div>
        <h2>Places</h2>
        <ul>
            <li class="item" v-for="place in thesePlaces" :key="place">
                <span class="item__name">{{ place.place }}</span>
                <span class="item__value">{{ place.total }} ({{ (place.total / place.count).toFixed(2) }})</span>
            </li>
        </ul>
        <button class="category__incrementer" @click="showPlaces *= 2">MORE</button>
    </div>    
</template>

    <script>
    import axios from 'axios';
    export default {
        data () {
            return {
                places: null,
                showPlaces: 10
            }
        },
        computed: {
            thesePlaces () {
                if (this.places) {
                    return this.places.slice(0, this.showPlaces);
                }
            }
        },
        methods: {
            getPlaces () {
            // Make a request 
                axios.get('http://localhost/the-food-budget/src/api/?query=totals', {crossdomain: true})
                .then((response) => {
                    // handle success
                    console.log(response.data);
                    this.places = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            }
        },
        mounted: function () {
            this.getPlaces();
        }
    }
</script>

