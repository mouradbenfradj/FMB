import './app.js';
import './app_footable-v3';
import './jsgrid';
import './nestable2';

$(document).ready(function () {
    var $stocks = $('#preparation_corde_stocks');
    var $article = $('#preparation_corde_article');
    var $lot = $('#preparation_corde_lot');
    var $corde = $('#preparation_corde_corde');
    var $datedecreation = $('#preparation_corde_datedecreation');
    var $quantiteEnStock = $('#preparation_corde_quantiteEnStock');
    var $totalqte = $('#preparation_corde_totalqte');

    $corde.change(function () {
        var $form = $(this).closest('form');
        var data = {};
        data[$corde.attr('name')] = $corde.val();
        data[$datedecreation.attr('name')] = $datedecreation.val();
        data[$stocks.attr('name')] = $stocks.val();
        data[$article.attr('name')] = $article.val();
        data[$lot.attr('name')] = $lot.val();
        data[$quantiteEnStock.attr('name')] = $quantiteEnStock.val();
        data[$totalqte.attr('name')] = $totalqte.val();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                $quantiteEnStock.val($(html).find('#preparation_corde_quantiteEnStock').val());
            },
        });
    });
    $stocks.change(function () {
        var $form = $(this).closest('form');
        var data = {};
        data[$corde.attr('name')] = $corde.val();
        data[$datedecreation.attr('name')] = $datedecreation.val();
        data[$stocks.attr('name')] = $stocks.val();
        data[$article.attr('name')] = $article.val();
        data[$lot.attr('name')] = $lot.val();
        data[$quantiteEnStock.attr('name')] = $quantiteEnStock.val();
        data[$totalqte.attr('name')] = $totalqte.val();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                var articles = $(html).find('#preparation_corde_article');
                var options = '';
                console.log(articles);
                var options = '';
                $(article).find('option').each(function () {
                    options += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';
                });
                $('#preparation_corde_article').html(articles);
                var lots = $(html).find('#preparation_corde_lot');
                var options = '';
                lots.find('option').each(function () {
                    options += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';
                });
                $('#preparation_corde_lot').html(options);

                var totalQte = $(html).find('#preparation_corde_totalqte').val();
                $('#preparation_corde_totalqte').val(totalQte);
            },
        });
    });

    $article.change(function () {
        var $form = $(this).closest('form');
        var data = {};
        data[$corde.attr('name')] = $corde.val();
        data[$datedecreation.attr('name')] = $datedecreation.val();
        data[$stocks.attr('name')] = $stocks.val();
        data[$article.attr('name')] = $article.val();
        data[$lot.attr('name')] = $lot.val();
        data[$quantiteEnStock.attr('name')] = $quantiteEnStock.val();
        data[$totalqte.attr('name')] = $totalqte.val();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                console.log(html);
                var lots = $(html).find('#preparation_corde_lot');
                var options = '';
                lots.find('option').each(function () {
                    options += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';
                });
                $('#preparation_corde_lot').html(options);

                var totalQte = $(html).find('#preparation_corde_totalqte').val();
                $('#preparation_corde_totalqte').val(totalQte);
            },
        });

    });

    $lot.change(function () {
        var $form = $(this).closest('form');
        var data = {};
        data[$corde.attr('name')] = $corde.val();
        data[$datedecreation.attr('name')] = $datedecreation.val();
        data[$stocks.attr('name')] = $stocks.val();
        data[$article.attr('name')] = $article.val();
        data[$lot.attr('name')] = $lot.val();
        data[$quantiteEnStock.attr('name')] = $quantiteEnStock.val();
        data[$totalqte.attr('name')] = $totalqte.val();
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                var totalQte = $(html).find('#preparation_corde_totalqte').val();
                $('#preparation_corde_totalqte').val(totalQte);
            },
        });
    });
});