<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- Fonts-->
        <link href="https://fonts.googleapis.com/css?family=<?php echo e(urlencode(theme_option('primary_font', 'Muli'))); ?>:400,600,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">
        <!-- CSS Library-->

        <style>
            :root {
                --primary-font: '<?php echo e(theme_option('primary_font', 'Muli')); ?>', sans-serif;
                --primary-color: <?php echo e(theme_option('primary_color', '#fab528')); ?>;
                --heading-color: <?php echo e(theme_option('heading_color', '#000')); ?>;
                --text-color: <?php echo e(theme_option('text_color', '#000')); ?>;
                --primary-button-color: <?php echo e(theme_option('primary_button_color', '#000')); ?>;
                --top-header-background-color: <?php echo e(theme_option('top_header_background_color', '#f7f7f7')); ?>;
                --middle-header-background-color: <?php echo e(theme_option('middle_header_background_color', '#fff')); ?>;
                --bottom-header-background-color: <?php echo e(theme_option('bottom_header_background_color', '#fff')); ?>;
                --header-text-color: <?php echo e(theme_option('header_text_color', '#000')); ?>;
                --footer-text-color: <?php echo e(theme_option('footer_text_color', '#555')); ?>;
                --footer-heading-color: <?php echo e(theme_option('footer_heading_color', '#555')); ?>;
                --footer-hover-color: <?php echo e(theme_option('footer_hover_color', '#fab528')); ?>;
                --footer-border-color: <?php echo e(theme_option('footer_border_color', '#dee2e6')); ?>;
            }
        </style>

        <?php echo Theme::header(); ?>

    </head>
    <body <?php if(BaseHelper::siteLanguageDirection() == 'rtl'): ?> dir="rtl" <?php endif; ?> <?php if(Theme::get('bodyClass')): ?> class="<?php echo e(Theme::get('bodyClass')); ?>" <?php endif; ?>>
        <?php if(theme_option('preloader_enabled', 'yes') == 'yes'): ?>
            <div class="preloader" id="preloader">
                <div class="preloader-loading"></div>
            </div>
        <?php endif; ?>

        <?php echo Theme::partial('svg-icons'); ?>

        <?php echo apply_filters(THEME_FRONT_BODY, null); ?>


        <header class="header header-js-handler" data-sticky="<?php echo e(theme_option('sticky_header_enabled', 'yes') == 'yes' ? 'true' : 'false'); ?>">
            <div class="header-top d-none d-lg-block">
                <div class="container-xxxl">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <div class="header-info">
                                <?php echo Menu::renderMenuLocation('header-navigation'); ?>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="header-info header-info-right">
                                <ul>
                                    <?php if(is_plugin_active('language')): ?>
                                        <?php echo Theme::partial('language-switcher'); ?>

                                    <?php endif; ?>
                                    <?php if(is_plugin_active('ecommerce')): ?>
                                        <?php if(count($currencies) > 1): ?>
                                            <li>
                                                <a class="language-dropdown-active" href="#">
                                                    <span><?php echo e(get_application_currency()->title); ?></span>
                                                    <span class="svg-icon">
                                                        <svg>
                                                            <use href="#svg-icon-chevron-down" xlink:href="#svg-icon-chevron-down"></use>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <ul class="language-dropdown">
                                                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($currency->id !== get_application_currency_id()): ?>
                                                            <li>
                                                                <a href="<?php echo e(route('public.change-currency', $currency->title)); ?>">
                                                                    <span><?php echo e($currency->title); ?></span>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(auth('customer')->check()): ?>
                                            <li>
                                                <a href="<?php echo e(route('customer.overview')); ?>"><?php echo e(auth('customer')->user()->name); ?></a> <span class="d-inline-block ms-1">(<a href="<?php echo e(route('customer.logout')); ?>" class="color-primary"><?php echo e(__('Logout')); ?></a>)</span>
                                            </li>
                                        <?php else: ?>
                                            <li><a href="<?php echo e(route('customer.login')); ?>"><?php echo e(__('Login / Register')); ?></a></li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle">
                <div class="container-xxxl">
                    <div class="header-wrapper">
                        <div class="header-items header__left">
                            <?php if(theme_option('logo')): ?>
                                <div class="logo">
                                    <a href="<?php echo e(route('public.index')); ?>">
                                        <img src="<?php echo e(RvMedia::getImageUrl(theme_option('logo'))); ?>" alt="<?php echo e(theme_option('site_title')); ?>" />
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="header-items header__center">
                            <?php if(is_plugin_active('ecommerce')): ?>
                                <form class="form--quick-search" action="<?php echo e(route('public.products')); ?>" data-ajax-url="<?php echo e(route('public.ajax.search-products')); ?>" method="get">
                                    <div class="form-group--icon" style="display: none">
                                        <div class="product-category-label">
                                            <span class="text"><?php echo e(__('All Categories')); ?></span>
                                            <span class="svg-icon">
                                                <svg>
                                                    <use href="#svg-icon-chevron-down" xlink:href="#svg-icon-chevron-down"></use>
                                                </svg>
                                            </span>
                                        </div>
                                        <select class="form-control product-category-select" name="categories[]">
                                            <option value="0"><?php echo e(__('All Categories')); ?></option>
                                            <?php $__currentLoopData = ProductCategoryHelper::getProductCategoriesWithIndent(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>"><?php echo BaseHelper::clean($category->indent_text); ?> <?php echo e($category->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <input class="form-control input-search-product" name="q" type="text"
                                        placeholder="<?php echo e(__("I'm shopping for...")); ?>" autocomplete="off">
                                    <button class="btn" type="submit">
                                        <span class="svg-icon">
                                            <svg>
                                                <use href="#svg-icon-search" xlink:href="#svg-icon-search"></use>
                                            </svg>
                                        </span>
                                    </button>
                                    <div class="panel--search-result"></div>
                                </form>
                            <?php endif; ?>
                        </div>
                        <div class="header-items header__right">
                            <?php if(theme_option('hotline')): ?>
                                <div class="header__extra header-support">
                                    <div class="Just Landing">
                                        <span><?php echo e(theme_option('hotline')); asdas ?></span>
                                        <p><?php echo e(__('Support 24/7')); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if(is_plugin_active('ecommerce')): ?>
                                <?php if(EcommerceHelper::isCompareEnabled()): ?>
                                    <div class="header__extra header-compare">
                                        <a class="btn-compare" href="<?php echo e(route('public.compare')); ?>">
                                            <i class="icon-repeat"></i>
                                            <span class="header-item-counter"><?php echo e(Cart::instance('compare')->count()); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if(EcommerceHelper::isWishlistEnabled()): ?>
                                    <div class="header__extra header-wishlist">
                                        <a class="btn-wishlist" href="<?php echo e(route('public.wishlist')); ?>">
                                            <span class="svg-icon">
                                                <svg>
                                                    <use href="#svg-icon-wishlist" xlink:href="#svg-icon-wishlist"></use>
                                                </svg>
                                            </span>
                                            <span class="header-item-counter">
                                                <?php echo e(auth('customer')->check() ? auth('customer')->user()->wishlist()->count() : Cart::instance('wishlist')->count()); ?>

                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if(EcommerceHelper::isCartEnabled()): ?>
                                    <div class="header__extra cart--mini" tabindex="0" role="button">
                                        <div class="header__extra">
                                            <a class="btn-shopping-cart" href="<?php echo e(route('public.cart')); ?>">
                                                <span class="svg-icon">
                                                    <svg>
                                                        <use href="#svg-icon-cart" xlink:href="#svg-icon-cart"></use>
                                                    </svg>
                                                </span>
                                                <span class="header-item-counter"><?php echo e(Cart::instance('cart')->count()); ?></span>
                                            </a>
                                            <span class="cart-text">
                                                <span class="cart-title"><?php echo e(__('Your Cart')); ?></span>
                                                <span class="cart-price-total">
                                                    <span class="cart-amount">
                                                        <bdi>
                                                            <span><?php echo e(format_price(Cart::instance('cart')->rawSubTotal())); ?></span>
                                                        </bdi>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="cart__content" id="cart-mobile">
                                            <div class="backdrop"></div>
                                            <div class="mini-cart-content">
                                                <div class="widget-shopping-cart-content">
                                                    <?php echo Theme::partial('cart-mini.list'); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="header-wrapper">
                    <nav class="navigation">
                        <div class="container-xxxl">
                            <div class="navigation__left">
                                <?php if(is_plugin_active('ecommerce')): ?>
                                    <div class="menu--product-categories">
                                        <div class="menu__toggle">
                                            <span class="svg-icon">
                                                <svg>
                                                    <use href="#svg-icon-list" xlink:href="#svg-icon-list"></use>
                                                </svg>
                                            </span>
                                            <span class="menu__toggle-title"><?php echo e(__('Shop by Category')); ?></span>
                                        </div>
                                        <div class="menu__content">
                                            <ul class="menu--dropdown">
                                                <?php echo Theme::partial('product-categories-dropdown', compact('categories')); ?>

                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="navigation__center">
                                <?php echo Menu::renderMenuLocation('main-menu', [
                                    'view'    => 'menu',
                                    'options' => ['class' => 'menu'],
                                ]); ?>

                            </div>
                            <div class="navigation__right">
                                <?php if(is_plugin_active('ecommerce') && EcommerceHelper::isEnabledCustomerRecentlyViewedProducts()): ?>
                                    <div class="header-recently-viewed" data-url="<?php echo e(route('public.ajax.recently-viewed-products')); ?>" role="button">
                                        <h3 class="recently-title">
                                            <span class="svg-icon recent-icon">
                                                <svg>
                                                    <use href="#svg-icon-refresh" xlink:href="#svg-icon-refresh"></use>
                                                </svg>
                                            </span>
                                            <?php echo e(__('Recently Viewed')); ?>

                                        </h3>
                                        <div class="recently-viewed-inner container-xxxl">
                                            <div class="recently-viewed-content">
                                                <div class="loading--wrapper">
                                                    <div class="loading"></div>
                                                </div>
                                                <div class="recently-viewed-products"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="header-mobile header-js-handler" data-sticky="<?php echo e(theme_option('sticky_header_mobile_enabled', 'yes') == 'yes' ? 'true' : 'false'); ?>">
                <div class="header-items-mobile header-items-mobile--left">
                    <div class="menu-mobile">
                        <div class="menu-box-title">
                            <div class="icon menu-icon toggle--sidebar" href="#menu-mobile">
                                <span class="svg-icon">
                                    <svg>
                                        <use href="#svg-icon-list" xlink:href="#svg-icon-list"></use>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-items-mobile header-items-mobile--center">
                    <?php if(theme_option('logo')): ?>
                        <div class="logo">
                            <a href="<?php echo e(route('public.index')); ?>">
                                <img src="<?php echo e(RvMedia::getImageUrl(theme_option('logo'))); ?>" alt="<?php echo e(theme_option('site_title')); ?>" width="155" />
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="header-items-mobile header-items-mobile--right">
                    <div class="search-form--mobile search-form--mobile-right search-panel">
                        <a class="open-search-panel toggle--sidebar" href="#search-mobile">
                            <span class="svg-icon">
                                <svg>
                                    <use href="#svg-icon-search" xlink:href="#svg-icon-search"></use>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </header>
<?php /**PATH /Users/ngogiadiep/Downloads/codecanyon-w1W6d92H-farmart-single-or-multivendor-laravel-ecommerce-system/main/platform/themes/farmart/partials/header.blade.php ENDPATH**/ ?>
