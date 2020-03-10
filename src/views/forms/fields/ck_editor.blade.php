{{-- https://www.npmjs.com/package/ckeditor5 --}}

@php 

    $attributes = isset($element['field']['attributes']) ? $element['field']['attributes'] : $options['attr'];
    $value = isset($element['field']['value']) ? $element['field']['value'] : $options['value'];
    $options = isset($element['field']['ckEditorOpts']) ? $element['field']['ckEditorOpts'] : $options['ckEditorOpts'];
    $id = isset($element['field']['attributes']['id']) ? $element['field']['attributes']['id'] : $options['attr']['id'];

@endphp

{{-- // js-ck-editor classe a ajouter --}}
<textarea {!! Format::renderHtmlAttributes($attributes) !!}>{{ $value }}</textarea>
                    
@push('scripts')
    @if (!isset($IS_ENABLED_CK_EDITOR))
        @php

            $IS_ENABLED_CK_EDITOR = true;
            View::share('IS_ENABLED_CK_EDITOR', $IS_ENABLED_CK_EDITOR);

        @endphp

        {!! MDAsset::addJs('common.ckeditor') !!}
        <script>

            const ckEditorInstances = new Map();

        </script>
    @endif

    <script>

        $(document).ready(function() {

            var ckEditor = document.getElementById('{{ $id }}');

            ClassicEditor.create(ckEditor, @json($options))
                .then(editor => {

                    editor.model.document.on('change', () => {

                        editor.updateSourceElement();
                    });

                    ckEditorInstances.set(ckEditor, editor);
                })
                .catch(error => {

                });
        });

    </script>
@endpush
