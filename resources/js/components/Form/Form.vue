<template>
    <form action="">

        <div class="d-flex justify-content-end align-items-center">
            <a class="btn btn-outline-dark mr-1" href="">Назад</a>
            <button class="btn btn-outline-dark" type="submit"></button>
        </div>
    </form>
</template>

<script>
export default {
    name: "Form",
    props: {
        action: String,
        method: String,
    },
    created() {

    },
}
</script>

<style scoped>

</style>
