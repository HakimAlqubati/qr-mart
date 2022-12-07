<div class="widget-featured-brands py-5">
    <div class="container-xxxl">
        <div class="row">
            <div class="col-12">
                <div class="row align-items-center mb-2 widget-header">
                    <h2 class="col-auto mb-0 py-2">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                </div>
                <featured-brands-component url="{{ route('public.ajax.featured-brands') }}" slick_config="{{ json_encode([
                        'rtl' => BaseHelper::siteLanguageDirection() == 'rtl',
                        'appendArrows' =>  '.arrows-wrapper',
                        'arrows' =>  true,
                        'dots' =>  false,
                        'autoplay' => $shortcode->is_autoplay == 'yes',
                        'infinite' => $shortcode->is_autoplay == 'yes',
                        'autoplaySpeed' => in_array($shortcode->autoplay_speed, theme_get_autoplay_speed_options()) ? $shortcode->autoplay_speed : 3000,
                        'speed' =>  800,
                        'slidesToShow' =>  4,
                        'slidesToScroll' =>  1,
                        'responsive' =>  [
                            [
                                'breakpoint' =>  1024,
                                'settings' =>  [
                                    'slidesToShow' =>  2,
                                ],
                            ],
                            [
                                'breakpoint' =>  767,
                                'settings' =>  [
                                    'arrows' =>  false,
                                    'dots' =>  true,
                                    'slidesToShow' =>  2,
                                    'slidesToScroll' =>  1,
                                ],
                            ],
                        ],
                    ]
                ) }}"></featured-brands-component>
            </div>
        </div>
    </div>
</div>
