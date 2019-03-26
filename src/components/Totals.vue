<template>
    <div>
        <h2>Places</h2>
        <ul>
            <li class="item item--strong">
                <span class="item__name">Place (trips)</span>
                <span class="item__value">Total</span>
                <span class="item__value">Average</span>
            </li>
            <li class="item" v-for="place in thesePlaces" :key="place">
                <span class="item__name">{{ place.place }} ({{ place.count }})</span>
                <span class="item__value item__value--money">{{ place.total }}</span>
                <span class="item__value item__value--money">{{ (place.total / place.count).toFixed(2) }}</span>
            </li>
        </ul>
        <button class="button button--increment" @click="showPlaces *= 2">+</button>
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

