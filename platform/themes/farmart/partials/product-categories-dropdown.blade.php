@foreach ($categories as $category)
    <li @if ($category->children->count()) class="menu-item-has-children has-mega-menu" @endif>
        <a href="{{ $category->url }}">
            <span>{{ $category->name }}</span>
            @if ($category->children->count())
                <span class="sub-toggle">
                    <span class="svg-icon">
                        <svg>
                            <use href="#svg-icon-chevron-right" xlink:href="#svg-icon-chevron-right"></use>
                        </svg>
                    </span>
                </span>
            @endif
        </a>
        @if ($category->children->count())
            <div class="mega-menu">
                @foreach($category->children as $childCategory)
                    <div class="mega-menu__column">
                        @if ($childCategory->children->count())
                            <a href="{{ $childCategory->url }}">
                                <h4>{{ $childCategory->name }}</h4>
                                <span class="sub-toggle">
                                    <span class="svg-icon">
                                        <svg>
                                            <use href="#svg-icon-chevron-right" xlink:href="#svg-icon-chevron-right"></use>
                                        </svg>
                                    </span>
                                </span>
                            </a>
                            <ul class="mega-menu__list">
                                @foreach($childCategory->children as $item)
                                    <li><a href="{{ $item->url }}">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{ $childCategory->url }}">{{ $childCategory->name }}</a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </li>
@endforeach
