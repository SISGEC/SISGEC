import * as $ from 'jquery';

$(document).ready(function() {
    $('input[name="sex"]').on("change", function() {
        alert("Hola");
        $(".hide-if-sex-is-male").toggle();
    });
});