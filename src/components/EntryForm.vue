<template>
    <div class="entry-form">

        <form>

        <h1>WHAT DID WE SPEND?</h1>

        <input type="number" step="0.01" placeholder="0.00" name="amount">

        <input type="text" list="prevPlaces" placeholder="At this place" name="place" class="dropdown">
        <datalist ID="prevPlaces">
            <option v-for="place in places" :key="place.place" :value="place.place"></option>
        </datalist>

        <textarea name="notes" placeholder="Notes"></textarea>

        <input type="text" list="prevCats" placeholder="Category" name="place" class="dropdown">
        <datalist ID="prevCats">
            <option v-for="(cat, key) in categories" :key="key" :value="key"></option>
        </datalist>

        <button class="button button__main">sdfsd</button>

        </form>

    </div>

</template>

<script>    

    import groupBy from 'lodash.groupby';

    export default {
        props: ['places', 'trips'],
        computed: {
            categories () {
                return groupBy(this.trips, val => val.category);
            }
        }
    }
</script>

