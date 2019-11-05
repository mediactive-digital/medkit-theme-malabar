@php

if(isset($dropdownId)) {
    $id_menu = $dropdownId;
    $isDropdown = "list-unstyled collapse menu-secondaire";
}
else {
    $id_menu = "menu";
    $isDropdown = "list-unstyled mt-5 menu-principal";
}

@endphp
<ul id="{{ $id_menu }}" class="{{ $isDropdown }}">
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
                    // if($hasChildren) {
                    //     dd($item);
                    // }

                    $dropdown = $hasChildren ? '#'.$item->title : $item->url();
                    $dropdownAttrs = $hasChildren ? 'data-toggle="collapse" aria-expanded="false"' : '';
                    $hasDropdown = $dropdown ? ' has-dropdown' : '';

                    $title = '<span class="title' . $hasIcon .  '">' . $item->title . '</span>';

                @endphp

                <a@lm-attrs($item->link)  @lm-endattrs {!! $dropdownAttrs !!}  href="{!! $dropdown !!}">{!! $icon !!}{!! $title !!}</a>

            @else

                @php
                    $icon = $hasIcon = '';
                    $icon = $item->data('icon');
                    $icon = $icon ? '<i class="material-icons" aria-hidden="true">' . $icon . '</i>' : '';

                @endphp

                <a href="#"><span class="title">{!! $icon !!}{!! $item->title !!}</span></a>

            @endif

            @if($hasChildren)

                @include("medKitTheme::_layouts.back.menu.sidebar", array('items' => $item->children(), 'dropdownId' => $item->title ))

            @endif
        </li>

        @if($item->divider)

            <li{!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>

        @endif
    @endforeach
</ul>
