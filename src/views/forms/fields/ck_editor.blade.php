@if ($showField && $options['wrapper'])
    <div {!! $options['wrapperAttrs'] !!}>
@endif

    @if ($showLabel && $options['label'] && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif

    @if ($showField && $options['value'])
        <div class="form-group">
            @foreach($options['value'] as $tags)
                {!! $tags['button'] !!}
            @endforeach
        </div>

        <div class="form-group">
            @foreach($options['value'] as $tags)
                {!! $tags['field'] !!}
            @endforeach
        </div>
    @endif

    @if($showError && isset($errors) && $errors->hasBag($errorBag))
        @foreach($errors->getBag($errorBag)->get($nameKey) as $err)
            <div {!! $options['errorAttrs'] !!}> {!! $err !!} </div>
        @endforeach
    @endif

@if ($showField && $options['wrapper'])
    </div>
@endif
