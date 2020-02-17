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

                var optsSelect2 = {
                    closeOnSelect: false,
                    selectOnClose: false,
                    multiple: true,
                    allowClear: false
                }
                @if (isset($options['customRenderSelect2']) && count($options['customRenderSelect2']) > 0)
                        var optsFromBackSelect2 = @json($options['customRenderSelect2']);
                        function renderSelect2options(state) {
                            if(state.text.indexOf('Searching') > -1) {
                                return state;
                            }
                            var $state = optsFromBackSelect2.html;
                            // console.log('state', state)
                            // console.log('optsFromBackSelect2', optsFromBackSelect2)

                            if($state.indexOf('##ID##') > -1 ) {
                                $state = $state.replace('##ID##', state.id.toLowerCase());
                            }

                            if($state.indexOf('##TEXT##') > -1 ) {
                                $state = $state.replace('##TEXT##', state.text);
                            }
                            
                            

                            return $($state);
                        }

                        
                        optsSelect2.templateResult = renderSelect2options;
                        optsSelect2.templateSelection = renderSelect2options;
                @endif

                
                


                elementSelect2.select2(optsSelect2);
                @if (isset($options['selected']))
                    elementSelect2.val([{!! implode($options['selected'],',') !!}]).change();
                @endif
            });
        </script>
        @endpush

