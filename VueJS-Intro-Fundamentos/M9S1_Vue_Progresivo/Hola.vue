<template>
    <div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore, excepturi cumque atque voluptatibus distinctio, delectus voluptates laudantium placeat incidunt voluptas vitae inventore quidem itaque! Eaque consectetur ut ipsa porro obcaecati.</p>
        <br>

        <p>{{ text }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            text: 'Hola Mundo'
        }
    },
}
</script>

<style scoped>
    p {
        color: red;
    }
</style>