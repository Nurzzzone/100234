<template>
    <li class="c-sidebar-nav-dropdown">
    <span class="c-sidebar-nav-dropdown-toggle">
        <i :class="icon + ' c-sidebar-nav-icon'"></i>
        <span v-text="name"></span>
    </span>
        <ul class="c-sidebar-nav-dropdown-items">
            <v-sidebar-link v-for="(child, index) in children" :key="index"
                            :name="child.name"
                            :href="child.href"
            ></v-sidebar-link>
        </ul>
    </li>
</template>

<script>
export default {
    name: "Dropdown",
    props: ['children', 'name', 'icon']
}
</script>