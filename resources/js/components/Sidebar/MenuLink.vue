<template>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" :href="href">
            <i :class="icon + ' c-sidebar-nav-icon'"></i>
            <span v-text="name"></span>
        </a>
    </li>
</template>

<script>
export default {
    name: "Link",
    props: ['name', 'icon', 'href']
}
</script>