<template>
    <div>
        <h3>{{ category }}</h3>
        <ul>
            <li class="item"  v-for="(week, index) in weeklyData" :key="index">
                <span class="item__name">{{ week.yearweek }}</span> 
                <span class="item__value item__value--money">{{ week.total }}</span>
            </li>        
            <li class="item item--strong">
                <span class="item__name">Average</span>
                <span class="item__value item__value--money">{{ weeklyAverage }}</span>
            </li> 
        </ul>
       
        <button class="button button--increment" @click="showWeeks *= 2">+</button>
        
    </div>   
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            queryResult: null,
            showWeeks: 4
        }
    },
    props: [
        'category'
    ],
    computed: {
        weeklyData () {
            if (this.queryResult) {
                return this.queryResult.slice(0, this.showWeeks);
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
            if (this.weeklyTotal) {
                return (this.weeklyTotal / this.weeklyData.length).toFixed(2);
            }
        }
    },
    methods: {
        getWeekList (category) {
        // Make a request 
            axios.get('http://localhost/the-food-budget/src/api/?query=weekly&category=' + category, {crossdomain: true})
            .then((response) => {
                // handle success
                this.queryResult = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
    },
    mounted: function () {
        this.getWeekList(this.category);
    }
}
</script>

