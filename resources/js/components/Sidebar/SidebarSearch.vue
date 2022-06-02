<template>
    <div class="form-group mb-0">
        <input type="text"
               @input="filterSidebarSections('#sidebar-menu > li:not(:first-child)')"
               v-model="searchingSectionName"
               class="form-control bg-transparent text-white"
               style="border-color: hsla(0, 0%, 100%, .6)"
               placeholder="Поиск..."
        >
    </div>
</template>

<script>
export default {
    name: "SidebarSearch",
    data() {
        return {
            searchingSectionName: ""
        }
    },
    methods: {
        filterSidebarSections(querySelector, parentNode = document) {
            const sections = parentNode.querySelectorAll(querySelector);

            for (let section of sections) {
                const sectionName = this.getSectionName(section);

                if (! sectionName.includes(this.searchingSectionName) && section.getElementsByTagName('ul').length > 0) {
                    this.filterSidebarSections('ul > li', section);
                    this.hideEmptySection(section);
                } else if (sectionName.includes(this.searchingSectionName.toLowerCase().trim())) {
                    this.filterSidebarSections('ul > li', section);
                    this.hideEmptySection(section);
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            }
        },
        getSectionName(section) {
            return section.getElementsByTagName('span')[0].textContent.toLowerCase().trim();
        },
        hideEmptySection(section) {
            const children = section.querySelectorAll('ul > li');
            let counter = 0;

            for (let child of children) {
                if (child.style.display === 'none') {
                    counter++
                }
            }

            if (counter === children.length) {
                section.style.display = 'none';
            } else {
                section.style.display = 'block';
            }

            counter = 0;
        }
    }
}
</script>