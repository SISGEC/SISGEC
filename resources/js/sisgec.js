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
    if($('input.sex').length > 0) {
        $('input.sex').on("change", function() {
            $(".hide-if-sex-is-male").toggle();
        });
        $(".hide-if-sex-is-male").toggle();
    }

    if($("#birthdate").length > 0) {
        $("#birthdate").change(function() {
            var birt = $(this).val();
            $("#age").val(calcAge(birt) + " " + I18N.years);
        });
    }

    if($("#weight").length > 0) {
        var weightMask = new IMask($("#weight").get(0), {
            mask: '00[0] kg',
            lazy: false,
            placeholderChar: '0'
        });
    }

    if($("#height").length > 0) {
        var heightMask = new IMask($("#height").get(0), {
            mask: '00[0] cm',
            lazy: false,
            placeholderChar: '0'
        });
    }

    if($("#temperature").length > 0) {
        var temperatureMask = new IMask($("#temperature").get(0), {
            mask: '00 ºC',
            lazy: false,
            placeholderChar: '0'
        });
    }

    if($("#heart_rate").length > 0) {
        var heartRateMask = new IMask($("#heart_rate").get(0), {
            mask: '00[0] BPM',
            lazy: false,
            placeholderChar: '0'
        });
    }

    if($("#blood_pressure").length > 0) {
        var bloodPressureMask = new IMask($("#blood_pressure").get(0), {
            mask: '00[0]/00[0]',
            lazy: false,
            placeholderChar: '0'
        });
    }

    if($("#breathing_frequency").length > 0) {
        var BreathingFrequencyMask = new IMask($("#breathing_frequency").get(0), {
            mask: '00[0] RPM',
            lazy: false,
            placeholderChar: '0'
        });
    }

    if($("#phone").length > 0) {
        var PhoneMask = new IMask($("#phone").get(0), {
            mask: '(000) 000 0000'
        });
    }

    if($('#scholarship').length > 0) {
        $('#scholarship').autocomplete({
            serviceUrl: '/api/fragments/scholarships/list'
        });
    }

    if($('#occupation').length > 0) {
        $('#occupation').autocomplete({
            serviceUrl: '/api/fragments/occupations/list'
        });
    }

    if($('#religion').length > 0) {
        $('#religion').autocomplete({
            serviceUrl: '/api/fragments/religions/list'
        });
    }

    if($('#civil_status').length > 0) {
        $('#civil_status').autocomplete({
            serviceUrl: '/api/fragments/civil-status/list'
        });
    }

    if($('#searched').length > 0) {
        $('#searched').autocomplete({
            serviceUrl: '/api/search',
            formatResult: function (suggestion, currentValue) {
                return '<a href="' + suggestion.data + '">'+ suggestion.value +'</a>';
            },
            onSelect: function (suggestion) {
                window.location.replace(suggestion.data);
            }
        });
    }

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
                $.each(re.studies, function(key, val) {
                    inp.val(val.id);
                    el.append(inp);

                    $(".studies-list").prepend(val.template);
                });
            }
        }
    };
    
    if($("div#uploadFiles").length > 0) {
        if(typeof $("div#uploadFiles").data("patient_id") !== 'undefined' ) {
            var ext = "?patient_id=" + $("div#uploadFiles").data("patient_id");
            options.url = options.url + ext;
        }
        console.log(options.url);
        var dz = new Dropzone("div#uploadFiles", options);
        Dropzone.options.uploadFiles = options;
    }

    if($(':input').length > 0) {
        $(':input').focus(function(){
            var center = ($(window).height()/2) - 100;
            var top = $(this).offset().top ;
            if (top > center){
                $(window).scrollTop(top-center);
            }
        });
    }

    if($('a.remove_this').length > 0) {
        $('a.remove_this').on('click', function () {
            return confirm(I18N.sure_remove);
        });
    }

    if($("#patient_list").length > 0 && $("#patient_list_send").length > 0) {
        $("#patient_list_send").on("click", function() {
            var url = $("#patient_list").val();
            window.location.replace(url);
        });
    }

    if($(".informed_consent_modal").length > 0) {
        $(".informed_consent_modal").modal({
            keyboard: false,
            show: true,
            backdrop: 'static'
        });
    }
});