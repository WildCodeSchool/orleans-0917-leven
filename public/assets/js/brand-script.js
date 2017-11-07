CKEDITOR.replace( 'introduction_text', {
    customConfig: 'ckeditor_config_brand.js',
    language: 'fr'
});

CKEDITOR.replace( 'article_text', {
    customConfig: 'ckeditor_config_list.js',
    language: 'fr'
});

var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
    var label	 = input.nextElementSibling,
        labelVal = label.innerHTML;

    input.addEventListener( 'change', function( e )
    {
        var fileName = '';
        fileName = e.target.value.split( '\\' ).pop();

        label.innerHTML = fileName;
    });
});