<template>
    <li class="c-sidebar-nav-title">
        <span v-text="name"></span>
    </li>
</template>

<script>
export default {
    name: "Title",
    props: ['name']
}
</script>
