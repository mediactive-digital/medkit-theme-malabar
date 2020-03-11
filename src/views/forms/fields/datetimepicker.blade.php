@if ($showLabel && $showField && $options['wrapper'])
    <div {!! $options['wrapperAttrs'] !!}>
@endif

    @if ($showLabel && $options['label'] && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif

    @if ($showField)

        <div class="input-group date" id="datetimepicker-{{ Str::slug($name, '-') }}" data-target-input="nearest">
            {!! Form::input('text', $name, $options['value'], $options['attr']) !!} 
            {{-- {!! Form::text($name, $options['value'] != null ?  $options['value'] : null, ['class' => 'form-control datetimepicker-input', 'data-target' => '#datetimepicker-{{ Str::slug($name, '-') }}']) !!} --}}
            <div class="input-group-append" data-target="#datetimepicker-{{ Str::slug($name, '-') }}" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="material-icons">movie_creation</i></div>
            </div>
        </div>

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
            // $('input[type="date"][name="{{$name}}"]').datetimepicker();
            $('#datetimepicker-{{ Str::slug($name, '-') }}').datetimepicker();
        })
    </script>
@endpush