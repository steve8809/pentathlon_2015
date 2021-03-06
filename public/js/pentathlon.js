/**
 * Created by Istvan on 2015.11.01..
 */

//Status success info kezelése
$('div.alert').delay(2500).slideUp(300);

//Modal ablakban törlés megerősítése
$('#confirmDelete').on('show.bs.modal', function (e) {
    $message = $(e.relatedTarget).attr('data-message');
    $(this).find('.modal-body p').text($message);
    $title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title);
    // Pass form reference to modal for submission on yes/ok
    var form = $(e.relatedTarget).closest('form');
    $(this).find('.modal-footer #confirm').data('form', form);
});

$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
    $(this).data('form').submit();
});

//Select2 js
$('#competitors').select2();

//Masked_input js
jQuery(function($){
    $(".masked_input").mask("99:99.99");
});

//Modal ablakban megerősítés speciálishoz
$('#confirmSpecial').on('show.bs.modal', function (e) {
    $message = $(e.relatedTarget).attr('data-message');
    $(this).find('.modal-body p').text($message);
    $title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title);
    // Pass form reference to modal for submission on yes/ok
    var form = $(e.relatedTarget).closest('form');
    $(this).find('.modal-footer #confirm').data('form', form);
});

$('#confirmSpecial').find('.modal-footer #confirm').on('click', function(){
    $(this).data('form').submit();
});

//Modal ablakban megerősítés kizáráshoz
$('#confirmDsq').on('show.bs.modal', function (e) {
    $message = $(e.relatedTarget).attr('data-message');
    $(this).find('.modal-body p').text($message);
    $title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title);
    // Pass form reference to modal for submission on yes/ok
    var form = $(e.relatedTarget).closest('form');
    $(this).find('.modal-footer #confirm').data('form', form);
});

$('#confirmDsq').find('.modal-footer #confirm').on('click', function(){
    $(this).data('form').submit();
});