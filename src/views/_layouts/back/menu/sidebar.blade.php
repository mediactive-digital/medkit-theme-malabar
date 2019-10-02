@php

if(isset($dropdownId)) {
    $id_menu = $dropdownId;
}
else {
    $id_menu = "menu";
}

@endphp
<ul id="{{ $id_menu }}" class="list-unstyled mt-5">
    @foreach($items as $item)

        @php

            $hasChildren = $item->hasChildren();
            $link = $item->link;
            $class = '' . ($hasChildren ? ' has-submenu' : '') . ($hasChildren && $link && $link->isActive ? ' active' : '');

        @endphp

        <li@lm-attrs($item) class="{{ $class }}" @lm-endattrs>
            @if($link) 

                @php

                    $icon = $hasIcon = '';

                    if (!$item->parent) {

                        $icon = $item->data('icon');
                        $icon = $icon ? '<i class="material-icons" aria-hidden="true">' . $icon . '</i>' : '';
                        $hasIcon = $icon ? ' has-icon' : '';
                    }
                    // $dropdownJsAttributes = $hasChildren ? '' : '';

                    $dropdown = $hasChildren ? '<i class="material-icons" aria-hidden="true">keyboard_arrow_down</i>' : '';
                    $hasDropdown = $dropdown ? ' has-dropdown' : '';

                    $title = '<span class="title' . $hasIcon .  '">' . $item->title . '</span>';

                @endphp

                <a@lm-attrs($item->link)  @lm-endattrs data-toggle="collapse" aria-expanded="false" href="{!! $item->url() !!}">{!! $icon !!}{!! $title !!}{!! $dropdown !!}</a>

            @else

                @php 
                    $icon = $hasIcon = '';
                    $icon = $item->data('icon');
                    $icon = $icon ? '<i class="material-icons" aria-hidden="true">' . $icon . '</i>' : '';
                @endphp

                <a href="#"><span class="title">{!! $icon !!}{!! $item->title !!}</span></a>

            @endif

            @if($hasChildren)

                @include(config('laravel-menu.views.back.sidebar'), array('items' => $item->children(), 'dropdownId' => {!! $item->url() !!}))

            @endif
        </li>

        @if($item->divider)

            <li{!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>

        @endif
    @endforeach
</ul>