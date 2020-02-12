@if ($showLabel && $showField) 
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif
{{-- {{ dd($options)}} --}}
@if ($showLabel && $options['label'] !== false && $options['label_show'])
    {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif

@if ($showField)
<div class="dropzone">
    {!! Form::input('file', $name, $options['value'], $options['attr']) !!}
</div>
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

    @push('scripts')
        <script>
            $(document).ready(function() {

                var optsFromBack = @json($options['jsDropzoneOpts']);

                var cibledInput = $("input[type='file'][name='{{  $options['real_name'] }}']");

                var elementCibled = cibledInput.parent().get(0);


                optsFromBack.init = function(){
                    //set value of your hidden input field here
                    this.on("addedfile", function(file) { 
                        if(!optsFromBack.autoQueue) {
                            console.log(true);
                            // elementCibled.get(0).files[0] = file;
                        }
                        // alert("Added file."); 
                    });
                    this.on("removedfile", function(file) { 
                        if(!optsFromBack.autoQueue) {
                            // elementCibled.val('');
                        }
                        // alert("Added file."); 
                    });
                }

                var myDropzone = new Dropzone(elementCibled, optsFromBack);

                // console.log('elementCKeditor', elementCKeditor)
                
            });
        </script>
    @endpush
