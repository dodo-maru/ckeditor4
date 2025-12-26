Ckeditor 4 Plugins stickers


Add-on installation instructions

If you want to add the plugin manually, you will need to:

1. Extract the downloaded plugin .zip into the plugins folder of your CKEditor installation. Example:

http://example.com/ckeditor/plugins/stickers


2. Enable the plugin by using the extraPlugins configuration setting. Example:

config.extraPlugins = 'stickers';


3. Add Toolbar Button by using the toolbarGroups configuration setting.  Example:

  CKEDITOR.editorConfig = function( config ) {

	config.toolbarGroups = [
		{ name: 'others', groups: [ 'Stickers' ] }
	];
  };


4. Put your's images in Folder
/stickers/images/smile & sticker



