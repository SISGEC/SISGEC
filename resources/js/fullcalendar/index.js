import * as $ from 'jquery';
import 'fullcalendar/dist/fullcalendar.min.js';
import 'fullcalendar/dist/fullcalendar.min.css';
import PerfectScrollbar from 'perfect-scrollbar';
import 'perfect-scrollbar/css/perfect-scrollbar.css'

function loadModal(event) {
  var modal  = $(".view-appointment");
  modal.modal('show');
  modal.find(".modal-title").text(event.title);
  modal.find("span.date").text(event.formated_date);
  modal.find("p.desc").text(event.description);
  modal.find("a.remove_this").attr("href", event.links.remove);
  modal.on('hidden.bs.modal', function (e) {
    modal.find(".modal-title").text("");
    modal.find("span.date").text("");
    modal.find("p.desc").text("");
    modal.find("a.remove_this").attr("href", "");
  });
}

export default (function () {

  if($(".appointments-list").length > 0) {
    const ps = new PerfectScrollbar('.appointments-list');
  }

  if($("#full-calendar").length > 0) {
    $('#full-calendar').fullCalendar({
      events: {
        url: '/medical-appointments.json',
        type: 'GET',
        error: function() {
          alert('there was an error while fetching events!');
        },
      },
      height   : 800,
      editable : false,
      locale: I18N.locale,
      header: {
        left   : 'month,agendaWeek,agendaDay',
        center : 'title',
        right  : 'today prev,next',
      },
      eventClick: function(calEvent, jsEvent, view) {
        loadModal(calEvent);
      }
    });
  }
}())
