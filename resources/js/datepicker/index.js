import * as $ from 'jquery';
import 'bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js';
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';

export default (function () {
  $('.start-date').datepicker();
  $('.end-date').datepicker();

  $('#birthdate').datepicker({
    format: 'dd/mm/yyyy',
    endDate: '0d',
    language: 'es',
    startView: 'decades'
  });
}());
