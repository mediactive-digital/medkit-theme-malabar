@php

$id = Str::of(Str::replace(['[', ']'], ['-', ''], $options['real_name']))->ltrim('-');

@endphp
@if ($showField && $options['wrapper'])
    <div {!! $options['wrapperAttrs'] !!}>
@endif

    @if ($showLabel && $options['label'] && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif
    
    @if ($showField)
    <ul class="nav nav-pills mb-4" id="nav-{{ $id }}" role="tablist">
        @if ($showField && $options['value'])
            
            @foreach($options['value'] as $lang => $element)
                <li class="nav-item">
                    @php

                        $flag = isset($element['button']['lang']) ? $element['button']['lang'] : '';
                        $active = '';
                        $aria = 'false';

                        if ($loop->first) {

                            $active = ' active';
                            $aria = 'true';
                        }

                    @endphp
                    <{!!$element['button']['type']!!} type="{{ $element['button']['type'] }}" class="nav-link btn-translatable btn border-light d-flex{{ $active }}" id="{{ $id }}-{{ $lang }}-tab" data-bs-toggle="tab" href="#{{ $id }}-{{ $lang }}-tabpane" role="tab" aria-controls="{{ $id }}-{{ $lang }}-tabpane" aria-selected="{{ $aria }}">
                        @if ($flag)
                        <span class="lang-translatable" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ $flag }}">
                        @endif
                            {!! $element['button']['value'] !!}
                        @if ($flag)
                        </span>
                        @endif
                    </{!!$element['button']['type']!!}>
                </li>
            @endforeach
                
        @endif
    </ul>
    <div class="tab-content">
        @if ($showField && $options['value'])
            @foreach($options['value'] as $lang => $element)
                @php

                $element['field']['attributes']['value'] = Form::getValueAttribute($element['field']['attributes']['name'], $element['field']['attributes']['value']);

                @endphp
                @if ($loop->first)
                    @php
                        $active = 'active show';
                    @endphp
                @else
                    @php
                        $active = '';
                    @endphp
                @endif

                <div class="tab-pane fade {{ $active }}" id="{{ $id }}-{{ $lang }}-tabpane" role="tabpanel" aria-labelledby="{{ $id }}-{{ $lang }}-tab">
                    @if ($element['field']['type'] == 'textarea')
                        @if ($element['field']['ck_editor']) 
                            @include('medKitTheme::forms.fields.ck_editor')
                        @else
                            <{!!$element['field']['type']!!} {!! Format::renderHtmlAttributes($element['field']['attributes']) !!}>{{ $element['field']['value'] }}</{!!$element['field']['type']!!}>
                        @endif
                    @else
                        <{!!$element['field']['type']!!} {!! Format::renderHtmlAttributes($element['field']['attributes']) !!}/>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
    @endif

    @if($showError && isset($errors) && $errors->hasBag($errorBag))
        @foreach($errors->getBag($errorBag)->getMessages() as $key => $errs)
            @if ($key == $nameKey || Str::startsWith($key, $nameKey . '.'))
                @foreach($errs as $err)
                    <div {!! $options['errorAttrs'] !!}>{{ $err }}</div>
                @endforeach
            @endif
        @endforeach
    @endif  

@if ($showField && $options['wrapper'])
    </div>
@endif

@if (!isset($IS_ENABLED_TRANSLATABLE))
    @php 

        $IS_ENABLED_TRANSLATABLE = true;
        View::share ('IS_ENABLED_TRANSLATABLE', $IS_ENABLED_TRANSLATABLE);

    @endphp

    @push('scripts')
        <script>

            function setTranslatableWarning(element) {

                var btn = $('#' + element.parent().attr('aria-labelledby'));
                var tooltip = btn.find('.warning-translatable');

                if (element.val() || element.attr('data-val')) {

                    let instance = bootstrap.Tooltip.getInstance(tooltip[0]);

                    if (instance) {

                        instance.dispose();
                    }

                    tooltip.remove();
                }
                else if (!tooltip.length) {

                    btn.append('<i class="material-icons warning-translatable ms-3" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ _i('Ce champ est vide') }}">warning</i>');
                }
            }

            function validateTranslatables(element, event) {

                var form = element.closest('form');
                var translatables = form.find('.js-translatable');

                if (translatables.length && !form[0].checkValidity()) {

                    event.preventDefault();

                    var submit = true;
                    var ckEditor = null;

                    addTranslatablesRequired(translatables);

                    translatables.each(function() {

                        if ($(this).attr('data-required') == 'true' && !$(this).val()) {

                            var parent = $(this).parent();

                            if ($(this).hasClass('js-ck-editor')) {

                                ckEditor = $(this);
                            }
                            else {

                                removeTranslatablesRequired($(this));
                            }
                            
                            if (!parent.hasClass('active')) {

                                $('#' + parent.attr('aria-labelledby')).addClass('translatable-validation').trigger('click');

                                submit = false;
                            }

                            return false;
                        }
                    });

                    if (submit) {

                        getTranslatableError(form, ckEditor);
                    }
                }
            }

            function getTranslatableError(form, ckEditor) {

                ckEditor = typeof ckEditor !== 'undefined' ? ckEditor : null;

                if (ckEditor) {

                    ckEditorInstances.get(ckEditor[0]).editing.view.focus();

                    $('html, body').animate({
                        scrollTop: document.body.scrollTop + ckEditor.parent().find('.ck-editor__main').offset().top
                    }, 0);
                }
                else {

                    var tmp = $('<input type="submit" class="d-none" />');

                    form.append(tmp);
                    tmp.trigger('click').remove();
                }

                removeTranslatablesRequired(form.find('.js-translatable[data-required="true"]'));
            }

            function getHiddenTranslatableError(element) {

                element.removeClass('translatable-validation');

                getTranslatableError(element.closest('form'), (ckEditor = $(element.attr('href')).find('.js-ck-editor')) && ckEditor.length ? ckEditor : null);
            }

            function addTranslatablesRequired(elements) {

                elements.filter('[required]').removeAttr('required').attr('data-required', true);
            }

            function removeTranslatablesRequired(elements) {

                elements.removeAttr('data-required').attr('required', 'required');
            }

            $(document).ready(function() {

                $('.js-translatable').each(function() {

                    setTranslatableWarning($(this));

                    new MutationObserver(() => {

                            setTranslatableWarning($(this));
                        })
                        .observe(this, {
                            childList: true,
                            subtree: true
                        });

                }).on('input', function() {

                    setTranslatableWarning($(this));
                });

                $('form [type="submit"]').on('click', function(e) {

                    validateTranslatables($(this), e);
                });

                $('body').on('shown.bs.tab', '.translatable-validation', function() {

                    getHiddenTranslatableError($(this));
                });
            });

        </script>
    @endpush
@endif
