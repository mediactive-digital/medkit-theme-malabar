{{-- https://www.npmjs.com/package/ckeditor5 --}}

@php

    $isTranslatable = isset($element);
    $attributes = $isTranslatable ? $element['field']['attributes'] : $options['attr'];
    $value = $isTranslatable ? $element['field']['value'] : $options['value'];
    $ckEditorOptions = $isTranslatable ? $element['field']['ckEditorOpts'] : $options['ckEditorOpts'];
    $id = $isTranslatable ? $element['field']['attributes']['id'] : $options['attr']['id'];

@endphp

@if (!$isTranslatable)
    @if ($showField && $options['wrapper'])
        <div {!! $options['wrapperAttrs'] !!}>
    @endif

        @if ($showLabel && $options['label'] && $options['label_show'])
            {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
        @endif
@endif

        @if ($showField)
            {{-- // js-ck-editor classe a ajouter --}}
            <textarea {!! Format::renderHtmlAttributes($attributes) !!}>{{ $value }}</textarea>
        @endif

@if (!$isTranslatable)
        @if ($showError && isset($errors) && $errors->hasBag($errorBag))
            @foreach($errors->getBag($errorBag)->get($nameKey) as $err)
                <div {!! $options['errorAttrs'] !!}>{!! $err !!}</div>
            @endforeach
        @endif

    @if ($showField && $options['wrapper'])
        </div>
    @endif
@endif
                    
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

            ClassicEditor.create(ckEditor, @json($ckEditorOptions))
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
