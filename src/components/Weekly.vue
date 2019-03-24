<template>
    <div class="weekly">
        <ul>
            <li v-for="(week, index) in weekList" :key="index">{{ week.total }} {{ week.yearweek }}</li>
        </ul>
    </div>    
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            weeks: null,
            numWeeks: 2
        }
    },
    computed: {
        weekList: function () {
            if (this.weeks) {
                return this.weeks.slice(0, this.numWeeks);
            }
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

