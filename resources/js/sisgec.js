import * as $ from 'jquery';

$(document).ready(function() {
    $('input[name="sex"]').on("change", function() {
        $(".hide-if-sex-is-male").toggle();
    });
    $(".hide-if-sex-is-male").toggle();
});