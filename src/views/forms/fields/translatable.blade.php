@if ($showField && $options['wrapper'])
    <li {!! $options['wrapperAttrs'] !!}>
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
                        <{!!$element['button']['type']!!} class="nav-link text-uppercase {{ $active  }}" id="{{ $options['real_name'] }}-{{ $lang }}-tab" data-toggle="tab" href="#{{ $options['real_name'] }}-{{ $lang }}-tabpane" role="tab" aria-controls="{{ $options['real_name'] }}-{{ $lang }}-tabpane" aria-selected="{{ $aria }}">{{$element['button']['value']}}</{!!$element['button']['type']!!}>
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
                                <{!!$element['field']['type']!!} name="{{ $element['field']['attributes']['name'] }}"  class="{{ $element['field']['attributes']['class'] }}">{{ $element['field']['value'] }}</{!!$element['field']['type']!!}>
                            @else
                                <{!!$element['field']['type']!!} type="{{ $element['field']['attributes']['type'] }}" value="{{ $element['field']['attributes']['value'] }}" name="{{ $element['field']['attributes']['name'] }}"  class="{{ $element['field']['attributes']['class'] }}"/>
                            @endif
                        </div>

                    @endforeach
            @endif
        </div>


    @if($showError && isset($errors) && $errors->hasBag($errorBag))
        @foreach($errors->getBag($errorBag)->get($nameKey) as $err)
            <div {!! $options['errorAttrs'] !!}> {!! $err !!} </div>
        @endforeach
    @endif

@if ($showField && $options['wrapper'])
    </div>
@endif
