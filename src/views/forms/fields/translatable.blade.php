@if ($showField && $options['wrapper'])
    <div {!! $options['wrapperAttrs'] !!}>
@endif

    @if ($showLabel && $options['label'] && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif

    @if ($showField)
        @foreach($options['value'] as $lang => $value)
            <div class="form-group">
                {!! Form::customLabel($name . '[' . $lang . ']', $lang, ['class' => 'control-label']) !!}
                {!! $value !!}
            </div>
        @endforeach
    @endif

    @if($showError && isset($errors) && $errors->hasBag($errorBag))
        @foreach($errors->getBag($errorBag)->get($nameKey) as $err)
            <div {!! $options['errorAttrs'] !!}> {!! $err !!} </div>
        @endforeach
    @endif

@if ($showField && $options['wrapper'])
    </div>
@endif
