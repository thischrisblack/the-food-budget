<template>
    <div>
        <h2>This Week</h2>
        <ul>
            <li class="item" v-for="(total, category) in categoryTotals" :key="category">
                <span class="item__name">{{ category }}</span> 
                <span class="item__value">{{ total }}</span> 
            </li>
        </ul>        
    </div>    
</template>

<script>

import groupBy from 'lodash.groupby';

export default {
    props: ['trips'],
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

