$(function() {
    $('[name=departure]').kladr({
        token: '',
        type: $.kladr.type.city
    });
    $('[name=arrival]').kladr({
        token: '',
        type: $.kladr.type.city
    });
});