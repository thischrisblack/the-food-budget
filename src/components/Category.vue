<template>
    <div>
        <h3>{{ category }}</h3>
        <ul>
            <li class="item item--animated"  v-for="(week, index) in weeklyData" :key="index">
                <span class="item__name">{{ dateFormat(week.yearweek) }}</span> 
                <span class="item__value item__value--money">{{ week.total }}</span>
            </li> 
                   
            <li class="item item--strong">
                <span class="item__name">Average</span>
                <span class="item__value item__value--money">{{ weeklyAverage }}</span>
            </li> 
        </ul>
       
        <button v-if="(queryResult.length > showWeeks)" class="button button--increment" @click="showWeeks *= 2">+</button>

        <div class="spacer" v-else></div>
        
    </div>   
</template>

<script>
import axios from 'axios';
import { apiLink } from '../config';
export default {
    data() {
        return {
            queryResult: null,
            showWeeks: 5
        }
    },
    props: [
        'category'
    ],
    computed: {
        weeklyData () {
            if (this.queryResult) {
                return this.queryResult.slice(1, this.showWeeks);
            }
        },
        weeklyTotal () {
            if (this.weeklyData) {
                let total = 0;
                this.weeklyData.forEach(week => {
                    total += week.total * 1;
                });
                return total.toFixed(2);
            }
        },
        weeklyAverage () {
            if (this.weeklyTotal > 0) {
                console.log(this.weeklyTotal);
                return (this.weeklyTotal / this.weeklyData.length).toFixed(2);
            } else {
                return '0.00';
            }
        }
    },
    methods: {
        getWeekList (category) {
        // Make a request 
            axios.get(apiLink + '?query=weekly&category=' + category, {crossdomain: true})
            .then((response) => {
                // handle success
                this.queryResult = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },
        dateFormat (date) {
            let dateParts = date.split('-');
            return dateParts[1] + '/' + dateParts[2] + '/' + dateParts[0];
        }
    },
    mounted: function () {
        this.getWeekList(this.category);
    }
}
</script>

