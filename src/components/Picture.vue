<template>
    <div :style="{'background-image': 'url(' + image + ')'}"></div>
</template>

<script>
    
    export default {
        props: ['image']
    }
</script>

