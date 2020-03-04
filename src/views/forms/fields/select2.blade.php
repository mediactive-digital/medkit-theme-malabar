@if($showLabel && $showField && $options['wrapper'] !== false)
	<div {!! $options['wrapperAttrs'] !!}>
@endif

@if ($showLabel && $options['label'] !== false && $options['label_show'])
	{!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif

@if ($showField)
	@php
	if( isset($options['select2Opts']['multiple']) && $options['select2Opts']['multiple']){
	$options['attr']['id'] = $name;
	}
	@endphp

	{!! Form::select($name.(isset($options['select2Opts']['multiple']) && $options['select2Opts']['multiple'] ? '[]' : ''), $options['choices'],  $options['select2Opts']['multiple'] ? null : $options['value'], $options['attr']) !!}

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
<?php
 //dump( $options );
?>
 
@push('scripts')
<script>
	$(document).ready(function () {

		var element{{$name}}Select2 = $('#{{$name}}');
		var opts{{$name}}Select2 = @json($options['select2Opts']);

		@if (isset($options['customRenderSelect2']) && count($options['customRenderSelect2']) > 0)
			var opts{{$name}}FromBackSelect2 = @json($options['customRenderSelect2']);

			function render{{$name}}Select2options(state) {
				if (state.text.indexOf('Searching') > -1) {
					return state;
				}
				
				var $state = opts{{$name}}FromBackSelect2.html;
				// console.log('state', state)
				// console.log('opts{{$name}}FromBackSelect2', opts{{$name}}FromBackSelect2)

				if ($state.indexOf('##ID##') > -1) {
					$state = $state.replace('##ID##', state.id.toLowerCase());
				}

				if ($state.indexOf('##TEXT##') > -1) {
					$state = $state.replace('##TEXT##', state.text);
				}

				return $($state);
			}

			opts{{$name}}Select2.templateResult = render{{$name}}Select2options;
			// opts{{$name}}Select2.templateSelection = renderSelect2options;
		@endif

		element{{$name}}Select2.select2(opts{{$name}}Select2);
		
		@if (isset($options['selected']))
			element{{$name}}Select2.val([ {!! implode(',', $options['selected']) !!} ]).change();
		@endif
	});
</script>
@endpush
