@if ($showField && $options['wrapper'])
    <div {!! $options['wrapperAttrs'] !!}>
@endif

    @if ($showLabel && $options['label'] && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif

    @if ($options['basic'] === 'dropzone')
        @if ($showField)
            <div id="{{ 'dropzone-' . $options['real_name'] }}" class="dropzone">
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
            <div {!! $options['errorAttrs'] !!}>{!! $err !!}</div>
        @endforeach
    @endif

    {{-- // C'est pas génial mais je ferai une repasse Ludo. --}}
    

@if ($showField && $options['wrapper'])
    </div>
@endif

@push('scripts')
    <script>

        $(document).ready(function() {

            var optsFromBack = @json($options);

            if (optsFromBack.basic === 'native') {

                var elInput = $('#{{ $options['attr']['id'] }}');
                var dropZone = elInput.parent();

                function readURL(input) {

                    if (input.files && input.files[0]) {

                        var reader = new FileReader();
                        var elInput = $(input);
                        
                        reader.onload = function(e) {

                            elInput.parent().css({
                                'background-image': 'url(' + e.target.result + ')'
                            });

                            elInput.parent().addClass('have-uploaded-file');
                        }
                        
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                elInput.change(function() {

                    var type = $(this).get(0).files.length ? $(this).get(0).files[0].type : '';

                    if (type.indexOf('video') === -1) {

                        $(this).parent().removeClass('is-video-image');
                        readURL($(this).get(0));
                    }
                    else {

                        $(this).parent().css({'background-image': ''});
                        $(this).parent().addClass('is-video-image');
                    }
                });

                dropZone.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {

                    e.preventDefault();
                    e.stopPropagation();
                })

                dropZone.on('dragover dragenter', function() {

                    $(this).addClass('is-dragover');
                });

                dropZone.on('dragleave dragend drop', function() {

                    $(this).removeClass('is-dragover');
                });
                
                dropZone.on('drop', function(e) {

                    var files = e.originalEvent.dataTransfer.files;
                    var elInput = $(this).find('input[type="file"]');

                    var accepts = elInput.attr('accept');
                    var acceptedFile = true; // boolean pour définir si on affiche un message d'erreur..
                    var refusedCount = 0;
                    
                    if(accepts != null && accepts.length > 0) {
                        // ici on checke le fait que l'attribut existe et n'est pas vide..
                        var acceptsFormats = [];
                        // le type accepts peux avoir "une liste" d'extension valable
                        // on split au cas ou si plusieurs extensions requises puis on trimera la chaine de caractère après
                        // sinon bah on pousse la valeur dans un tableau.
                        if(accepts.indexOf(',') > -1) {
                            acceptsFormats = accepts.split(',')
                        }
                        else {
                            acceptsFormats.push(accepts);
                        }

                        // je ne choisi pas volontairement la méthode includes pour les array 
                        //car je ne sais pas si le polyfill de cette méthode est intégrée.
                        // je fais uniquement par une comparaison via le indexOf de deux chaines de caractère.

                        for (var format of acceptsFormats) {
                            //console.log('format ?', format) 
                            
                            // ex : image/*, application/... etc...
                            let spl = undefined;
                            let matcherStr;
                            if(format.indexOf('/') > -1) {
                                spl = format.split('/')
                                //console.log('spl', spl);
                                matcherStr = spl[0].trim();
                            }
                            // ex : .png, .gif etc...
                            else {
                                spl = format.substr(1);
                                //console.log('spl', spl);
                                matcherStr = spl.trim();
                            }

                            //console.log('ya match ou pas ?', files[0].type.indexOf(matcherStr))

                            let comparaison = files[0].type.indexOf(matcherStr);

                            if(comparaison === -1) {
                                // on a pas un matchin
                                refusedCount++;
                            }
                            
                        }

                        if(acceptsFormats.length === refusedCount) {
                            // du coup c'est ici que l'on sait si le fichier uploadé passe réellement pour le drop
                            acceptedFile = false;
                        }
                    }

                    if(acceptedFile == false) {
                        var tplAlert = '';
                        tplAlert += '<div id="alertErrorUploadDropzone" class="alert alert-danger alert-dismissible fade show" role="alert">';
                         tplAlert += '<b>Attention !</b> Ce type de fichier n\'a pas été pris en compte. Seuls les types suivants sont acceptés : '+ accepts +'<br>';
                         tplAlert +=  '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                         tplAlert +=  '<span aria-hidden="true">&times;</span>';
                         tplAlert +=   '</button>';
                         tplAlert +=' </div>';
                        elInput.parent().parent().append(tplAlert);
                        elInput.parent().addClass('has-error');
                        return false;
                    }

                    elInput.get(0).files = files;

                    //console.log(files[0])
                    
                    
                    if (files[0].type.indexOf('video') === -1) {

                        elInput.parent().removeClass('is-video-image');
                        elInput.parent().removeClass('has-error');
                        $('#alertErrorUploadDropzone').remove()
                        readURL(elInput.get(0));
                    }
                    else {

                        elInput.parent().css({'background-image': ''});
                        elInput.parent().removeClass('has-error');
                        $('#alertErrorUploadDropzone').remove()
                        elInput.parent().addClass('is-video-image');
                    }

                    // Now select your file upload field 
                    // $('input_field_file').prop('files',files);
                });
            }
            else {

                /* // dropzone accepted
                optsFromBack.headers = {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                };

                @php

                    if ($options['basic'] === 'dropzone') {

                @endphp
                        
                        var elementCibled = $('#{{ $options['attr']['id'] }}');

                @php

                    }

                @endphp
               
                optsFromBack.init = function() {

                    // set value of your hidden input field here
                    this.on('addedfile', function(file) {

                        if (!optsFromBack.autoQueue) {

                            // elementCibled.get(0).files[0] = file;
                        }

                        // alert('Added file.'); 
                    });
                    this.on('removedfile', function(file) { 

                        if (!optsFromBack.autoQueue) {

                            // elementCibled.val('');
                        }

                        // alert('Removed file.'); 
                    });
                } */
            }
        });

    </script>
@endpush
