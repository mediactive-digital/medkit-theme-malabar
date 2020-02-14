@if ($showLabel && $showField) 
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif
{{-- {{ dd($options)}} --}}
@if ($showLabel && $options['label'] !== false && $options['label_show'])
    {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif

@if ($options['basic'] === 'dropzone') 
    @php
        $dropzoneId	= 'dropzone-' . $options['real_name'];
    @endphp

    @if ($showField)
    <div id="{{$dropzoneId}}" class="dropzone">
        {{-- {!! Form::input('file', $name, $options['value'], $options['attr']) !!}  --}}
        {{-- A faire la gestion niveau js pour soumettre le fichier sans l'input  --}}
    </div>
    @endif
@else 
    <label class="zone-input-file" for="{{ $name }}">
        <div class="text-drop-file">Upload</div>
        <div class="text-uploaded-file">Change</div>
        <div class="drop-content-file">Drop here</div>
        {!! Form::input('file', $name, $options['value'], $options['attr']) !!} 
    </label>
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
                console.log('optsFromBack', optsFromBack)

                if(optsFromBack.basic === 'native') {
                    var elInput = $('input[type="file"][name="{{ $name }}"]')
                    var dropZone = $('input[type="file"][name="{{ $name }}"]').parent();
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            
                            reader.onload = function(e) {
                                console.log(e)
                                elInput.parent().css({
                                    'background-image': 'url('+e.target.result+')'
                                });
                                elInput.parent().addClass('have-uploaded-file');
                            }
                            
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    elInput.change(function() {
                        readURL(this);
                    });

                    dropZone.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                    })

                    dropZone.on('dragover dragenter', function() {
                        $(this).addClass('is-dragover');
                    })
                    dropZone.on('dragleave dragend drop', function() {
                        $(this).removeClass('is-dragover');
                    })  
                    
                    dropZone.on('drop',function(e) {
                        var files = e.originalEvent.dataTransfer.files;
                        console.log('dropZone', dropZone)
                        elInput.get(0).files = files;
                        readURL(elInput.get(0));
                        // Now select your file upload field 
                        // $('input_field_file').prop('files',files)
                    });
                }
                else {
                    //dropzone accepted
                    optsFromBack.headers = {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken
                    }
                    <?php 
                        if($options['basic'] === 'dropzone') { ?>
                            var elementCibled = $('#{{$dropzoneId}}');
                        <?php }
                    ?>
                   
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

                    
                    
                    // var myDropzone = new Dropzone(elementCibled.get(0), optsFromBack);
                }
            });
        </script>
    @endpush
