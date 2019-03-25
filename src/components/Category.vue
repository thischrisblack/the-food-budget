<template>
    <div>
        <h3>{{ category }}</h3>
        <ul>
            <li v-for="(week, index) in weeklyData" :key="index">
                <span class="category__date">{{ week.yearweek }}</span> <span class="category__amount">{{ week.total }}</span>
            </li>
        </ul>
        <div class="category__footer">
            <span>Average</span>
            <span class="category__average">{{ weeklyAverage }}</span>
            <button class="category__incrementer" @click="showWeeks *= 2">MORE</button>
        </div>
        
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
                console.log(response.data);
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

