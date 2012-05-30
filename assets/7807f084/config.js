/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
    config.language = 'pt-br';
    // config.uiColor = '#AADC6E';
    
    // Disable spellchecker
    config.scayt_autoStartup = false;
    
    config.toolbar = 'Personalizado';

    config.toolbar_Personalizado =
    [
    ['Source'],
    ['Bold','Italic','-','FontSize','TextColor'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['NumberedList','BulletedList','-','Link','Unlink','-','Image','RemoveFormat']
    ];

    config.filebrowserBrowseUrl = CKEDITOR.basePath + 'ckfinder/ckfinder.html',
    config.filebrowserImageBrowseUrl = CKEDITOR.basePath + 'ckfinder/ckfinder.html?type=Images',
    config.filebrowserFlashBrowseUrl = CKEDITOR.basePath + 'ckfinder/ckfinder.html?type=Flash',
    config.filebrowserUploadUrl = CKEDITOR.basePath + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    config.filebrowserImageUploadUrl = CKEDITOR.basePath + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    config.filebrowserFlashUploadUrl = CKEDITOR.basePath + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
};
