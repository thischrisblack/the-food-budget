<template>
    <div>
        {{ getMonday() }}
    </div>    
</template>

<script>
export default {
    props: ['trips']
    ,
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
            return this.trips.filter(el => el.date > this.getMonday());
        }
      }
    }
}
</script>

