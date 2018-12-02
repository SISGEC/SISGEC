import * as $ from 'jquery';
const axios = require('axios');
import swal from 'sweetalert';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found.');
}

function loadEditAppointmentModal(apid) {
    var modal  = $(".edit-appointment");

    axios.get("/medical-appointment/" + apid)
    .then(function (response) {
        if(response.status === 200) {
            var event = response.data;
            modal.modal('show');
            modal.find("form").attr("action", event.links.update);
            modal.find("input[name=appointment_id]").val(event.id);
            modal.find("input[name=title]").val(event.title);
            modal.find("input[name=date]").datepicker("setDate", event.date);
            modal.find("select[name=hour]").val(event.h);
            modal.find("select[name=minutes]").val(event.i);
            modal.find("select[name=a]").val(event.a);
            modal.find("textarea[name=description]").text(event.description);
            modal.on('hidden.bs.modal', function (e) {
                modal.find("input[name=title]").val("");
                modal.find("input[name=date]").val("");
                modal.find("select[name=hour]").val("");
                modal.find("select[name=minutes]").val("");
                modal.find("select[name=a]").val("");
                modal.find("textarea[name=description]").text("");
            });
        } else {
            swal({
                title: I18N.sorry,
                text: I18N.an_error_has_occurred + "\n (" + response.status + ") " + response.statusText,
                icon: "error",
            });
        }
    })
    .catch(function (error) {
        swal({
            title: I18N.sorry,
            text: I18N.an_error_has_occurred + "\n" + error,
            icon: "error",
        });
    });
}

$(document).ready(function() {
    if($(".appointment_edit_button").length > 0) {
        $(".appointment_edit_button").on("click", function() {
            var apid = $(this).data("appointment_id");

            loadEditAppointmentModal(apid);
        });
    }
});