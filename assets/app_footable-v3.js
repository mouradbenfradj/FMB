import 'footable-v3';
import './app';

jQuery(function ($) {
    FooTable.get('#demo-foo-row-toggler').pageSize(5);

    $('[data-page-size]').on('click', function (e) {
        e.preventDefault();
        var newSize = $(this).data('pageSize');
        FooTable.get('#demo-foo-row-toggler').pageSize(newSize);
    });
});