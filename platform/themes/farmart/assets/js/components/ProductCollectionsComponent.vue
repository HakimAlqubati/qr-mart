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
            productCollections: [],
            productCollection: {},
        };
    },

    mounted() {
        if (this.product_collections.length) {
            this.productCollections = this.product_collections;
            this.productCollection = this.productCollections[0];
            this.getData(this.productCollection);
        } else {
            this.isLoading = false;
        }
    },

    props: {
        product_collections: {
            type: Array,
            default: () => [],
        },
        title: {
            type: String,
            default: () => null,
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
        slick_config: {
            type: String,
            default: () => null,
            required: true,
        },
    },

    methods: {
        getData(productCollection) {
            this.productCollection = productCollection;
            this.data = [];
            this.isLoading = true;
            axios
                .get(this.url + '?collection_id=' + productCollection.id)
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
