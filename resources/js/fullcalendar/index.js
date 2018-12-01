import * as $ from 'jquery';
import 'fullcalendar/dist/fullcalendar.min.js';
import 'fullcalendar/dist/fullcalendar.min.css';

function loadModal(event) {
  var template = `
  <div class="modal fade event-modal-${event.id}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">${event.title}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>${event.description}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>`;
  $("body").append($(template));
  $(".event-modal-"+event.id).modal('show');
  $(".event-modal-"+event.id).on('hidden.bs.modal', function (e) {
    $(".event-modal-"+event.id).remove();
  });
}

export default (function () {

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
}())
