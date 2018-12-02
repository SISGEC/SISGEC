import * as $ from 'jquery';

function loadEditAppointmentModal(apid) {
    var modal  = $(".edit-appointment");
    modal.modal('show');
    modal.find(".modal-title, span.title").text(event.title);
    modal.find("span.date").text(event.formated_date);
    modal.find("p.desc").text(event.description);
    modal.on('hidden.bs.modal', function (e) {
        modal.find(".modal-title, span.title").text("");
        modal.find("span.date").text("");
        modal.find("p.desc").text("");
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