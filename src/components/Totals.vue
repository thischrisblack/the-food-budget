<template>
    <div>
        <h2>Places</h2>
        <ul>
            <li class="item item--strong">
                <span class="item__name">Place (trips)</span>
                <span class="item__value">Total</span>
                <span class="item__value">Average</span>
            </li>
            <li class="item item--animated" v-for="place in thesePlaces" :key="place.place">
                <span class="item__name">{{ place.place }} ({{ place.count }})</span>
                <span class="item__value item__value--money">{{ place.total }}</span>
                <span class="item__value item__value--money">{{ (place.total / place.count).toFixed(2) }}</span>
            </li>
        </ul>
        <button v-if="(places.length > showPlaces)" class="button button--increment" @click="showPlaces *= 2">+</button>

        <div class="spacer" v-else></div>
    </div>    
</template>

    <script>
    import axios from 'axios';
    export default {
        props: ['places'],
        data () {
            return {
                showPlaces: 5
            }
        },
        computed: {
            thesePlaces () {
                if (this.places) {
                    return this.places.slice(0, this.showPlaces);
                }
            }
        }
    }
</script>

