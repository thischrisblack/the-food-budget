<template>
    <div class="weekly">
        {{ category }}
        <ul>
            <li v-for="(week, index) in weeklyData" :key="index">
                {{ week.yearweek }} {{ week.total }}
            </li>
        </ul>
        <div @click="numWeeks += 3">MORE</div>
        <div>{{ weeklyTotal }}</div>
        <div>{{ weeklyAverage }}</div>
    </div>    
</template>

<script>

/**
 * HEY why don't you make this into a generic weekly module, and pass the category in as a prop? From App.vue?
 */


import axios from 'axios';
export default {
    data() {
        return {
            queryResult: null,
            numWeeks: 3
        }
    },
    props: [
        'category'
    ],
    computed: {
        weeklyData () {
            if (this.queryResult) {
                return this.queryResult.slice(0, this.numWeeks);
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

