/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

'use strict';

import FeaturedProductCategoriesComponent from './components/FeaturedProductCategoriesComponent';
import FeaturedProductsComponent from './components/FeaturedProductsComponent';
import FeaturedBrandsComponent from './components/FeaturedBrandsComponent';
import ProductCollectionsComponent from './components/ProductCollectionsComponent';
import RelatedProductsComponent from './components/RelatedProductsComponent';
import ProductReviewsComponent from './components/ProductReviewsComponent';
import ProductCategoryProductsComponent from "./components/ProductCategoryProductsComponent";
import FlashSaleProductsComponent from "./components/FlashSaleProductsComponent";
import FooterProductCategoriesComponent from "./components/FooterProductCategoriesComponent";
import Vue from 'vue';

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('featured-product-categories-component', FeaturedProductCategoriesComponent);
Vue.component('featured-products-component', FeaturedProductsComponent);
Vue.component('featured-brands-component', FeaturedBrandsComponent);
Vue.component('product-collections-component', ProductCollectionsComponent);
Vue.component('related-products-component', RelatedProductsComponent);
Vue.component('product-reviews-component', ProductReviewsComponent);
Vue.component('product-category-products-component', ProductCategoryProductsComponent);
Vue.component('flash-sale-products-component', FlashSaleProductsComponent);
Vue.component('footer-product-categories-component', FooterProductCategoriesComponent);

/**
 * This let us access the `__` method for localization in VueJS templates
 * ({{ __('key') }})
 */
Vue.prototype.__ = key => {
    return window.trans[key] !== 'undefined' ? window.trans[key] : key;
};

Vue.prototype.siteConfig = window.siteConfig;

Vue.directive('slick', {
    inserted: function (element) {
        MartApp.slickSlide(element);
    },
});

Vue.directive('lazyload', {
    inserted: function (element) {
        new LazyLoad({
            container: element,
            elements_selector: '.lazyload',
        });
    },
});

new Vue({
    el: '#main-content',
});

if ($('#footer-links').length) {
    new Vue({
        el: '#footer-links',
    });
}
