import * as $ from 'jquery';
import 'offline-js/offline';

var check_url = "://placehold.jp/ffffff/ffffff/1x1.png";

if (location.protocol != 'https:') {
    check_url = "http" + check_url;
} else {
    check_url = "https" + check_url;
}

Offline.options = {checks: {image: {url: check_url}, active: 'image'}}

Offline.on("down", function() {
    $("a").addClass("disabled");
    $("button").attr("disabled", "disabled");
});

Offline.on("up", function() {
    $("a").removeClass("disabled");
    $("button").removeAttr("disabled");
});