<template>
    <div>

        <form>

        <h1>WHAT DID WE SPEND?</h1>

        <input type="number" step="0.01" placeholder="$0.00" v-model="amount">

        <input type="text" list="prevPlaces" placeholder="At this place" class="dropdown" v-model="place" @click="place = ''" @change="onSelect">
        <datalist ID="prevPlaces">
            <option v-for="place in places" :key="place.place" :value="place.place"></option>
        </datalist>

        <textarea placeholder="Notes" v-model="notes"></textarea>

        <input type="text" list="prevCats" placeholder="Category" class="dropdown" v-model="category" @click="category = ''" @change="onSelect">
        <datalist ID="prevCats">
            <option v-for="(cat, key) in categories" :key="key" :value="cat"></option>
        </datalist>

        <button class="button button__main" @click.prevent="addItem">SAVE</button>

        </form>

    </div>

</template>

<script>   
    import axios from 'axios';
    import { apiLink } from '../config';
    export default {
        props: ['places', 'trips', 'categories'],
        data () {
            return {
                amount: '',
                place: '',
                notes: '',
                category: ''
            }
        },
        methods: {
            addItem () {
                let qs = require('qs');
                axios.post(apiLink, qs.stringify({
                    additem: 'additem',
                    amount: this.amount,
                    place: this.place,
                    notes: this.notes,
                    category: this.category
                }))
                .then((response) => {
                    console.log(response);
                    this.amount = '';
                    this.place = '';
                    this.notes = '';
                    this.category = '';  
                    this.emitClick();
                })
                .catch(function (error) {
                  console.log(error);
                });
            },
            emitClick () {
                this.$emit('itemadded');
            },
            onSelect () {
                document.activeElement.blur();
            }
        }
    }
</script>

