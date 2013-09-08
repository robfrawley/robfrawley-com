$(function() {
    $("a[data-popup]").on('click', function(e) {
        window.open($(this)[0].href);
        e.preventDefault();
    });
});