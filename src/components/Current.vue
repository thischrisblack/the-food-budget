<template>
    <div>
        <h2>This Week</h2>
        <h3>Trips</h3>
        <ul>
            <li class="item" v-for="(trip, key) in thisWeek" :key="key">
                <span class="item__name">{{ trip.place }}</span>
                <span class="item__value item__value--money">{{ trip.amount }}
                    <span class="item__delete" @click="deleteItem(trip.pk)">&times;</span>
                </span>
            </li>
        </ul>
        <h3>Totals</h3>
        <ul>
            <li class="item" v-for="(total, category) in categoryTotals" :key="category">
                <span class="item__name">{{ category }}</span> 
                <span class="item__value item__value--money">{{ total }}</span> 
            </li>
        </ul>        
    </div>    
</template>

<script>

import groupBy from 'lodash.groupby';
import axios from 'axios';

export default {
    props: ['trips'],
    data () {
        return {
            deleteID: ''
        }
    },
    methods: {
        getMonday () {
            let today = new Date();
            let day = today.getDay();
            let sinceMonday = today.getDate() - day + (day == 0 ? -6 : 1);
            let lastMonday = new Date(today.setDate(sinceMonday));
            let year = lastMonday.getFullYear();
            let month = lastMonday.getMonth() + 1;
            let date = lastMonday.getDate();
            month = (month > 9 ? '' : '0') + month;
            date = (date > 9 ? '' : '0') + date;
            return year + '-' + month + '-' + date;
        },
        deleteItem (id) {
            let qs = require('qs');
            axios.post('http://localhost/the-food-budget/src/api/', qs.stringify({
                delete: 'delete',
                pk: id
            }))
            .then((response) => {
                console.log(response);
                this.emitDelete();
            })
            .catch(function (error) {
              console.log(error);
            });
        },
        emitDelete () {
            this.$emit('itemdeleted');
        }
    },
    computed: {
        thisWeek () {
            if (this.trips) {
                let thisWeekTrips = this.trips.filter(el => el.date > this.getMonday());
                return thisWeekTrips;
            }
        },
        categoryTotals () {

            // We're going to need to check for the existence of thisWeek data here!
            
            let thisWeekTotals = {};
            let categorized = groupBy(this.thisWeek, val => val.category);
            for (let category in categorized) {
                let totalAmount = categorized[category].reduce(function (accumulator, currentValue) {
                    return accumulator + currentValue.amount * 1;
                }, 0);
                thisWeekTotals[category] = totalAmount.toFixed(2);
            }
            return thisWeekTotals;
        }
    }
}
</script>

