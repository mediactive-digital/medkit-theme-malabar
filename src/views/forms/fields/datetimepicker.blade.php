@if ($showLabel && $showField && $options['wrapper'])
    <div {!! $options['wrapperAttrs'] !!}>
@endif

    @if ($showLabel && $options['label'] && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif

    @if ($showField)

        {!! Form::date($name) !!}

        @if ($options['help_block']['text'] && !$options['is_child'])
            <{!! $options['help_block']['tag'] !!} {!! $options['help_block']['helpBlockAttrs'] !!}>
                {!! $options['help_block']['text'] !!}
            </ {!! $options['help_block']['tag'] !!}>
        @endif
    @endif

    @if($showError && isset($errors) && $errors->hasBag($errorBag))
        @foreach($errors->getBag($errorBag)->get($nameKey) as $err)
            <div {!! $options['errorAttrs'] !!}>{!! $err !!}</div>
        @endforeach
    @endif

@if ($showLabel && $showField && $options['wrapper'])
    </div>
@endif

@push('scripts')
    <script>
        jQuery(document).ready(function() {
            $('input[type="date"][name="{{$name}}"]').datetimepicker();
        })
    </script>
@endpush