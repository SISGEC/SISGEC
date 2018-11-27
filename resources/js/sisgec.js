import * as $ from 'jquery';
import Dropzone from 'dropzone';
import IMask from 'imask'
import 'devbridge-autocomplete';

Dropzone.autoDiscover = false;

function setRequiredDateFormat(date) {
    date = date.split("/");
    return date[1]+"/"+date[0]+"/"+date[2];
}

function calcAge(dateString) {
    dateString = setRequiredDateFormat(dateString);
    var birthday = new Date(dateString);
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getFullYear() - 1970);
}

$(document).ready(function() {
    $('input.sex').on("change", function() {
        $(".hide-if-sex-is-male").toggle();
    });
    $(".hide-if-sex-is-male").toggle();

    $("#birthdate").change(function() {
        var birt = $(this).val();
        $("#age").val(calcAge(birt) + " " + I18N.years);
    });

    var weightMask = new IMask($("#weight").get(0), {
        mask: '00[0] kg',
        lazy: false,
        placeholderChar: '0'
    });

    var heightMask = new IMask($("#height").get(0), {
        mask: '00[0] cm',
        lazy: false,
        placeholderChar: '0'
    });

    var temperatureMask = new IMask($("#temperature").get(0), {
        mask: '00 ºC',
        lazy: false,
        placeholderChar: '0'
    });

    var heartRateMask = new IMask($("#heart_rate").get(0), {
        mask: '00[0] BPM',
        lazy: false,
        placeholderChar: '0'
    });

    var bloodPressureMask = new IMask($("#blood_pressure").get(0), {
        mask: '00[0]/00[0]',
        lazy: false,
        placeholderChar: '0'
    });

    var BreathingFrequencyMask = new IMask($("#breathing_frequency").get(0), {
        mask: '00[0] RPM',
        lazy: false,
        placeholderChar: '0'
    });

    var PhoneMask = new IMask($("#phone").get(0), {
        mask: '(000) 000 0000'
    });

    $('#scholarship').autocomplete({
        serviceUrl: '/api/fragments/scholarships/list'
    });

    $('#occupation').autocomplete({
        serviceUrl: '/api/fragments/occupations/list'
    });

    $('#religion').autocomplete({
        serviceUrl: '/api/fragments/religions/list'
    });

    $('#civil_status').autocomplete({
        serviceUrl: '/api/fragments/civil-status/list'
    });

    var options = {
        url: HOME_URL + "/attachments/save",
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 5, // MB
        autoProcessQueue: true,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 10,
        acceptedFiles: 'image/*, video/*, application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/docx, text/plain, application/msword, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        addRemoveLinks: true,
        headers: {
            'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value,
        },
        success: function (file, done) {
            if(file.xhr.status == 200) {
                var el = $("#studies");
                var re = JSON.parse(file.xhr.response);
                var inp = $('<input type="hidden" name="studies[]">');
                inp.val(re.study_id);
                el.append(inp);
            }
        }
    };
    
    if($("div#uploadFiles").length > 0) {
        var dz = new Dropzone("div#uploadFiles", options);
        Dropzone.options.uploadFiles = options;
    }

    $('data-target="#addStudies"').on("click", function() {
        var dz = new Dropzone("div#uploadFiles", options);
        Dropzone.options.uploadFiles = options;
    });
});