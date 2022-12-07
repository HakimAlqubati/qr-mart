@php
    $categories->loadMissing(['slugable', 'children:id,name,parent_id', 'children.slugable']);

    if (!empty($categoriesRequest)) {
        $categories = $categories->whereIn('id', $categoriesRequest);
    }
@endphp

<ul>
    @if (!empty($categoriesRequest))
        <li class="category-filter">
            <a class="nav-list__item-link" href="{{ route('public.products') }}">
                <span class="cat-menu-close svg-icon">
                    <svg>
                        <use href="#svg-icon-chevron-left" xlink:href="#svg-icon-close"></use>
                    </svg>
                </span>
                <span>{{ __('All categories') }}</span>
            </a>
        </li>
    @endif

    @foreach($categories as $category)
        <li class="category-filter @if ($urlCurrent == $category->url || (!empty($categoriesRequest && in_array($category->id, $categoriesRequest))) || ($loop->first && $categoriesRequest && $categories->count() == 1 && $category->children->count())) opened @endif">
            <div class="widget-layered-nav-list__item">
                <div class="nav-list__item-title">
                    <a class="nav-list__item-link @if ($urlCurrent == $category->url || (!empty($categoriesRequest && in_array($category->id, $categoriesRequest))) || ($loop->first && $categoriesRequest && $categories->count() == 1 && $category->children->count())) active @endif"
                        href="{{ $category->url }}" data-id="{{ $category->id }}">
                        <span>{{ $category->name }}</span>
                    </a>
                </div>
                @if ($category->children->count())
                    <span class="cat-menu-close svg-icon">
                        <svg>
                            <use href="#svg-icon-close" xlink:href="#svg-icon-close"></use>
                        </svg>
                    </span>
                @endif
            </div>
            @if ($category->children->count())
                @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.categories', compact('urlCurrent') + [
                        'categories'        => $category->children,
                        'categoriesRequest' => [],
                    ])
            @endif
        </li>
    @endforeach
</ul>
