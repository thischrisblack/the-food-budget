<template>
    <div class="percent-image" :style="{'background-image': 'url(' + image + ')'}"></div>
</template>

<script>
    
    export default {
        props: ['image']
    }
</script>

