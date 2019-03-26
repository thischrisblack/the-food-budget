<template>
    <div class="entry-form">

        <form>

        <h1>WHAT DID WE SPEND?</h1>

        <input type="number" step="0.01" placeholder="0.00" name="amount">

        <input type="text" list="prevPlaces" placeholder="AT THIS PLACE" name="place">
        <datalist ID="prevPlaces">

            <option value="Monkey"></option>
            <option value="Banana"></option>
            <option value="Chris"></option>

        </datalist>

        <textarea name="notes" placeholder="NOTES"></textarea>

        <select name="category">
            <option>Groceries</option>
            <option>Snacks</option>
            <option>Restaurants</option>
        </select>

        <button class="button button__main">sdfsd</button>

        </form>

    </div>

</template>

<script>
export default {
    
}
</script>

