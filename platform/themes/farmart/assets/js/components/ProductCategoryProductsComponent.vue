<template>
    <div class="product-deals-day__body arrows-top-right">
        <div
            v-if="!isLoading"
            v-slick
            v-lazyload
            class="product-deals-day-body slick-slides-carousel"
            :data-slick="slick_config"
        >
            <div
                v-for="item in data"
                :key="item.id"
                class="product-inner"
                v-html="item"
            ></div>
        </div>
        <div class="arrows-wrapper"></div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            isLoading: true,
            data: [],
            productCategory: {},
            productCategories: [],
        };
    },

    mounted() {
        if (this.category) {
            this.productCategory = this.category;
            this.productCategories = this.children;
            this.getData(this.productCategory);
        } else {
            this.isLoading = false;
        }
    },

    props: {
        category: {
            type: Object,
            default: () => {},
            required: true,
        },
        children: {
            type: Array,
            default: () => [],
        },
        url: {
            type: String,
            default: () => null,
            required: true,
        },
        all: {
            type: String,
            default: () => null,
            required: true,
        },
        limit: {
            type: String,
            default: () => 0,
        },
        slick_config: {
            type: String,
            default: () => null,
            required: true,
        },
    },

    methods: {
        getData(category) {
            this.productCategory = category;
            this.data = [];
            this.isLoading = true;

            let url = this.url + '?category_id=' + category.id;

            if (this.limit) {
                url += '&limit=' + this.limit;
            }

            axios
                .get(url)
                .then(res => {
                    this.data = res.data.data ? res.data.data : [];
                    this.isLoading = false;
                })
                .catch(() => {
                    this.isLoading = false;
                });
        },
    },
};
</script>
