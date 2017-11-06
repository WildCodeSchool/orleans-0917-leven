CKEDITOR.replace( 'content', {
    customConfig: 'ckeditor_config.js',
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