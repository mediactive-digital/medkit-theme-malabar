@if ($showField && $options['wrapper'])
    <div {!! $options['wrapperAttrs'] !!}>
@endif

    @if ($showLabel && $options['label'] && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif

    @if ($showField)
        {!! Form::select($name, $options['choices'], $options['selected'], $options['attr'], $options['options_attr'], $options['opt_groups_attr']) !!}

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

@if ($showField && $options['wrapper'])
    </div>
@endif

@push('scripts')
    <script>

        @if (!isset($IS_ENABLED_SELECT2))
            @php

                $IS_ENABLED_SELECT2 = true;
                View::share('IS_ENABLED_SELECT2', $IS_ENABLED_SELECT2);

            @endphp

            function setSelect2Data(element, options) {

                element.find('option').each(function() {

                    var elementText = $(this).text();
                    var tmp = document.createElement('div');

                    tmp.innerHTML = elementText;
                    $(this).text(tmp.lastChild.textContent || tmp.lastChild.innerText || '');
                    tmp.remove();

                    if (options.html) {

                        var html = options.html;

                        if (html.indexOf('##ID##') > -1) {

                            html = html.replace(/##ID##/g, $(this).val());
                        }

                        if (html.indexOf('##TEXT##') > -1) {

                            html = html.replace(/##TEXT##/g, elementText);
                        }

                        $(this).attr('data-html', html);
                    }
                });
            };

            function getSelect2TemplateResult(state) {

                return (text = $(state.element).attr('data-html')) ? $(text) : state.text;
            };
        @endif

        $(document).ready(function() {

            var element = $('#{{ $options['attr']['id'] }}');
            var options = @json($options['select2Opts']);  

            @if (isset($options['customRenderSelect2']) && $options['customRenderSelect2'])

                setSelect2Data(element, @json($options['customRenderSelect2']));
                
                options.templateResult = getSelect2TemplateResult;

            @endif

            element.select2(options);
        });

    </script>
@endpush
