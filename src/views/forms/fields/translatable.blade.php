@if ($showField && $options['wrapper'])
    <div {!! $options['wrapperAttrs'] !!}>
@endif

    @if ($showLabel && $options['label'] && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif
    
    <ul class="nav nav-pills mb-4" id="myTab_{{ $options['real_name'] }}" role="tablist">
        @if ($showField && $options['value'])
            
                    @foreach($options['value'] as $lang => $element)
                        {{-- {!! $tags['button'] !!} --}}
                        <li class="nav-item">
                            @if ($loop->first)
                                @php
                                    $active = 'active';
                                    $aria = 'true';
                                @endphp
                            @else
                                @php
                                    $active = '';
                                    $aria = 'false';
                                @endphp
                            @endif
                        <{!!$element['button']['type']!!} class="nav-link js-btn-translatable  btn border text-uppercase {{ $active  }}" id="{{ $options['real_name'] }}-{{ $lang }}-tab" data-toggle="tab" href="#{{ $options['real_name'] }}-{{ $lang }}-tabpane" role="tab" aria-controls="{{ $options['real_name'] }}-{{ $lang }}-tabpane" aria-selected="{{ $aria }}">{{$element['button']['value']}}</{!!$element['button']['type']!!}>
                        </li>
                    @endforeach
                
            
        @endif
        </ul>
        <div class="tab-content">
            @if ($showField && $options['value'])
                    @foreach($options['value'] as $lang => $element)
                        {{-- {!! $tags['field'] !!} --}}
                        @if ($loop->first)
                            @php
                                $active = 'active show';
                            @endphp
                        @else
                            @php
                                $active = '';
                            @endphp
                        @endif

                        <div class="tab-pane fade {{ $active }}" id="{{ $options['real_name'] }}-{{ $lang }}-tabpane" role="tabpanel" aria-labelledby="{{ $options['real_name'] }}-{{ $lang }}-tab">
                            @if ($element['field']['type'] == "textarea")
                                @if ($element['field']['ck_editor']) 
                                    @include('medKitTheme::forms.fields.ck_editor', ['field' => $element])
                                @else
                                    <{!!$element['field']['type']!!} name="{{ $element['field']['attributes']['name'] }}"  class="js-input-translatable {{ $element['field']['attributes']['class'] }}">{{ $element['field']['value'] }}</{!!$element['field']['type']!!}>
                                @endif
                            @else
                                <{!!$element['field']['type']!!} type="{{ $element['field']['attributes']['type'] }}" value="{{ $element['field']['attributes']['value'] }}" name="{{ $element['field']['attributes']['name'] }}"  class="js-input-translatable {{ $element['field']['attributes']['class'] }}"/>
                            @endif
                        </div>

                    @endforeach
            @endif
        </div>


    @if($showError && isset($errors) && $errors->hasBag($errorBag))
        @foreach($errors->getBag($errorBag)->getMessages() as $key => $errs)
            @if ($key == $nameKey || Str::startsWith($key, $nameKey . '.'))
                @foreach($errs as $err)
                    <div {!! $options['errorAttrs'] !!}>{{ $err }}</div>
                @endforeach
            @endif
        @endforeach
    @endif
    

@if ($showField && $options['wrapper'])
    </div>
@endif

@if (!isset($IS_ENABLED_TRANSLABLE_CHECKING))
 @php 
    $IS_ENABLED_TRANSLABLE_CHECKING = true;
    View::share ( 'IS_ENABLED_TRANSLABLE_CHECKING', $IS_ENABLED_TRANSLABLE_CHECKING );
 @endphp
    @push('scripts')
        <script>
            jQuery(document).ready(function($) {
                var inputsTranslatable = $(".js-input-translatable");
                var tpl = '<i class="material-icons warning-translatable" data-toggle="tooltip" data-placement="bottom" title="{{ _i("Attention ce champ est vide !") }}">warning</i>';

                $(inputsTranslatable).each(function(i, translatable) {
                    var the_val = $(translatable).val();
                    if(the_val.length === 0) {
                        // fuck off c'est vide...
                        var the_btn = $('#'+ $(translatable).parent().attr('aria-labelledby') );
                        console.log('the_btn', the_btn)
                        var the_check_tooltip = the_btn.find('.warning-translatable');
                        console.log('the_check_tooltip', the_check_tooltip)
                        if(the_check_tooltip.length === 0) {
                            the_btn.append(tpl);
                        }
                    }
                })
                $('.warning-translatable').tooltip();

                

            })
        </script>
    @endpush
@endif
