
    @if ($element['field']['type'] == "textarea")
    {{-- //js-ck-editor classe a ajouter --}}
        <{!!$element['field']['type']!!} {!! Format::renderHtmlAttributes($element['field']['attributes']) !!}>{{ $element['field']['value'] }}</{!!$element['field']['type']!!}>
    @endif
                    

{{-- {{ dump(isset($IS_ENABLED_CKEDITOR_TRANSLATABLE) ? 1 : 0) }} --}}
{{-- https://www.npmjs.com/package/ckeditor5 --}}

@if (!isset($IS_ENABLED_CKEDITOR_TRANSLATABLE))
 @php 
    $IS_ENABLED_CKEDITOR_TRANSLATABLE = true;
    View::share ( 'IS_ENABLED_CKEDITOR_TRANSLATABLE', $IS_ENABLED_CKEDITOR_TRANSLATABLE );
 @endphp
    @push('scripts')
        {!! MDAsset::addJs('back.ckeditor') !!}
        <script>
            $(document).ready(function() {
                var elementsCKeditor = Array.prototype.slice.call(document.querySelectorAll('.js-ck-editor'));

                for (var index_ck = 0; index_ck < elementsCKeditor.length; index_ck++) {
                    var the_el = elementsCKeditor[index_ck];
                    ClassicEditor
                    .create( the_el, {
                        removePlugins: [ 'Image', 'ImageToolbar', 'ImageCaption', 'ImageStyle', 'ImageResize' ],
                        image: {}
                    } )
                    .then( editor => {
                    } )
                    .catch( error => {
                        // console.error( error );
                    } );
                }

                // console.log('elementCKeditor', elementCKeditor)
                
            });
        </script>
    @endpush
@endif
