<template>
    <div>

        <form @submit="checkForm">

        <h1>WHAT DID WE SPEND?</h1>

        <input type="number" step="0.01" placeholder="$0.00" v-model="amount" required>

        <input type="text" list="prevPlaces" placeholder="At this place" class="dropdown" v-model="place" @click="place = ''" @change="onSelect" required>
        <datalist ID="prevPlaces">
            <option v-for="place in places" :key="place.place" :value="place.place"></option>
        </datalist>

        <textarea placeholder="Notes" v-model="notes"></textarea>

        <input type="text" list="prevCats" placeholder="Category" class="dropdown" v-model="category" @click="category = ''" @change="onSelect" required>
        <datalist ID="prevCats">
            <option v-for="(cat, key) in categories" :key="key" :value="cat"></option>
        </datalist>

        <button type="submit" class="button button__main" @click.prevent="checkForm">SAVE</button>

        </form>

    </div>

</template>

<script>   
    import axios from 'axios';
    import { apiLink } from '../config';
    export default {
        data () {
            return {
                amount: '',
                place: '',
                notes: '',
                category: ''
            }
        },
        props: ['places', 'trips', 'categories'],
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
            },
            checkForm: function () {
                if (this.amount && this.place && this.category) {
                    this.addItem();
                    return;
                }
                if (!this.amount) {
                    alert('Amount required.');
                    return;
                }
                if (!this.place) {
                    alert('Place required.');
                    return;
                }
                if (!this.category) {
                    alert('Category required.');
                    return;
                }
            }
        }
    }
</script>

