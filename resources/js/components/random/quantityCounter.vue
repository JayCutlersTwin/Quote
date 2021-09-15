<template lang="html">
    <div class="flex flex-row justify-evenly h-10">
        <button class="btn-sm btn-primary font-lg" @click="decrement()" type="button" name="button">-</button>
        <h6 class="font-bold text-lg p-1.5">{{ quantity }}</h6>
        <button class="btn-sm btn-primary font-lg" @click="increment()" type="button" name="button">+</button>
    </div>
</template>

<script>
export default {
}
</script>
