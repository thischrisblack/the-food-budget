<template>
    <div class="weekly">
        <ul>
            <li v-for="(week, index) in weeks" :key="index">{{ week.total }} {{ week.yearweek }}</li>
        </ul>
    </div>    
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            weeks: null
        }
    },
    methods: {
        yearWeek (date) {
            let year = date.substring(0,4);
            let day = date.substring(5);

        }
    },
    mounted () {
        // Make a request 
        axios.get('http://localhost/the-food-budget/src/api/?query=weekly', {crossdomain: true})
          .then((response) => {
            // handle success
            // let result = response.data;
            // let recentTrips = result.filter(trip => trip.date > '2019');
            // recentTrips.forEach( trip => console.log(trip));
            console.log(response.data);
            this.weeks = response.data;
            // this.weeks = response.data;
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          })
          .then(function () {
            // always executed
          });
    }
}
</script>

