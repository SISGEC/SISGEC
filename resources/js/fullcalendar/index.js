import * as $ from 'jquery';
import 'moment';
import 'fullcalendar/dist/fullcalendar.min.js';
import 'fullcalendar/dist/fullcalendar.min.css';
import PerfectScrollbar from 'perfect-scrollbar';
import 'perfect-scrollbar/css/perfect-scrollbar.css'
import 'fullcalendar/dist/locale/es';

function loadModal(event) {
  var modal  = $(".view-appointment");
  modal.modal('show');
  modal.find(".modal-title").text(event.title);
  modal.find("span.date").text(event.formated_date);
  modal.find("p.desc").text(event.description);
  modal.find("[data-appointment_id]").data("appointment_id", event.id);
  modal.find("a.remove_this").attr("href", event.links.remove);
  modal.on('hidden.bs.modal', function (e) {
    modal.find(".modal-title").text("");
    modal.find("span.date").text("");
    modal.find("p.desc").text("");
    modal.find("[data-appointment_id]").data("appointment_id", "");
    modal.find("a.remove_this").attr("href", "");
  });
}

function loadModalNewEvent(date, h, m, a) {
  var modal  = $(".new-appointment");
  modal.modal('show');
  modal.find("input#ncdate").datepicker("setDate", date);
  modal.find("input.nchour").val(h);
  modal.find("input.ncminutes").val(m);
  modal.find("input.nca").val(a);
  modal.on('hidden.bs.modal', function (e) {
    modal.find("input#ncdate").val("");
    modal.find("input.nchour").val("");
    modal.find("input.ncminutes").val("");
    modal.find("input.nca").val("");
  });
}

export default (function () {

  if($(".appointments-list").length > 0) {
    const ps = new PerfectScrollbar('.appointments-list');
  }

  if($("#full-calendar").length > 0) {
    $('#full-calendar').fullCalendar({
      events: {
        url: HOME_URL + '/medical-appointments.json',
        type: 'GET',
        error: function() {
          alert('there was an error while fetching events!');
        },
      },
      height   : 800,
      editable : false,
      locale: I18N.lang,
      navLinks: true,
      header: {
        left   : 'month,agendaWeek,agendaDay',
        center : 'title',
        right  : 'today prev,next',
      },
      eventClick: function(calEvent, jsEvent, view) {
        loadModal(calEvent);
      },
      dayClick: function(date, jsEvent, view) {
        loadModalNewEvent(date.format("DD/MM/YYYY"), date.format("hh"), date.format("mm"), date.format("a"));
      },
      viewRender: function(view, element) {
        //note: this is a hack, i don't know why the view title keep showing "undefined" text in it.
        //probably bugs in jquery fullcalendar
        $('.fc-center')[0].children[0].innerText = view.title.replace(new RegExp("undefined", 'g'), "");
      }
    });
  }
}())
