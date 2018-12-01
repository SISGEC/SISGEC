import * as $ from 'jquery';
import 'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js';
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';

export default (function () {
  $('.start-date').datepicker({
    format: 'dd/mm/yyyy',
    startDate: 'today',
    language: I18N.lang
  });
  $('.end-date').datepicker({
    format: 'dd/mm/yyyy',
    startDate: 'today',
    language: I18N.lang
  });

  $('#birthdate').datepicker({
    format: 'dd/mm/yyyy',
    endDate: '0d',
    language: I18N.lang,
    startView: 'decades'
  });
}());
