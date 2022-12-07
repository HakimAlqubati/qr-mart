<?php

use Botble\Theme\Theme;
use Botble\Base\Enums\BaseStatusEnum;

return [

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials" and "views"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these events can be overridden by package config.
    |
    */

    'events' => [

        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function ($theme)
        {
            // You can remove this line anytime.
        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function (Theme $theme)
        {
            // Partial composer.
            if (is_plugin_active('ecommerce')) {
                $categoriesWith = [
                    'slugable',
                    'children',
                    'children.slugable',
                    'children.children',
                    'children.children.slugable',
                    'metadata',
                ];

                if (is_plugin_active('language-advanced')) {
                    $categoriesWith[] = 'translations';
                    $categoriesWith[] = 'children.translations';
                    $categoriesWith[] = 'children.children.translations';
                }

                $categories = ProductCategoryHelper::getAllProductCategories()
                    ->where('status', BaseStatusEnum::PUBLISHED)
                    ->where('parent_id', 0)
                    ->loadMissing($categoriesWith);

                $theme->partialComposer('header', function ($view) use ($categories) {
                    $view->with('currencies', get_all_currencies());
                    $view->with('categories', $categories);
                });

                $theme->partialComposer('footer', function ($view) use ($categories) {
                    $view->with('categories', $categories);
                });
            }

            // You may use this event to set up your assets.
            $version = '1.1.5';

            if (BaseHelper::siteLanguageDirection() == 'rtl') {
                $theme->asset()->usePath()->add('bootstrap-css', 'plugins/bootstrap/css/bootstrap.rtl.min.css');
            } else {
                $theme->asset()->usePath()->add('bootstrap-css', 'plugins/bootstrap/css/bootstrap.min.css');
            }

            $theme->asset()->usePath()->add('linearicons', 'fonts/Linearicons/Linearicons/Font/demo-files/demo.css');
            $theme->asset()->usePath()->add('slick-css', 'plugins/slick/slick.css');
            $theme->asset()->usePath()->add('nouislider-css', 'plugins/nouislider/nouislider.min.css');
            $theme->asset()->usePath()->add('light-gallery-css', 'plugins/light-gallery/css/lightgallery.min.css');
            $theme->asset()->usePath()->add('style', 'css/style.css', [], [], $version);

            if (BaseHelper::siteLanguageDirection() == 'rtl') {
                $theme->asset()->usePath()->add('style-rtl', 'css/style-rtl.css', [], [], $version);
            }

            $theme->asset()->container('footer')->usePath()
                ->add('jquery', 'plugins/jquery-3.6.0.min.js');
            $theme->asset()->container('footer')->usePath()
                ->add('popper-js', 'plugins/popper.min.js', ['jquery']);
            $theme->asset()->container('footer')->usePath()
                ->add('bootstrap-js', 'plugins/bootstrap/js/bootstrap.min.js', ['jquery']);
            $theme->asset()->container('footer')->usePath()
                ->add('slick-js', 'plugins/slick/slick.min.js', ['jquery']);
            $theme->asset()->container('footer')->usePath()
                ->add('nouislider-js', 'plugins/nouislider/nouislider.min.js', ['jquery']);
            $theme->asset()->container('footer')->usePath()
                ->add('light-gallery-js', 'plugins/light-gallery/js/lightgallery.min.js', ['jquery']);
            $theme->asset()->container('footer')->usePath()
                ->add('lazyload-js', 'plugins/lazyload/lazyload.min.js', ['jquery']);
            $theme->asset()->container('footer')->usePath()
                ->add('expire-countdown-js', 'plugins/expire-countdown.js', ['jquery'], [], $version);
            $theme->asset()->container('footer')->usePath()
                ->add('scrollbar-js', 'plugins/scrollbar.js', ['jquery']);
            $theme->asset()->container('footer')->usePath()
                ->add('main-js', 'js/main.js', ['jquery'], [], $version);
            $theme->asset()->container('footer')->usePath()
                ->add('app-js', 'js/app.js', ['jquery'], [], $version);

            $theme->asset()->container('footer')
                ->add('change-product-swatches', 'vendor/core/plugins/ecommerce/js/change-product-swatches.js',
                    ['jquery'], [], $version);

            if (function_exists('shortcode')) {
                $theme->composer(['page', 'post'], function (\Botble\Shortcode\View\View $view) {
                    $view->withShortcodes();
                });
            }
        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => [

            'default' => function ($theme) {
                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            }
        ]
    ]
];
