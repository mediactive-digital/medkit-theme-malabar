{{-- https://www.npmjs.com/package/ckeditor5 --}}

@php 

    $attributes = isset($element['field']['attributes']) ? $element['field']['attributes'] : $options['attr'];
    $value = isset($element['field']['value']) ? $element['field']['value'] : $options['value'];

@endphp

{{-- // js-ck-editor classe a ajouter --}}
<textarea {!! Format::renderHtmlAttributes($attributes) !!}>{{ $value }}</textarea>
                    
@if (!isset($IS_ENABLED_CKEDITOR_TRANSLATABLE))
    @php

        $IS_ENABLED_CKEDITOR_TRANSLATABLE = true;
        View::share ('IS_ENABLED_CKEDITOR_TRANSLATABLE', $IS_ENABLED_CKEDITOR_TRANSLATABLE);
        $ckEditorOpts = isset($element['field']['ckEditorOpts']) ? $element['field']['ckEditorOpts'] : $options['ckEditorOpts'];

    @endphp
    @push('scripts')
        {!! MDAsset::addJs('common.ckeditor') !!}
        <script>

            $(document).ready(function() {

                var elementsCKeditor = Array.prototype.slice.call(document.querySelectorAll('.js-ck-editor'));

                for (var index_ck = 0; index_ck < elementsCKeditor.length; index_ck++) {

                    var the_el = elementsCKeditor[index_ck];

                    ClassicEditor.create(the_el, @json($ckEditorOpts))
                        .then(editor => {

                            editor.model.document.on('change', () => {

                                editor.updateSourceElement();
                            });
                        })
                        .catch(error => {

                        });
                }
            });

        </script>
    @endpush
@endif
