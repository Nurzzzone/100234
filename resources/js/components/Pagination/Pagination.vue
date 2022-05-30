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
                                    @click="changeCurrentPage(previousPageUrl())"
                                    aria-label="Предыдущая страница">&lsaquo;
                            </button>
                        </li>

                        <!-- Pagination Elements -->
                        <!-- "Three Dots" Separator-->
                        <li v-for="(link, index) in pagination.links.slice(1, -1)" :key="index"
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
                            <button class="page-link text-dark" @click="changeCurrentPage(link.url)">
                                {{ link.label }}
                            </button>
                        </li>

                        <!-- Next Page Link -->
                        <li v-if="hasMorePages()" class="page-item">
                            <button class="page-link text-dark"
                                    @click="changeCurrentPage(nextPageUrl())"
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
export default {
    name: "Pagination",
    props: {
        pagination: Object,
        perPage: Number,
        searchKeyword: String,
    },
    methods: {
        hasPages() {
            return this.pagination.links.slice(1, -1).length > 1;
        },
        hasMorePages() {
            return this.nextPageUrl() !== 'null';
        },
        currentPage() {
            return String(this.pagination.current_page);
        },
        total() {
            return String(this.pagination.total);
        },
        previousPageUrl() {
            return String(this.pagination.previous_page_url);
        },
        nextPageUrl() {
            return String(this.pagination.next_page_url);
        },
        changeCurrentPage(url) {
            axios.get(url, {
                params: {
                    perPage: this.perPage,
                    searchKeyword: this.searchKeyword,
                }
            }).then((response) => {
                this.$parent.updatePaginationInstance(response.data);
            });
        }
    }
}
</script>