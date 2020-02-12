@if ($showLabel && $showField) 
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif

@if ($showLabel && $options['label'] !== false && $options['label_show'])
    {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif

@if ($showField)
    {!! Form::input('file', $name, $options['value'], $options['attr']) !!}
@endif

@if($showError && isset($errors) && $errors->hasBag($errorBag))
    @foreach($errors->getBag($errorBag)->get($nameKey) as $err)
        <div {!! $options['errorAttrs'] !!}> {!! $err !!} </div>
    @endforeach
@endif

@if ($showLabel && $showField) 
    @if ($options['wrapper'] !== false)
    </div>
    @endif
@endif
