window.ClassicEditor = require('@ckeditor/ckeditor5-build-classic');

let locale = Lang.getLocale();

require('@ckeditor/ckeditor5-build-classic/build/translations/' + locale + '.js');

function MinHeightPlugin(editor) {

  this.editor = editor;
};

MinHeightPlugin.prototype.init = function() {

	const minHeight = this.editor.config.get('minHeight');

	if (minHeight) {

		this.editor.ui.view.editable.extendTemplate({
			attributes: {
				style: {
					minHeight: minHeight
				}
			}
		});
	}
};

ClassicEditor.builtinPlugins.push(MinHeightPlugin);

ClassicEditor.defaultConfig.language = locale;
