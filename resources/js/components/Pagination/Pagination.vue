<template>
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span>кол-во: {{ total() }}</span>
                </div>
                <nav v-if="hasPages()">
                    <ul class="pagination mb-0">
                        <!-- Previous Page Link  -->
                        <li v-if="currentPage() != 1" class="page-item">
                            <button class="page-link text-dark"
                                    @click="updatePaginationInstance(previousPageUrl())"
                                    aria-label="Предыдущая страница">&lsaquo;
                            </button>
                        </li>

                        <!-- Pagination Elements -->
                        <!-- "Three Dots" Separator-->
                        <li v-for="(link, index) in getPaginationInstance.links.slice(1, -1)" :key="index"
                            v-if="link.label === '...'"
                            class="page-item disabled"
                            aria-disabled="true">
                            <span class="page-link">{{ link.label }}</span>
                        </li>

                        <!-- Array Of Links -->
                        <li v-else-if="link.active"
                            class="page-item active"
                            aria-current="page">
                            <span class="page-link bg-dark border-dark">{{ link.label }}</span>
                        </li>

                        <li v-else class="page-item">
                            <button class="page-link text-dark" @click="updatePaginationInstance(link.url)">
                                {{ link.label }}
                            </button>
                        </li>

                        <!-- Next Page Link -->
                        <li v-if="hasMorePages()" class="page-item">
                            <button class="page-link text-dark"
                                    @click="updatePaginationInstance(nextPageUrl())"
                                    aria-label="Следующая страница">&rsaquo;
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: "Pagination",
    computed: {
        ...mapGetters(
            ['getPaginationInstance']
        )
    },
    methods: {
        ...mapActions([
            'updatePaginationInstance'
        ]),

        hasPages() {
            return this.getPaginationInstance.links.slice(1, -1).length > 1;
        },
        hasMorePages() {
            return this.nextPageUrl() !== 'null';
        },
        currentPage() {
            return String(this.getPaginationInstance.current_page);
        },
        total() {
            return String(this.getPaginationInstance.total);
        },
        previousPageUrl() {
            return String(this.getPaginationInstance.previous_page_url);
        },
        nextPageUrl() {
            return String(this.getPaginationInstance.next_page_url);
        },
    }
}
</script>
