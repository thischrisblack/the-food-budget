<template>
    <div class="weekly">
        <span @click="numWeeks *= 2">MORE</span>sdf
        <div v-for="(weeklyData, key) in weeks" :key="key">
            {{ key }}
            <ul>
                <li v-for="(week, index) in weeklyData.slice(0, numWeeks)" :key="index">{{ week.yearweek}} {{ week.total }}</li>
            </ul>
        </div>
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
            weeks: null,
            numWeeks: 3
        }
    },
    props: [
        'categories'
    ],
    methods: {
        getTripList (category) {
        // Make a request 
            axios.get('http://localhost/the-food-budget/src/api/?query=weekly&category=' + category, {crossdomain: true})
            .then((response) => {
                // handle success
                console.log(response.data);
                this.weeks[category] = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        }
    },
    mounted: function () {
        this.weeks = {};
        this.categories.forEach(category => {
            this.getTripList(category);
        });
    }
}
</script>

