<div class="widget-product-categories pt-5 pb-2">
    <div class="container-xxxl">
        <div class="row">
            <div class="col-12">
                <div class="row align-items-center mb-2 widget-header">
                    <h2 class="col-auto mb-0 py-2">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                </div>
                <featured-product-categories-component url="{{ route('public.ajax.featured-product-categories') }}" slick_config="{{ json_encode([
                'rtl' => BaseHelper::siteLanguageDirection() == 'rtl',
                'appendArrows' => '.arrows-wrapper',
                'arrows' => true,
                'dots' => false,
                'autoplay' => $shortcode->is_autoplay == 'yes',
                'infinite' => $shortcode->is_autoplay == 'yes',
                'autoplaySpeed' => in_array($shortcode->autoplay_speed, theme_get_autoplay_speed_options()) ? $shortcode->autoplay_speed : 3000,
                'speed' => 800,
                'slidesToShow' => 8,
                'slidesToScroll' => 1,
                'responsive' => [
                    [
                        'breakpoint' => 1700,
                        'settings' => [
                            'slidesToShow' => 7,
                        ],
                    ],
                    [
                        'breakpoint' => 1500,
                        'settings' => [
                            'slidesToShow' => 6,
                        ],
                    ],
                    [
                        'breakpoint' => 1199,
                        'settings' => [
                            'slidesToShow' => 5,
                        ],
                    ],
                    [
                        'breakpoint' => 1024,
                        'settings' => [
                            'slidesToShow' => 4,
                        ],
                    ],
                    [
                        'breakpoint' => 767,
                        'settings' => [
                            'arrows' => false,
                            'dots' => true,
                            'slidesToShow' => 2,
                            'slidesToScroll' => 2,
                        ],
                    ],
                ],
            ]) }}">
                </featured-product-categories-component>
            </div>
        </div>
    </div>
</div>
