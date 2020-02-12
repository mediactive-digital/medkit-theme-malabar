@if($showLabel && $showField && $options['wrapper'] !== false)
    <div {!! $options['wrapperAttrs'] !!}>
        @endif



        @if ($showLabel && $options['label'] !== false && $options['label_show'])
            {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
        @endif

        @if ($showField)
            {!! Form::select($name.'[]', $options['choices'], null, $options['attr']) !!}

            @if ($options['help_block']['text'] && !$options['is_child'])
                <{!! $options['help_block']['tag'] !!} {!! $options['help_block']['helpBlockAttrs'] !!}>
                {!! $options['help_block']['text'] !!}
    </ {!! $options['help_block']['tag'] !!}>
@endif

@endif


@if($showError && isset($errors) && $errors->hasBag($errorBag))
    @foreach($errors->getBag($errorBag)->get($nameKey) as $err)
        <div {!! $options['errorAttrs'] !!}> {!! $err !!} </div>
    @endforeach
@endif


        @if ($showLabel && $showField && $options['wrapper'] !== false)
        </div>
        @endif

        @push('scripts')
            <script>
                $(document).ready(function() {
                    var elementSelect2 = $('.js-select2');
                    elementSelect2.select2({
                        closeOnSelect: false,
                        selectOnClose: false,
                        multiple: true,
                        allowClear: false
                    });
                    elementSelect2.val([{!! implode($options['selected'],',') !!}]).change();
                });
            </script>
        @endpush

