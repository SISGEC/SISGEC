import * as $ from 'jquery';
import Dropzone from 'dropzone';
import IMask from 'imask'
import 'devbridge-autocomplete';
import './appointment_edit';
import swal from 'sweetalert';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import 'notifyjs-browser';
import './autosave';
import './checkConnection';
var moment = require('moment');

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

function readURL(input, img_tag, label_tag) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(img_tag).attr('src', e.target.result);
            $(label_tag).html(e.target.fileName);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    $.notify.defaults({ position: "top right" });
    
    if(typeof Notifications !== "undefined") {
        Notifications = JSON.parse(Notifications);
        if(Notifications.length > 0) {
            $.each(Notifications, function(i, notify) {
                $.notify(notify.message, notify.type);
            });
        }
    }

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
        var cyear = new Date();
        cyear = cyear.getFullYear();
        /*var birthdateMask = new IMask($("#birthdate").get(0), {
            mask: Date,
            pattern: 'Y-`m-`d',
            blocks: {
                d: {
                  mask: IMask.MaskedRange,
                  from: 1,
                  to: 31,
                  maxLength: 2,
                },
                m: {
                  mask: IMask.MaskedRange,
                  from: 1,
                  to: 12,
                  maxLength: 2,
                },
                Y: {
                  mask: IMask.MaskedRange,
                  from: 1900,
                  to: cyear
                }
            },
            lazy: true,
        });
        birthdateMask.updateValue();*/
    }

    /*if($("#weight").length > 0) {
        var weightMask = new IMask($("#weight").get(0), {
            mask: '00[0].00 kg',
            lazy: false,
            placeholderChar: '0'
        });
    }

    if($("#height").length > 0) {
        var heightMask = new IMask($("#height").get(0), {
            mask: '00[0]. cm',
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
    }*/

    if($("input#rfc").length > 0) {
        $("#rfc").on("keyup", function() {
            this.value = this.value.toLocaleUpperCase();
        });
    }

    if($("#phone").length > 0) {
        var PhoneMask = new IMask($("#phone").get(0), {
            mask: '(000) 000 0000'
        });
    }

    if($("#phone2").length > 0) {
        var PhoneMask = new IMask($("#phone2").get(0), {
            mask: '(000) 000 0000'
        });
    }

    if($('#scholarship').length > 0) {
        $('#scholarship').autocomplete({
            serviceUrl: HOME_URL + '/api/fragments/scholarships/list'
        });
    }

    if($('#occupation').length > 0) {
        $('#occupation').autocomplete({
            serviceUrl: HOME_URL + '/api/fragments/occupations/list'
        });
    }

    if($('#religion').length > 0) {
        $('#religion').autocomplete({
            serviceUrl: HOME_URL + '/api/fragments/religions/list'
        });
    }

    if($('#civil_status').length > 0) {
        $('#civil_status').autocomplete({
            serviceUrl: HOME_URL + '/api/fragments/civil-status/list'
        });
    }

    if($('#searched').length > 0) {
        $('#searched').autocomplete({
            serviceUrl: HOME_URL + '/api/search',
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
        maxFilesize: 1000, // MB
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
                    if($(".no-results-banner").length > 0) {
                        $(".no-results-banner").remove();
                    }
                });
            }
        }
    };
    
    if($("div#uploadFiles").length > 0) {
        if(typeof $("div#uploadFiles").data("patient_id") !== 'undefined' ) {
            var ext = "?patient_id=" + $("div#uploadFiles").data("patient_id");
            options.url = options.url + ext;
        }
        //console.log(options.url);
        var dz = new Dropzone("div#uploadFiles", options);
        Dropzone.options.uploadFiles = options;
    }

    if($(':input').length > 0) {
        $(':input').focus(function(e){
            var $el = $(this);
            $(window).keyup(function (e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if (code == 9 && $(':input:focus').length) {
                    var center = ($(window).height()/2) - 100;
                    var top = $el.offset().top;
                    if (top > center){
                        $(window).scrollTop(top-center);
                    }
                }
            });
        });
    }

    if($('a.remove_this').length > 0) {
        $('a.remove_this').on('click', function (e) {
            var rlink = $(this).attr("href");
            swal({
                title: I18N.are_your_sure,
                text: I18N.sure_remove,
                icon: "warning",
                buttons: [I18N.cancel, I18N.ok],
                dangerMode: true,
              }).then((willDelete) => {
                if(willDelete) {
                    swal("", I18N.processing, "success");
                    window.location.replace(rlink);
                }
            });

            e.preventDefault();
            return false;
        });
    }

    if($('a.cancel_this').length > 0) {
        $('a.cancel_this').on('click', function (e) {
            var rlink = $(this).attr("href");
            swal({
                title: I18N.cancel_alert_title,
                text: I18N.cancel_alert_text,
                icon: "warning",
                buttons: [I18N.cancel, I18N.ok],
                dangerMode: true,
            }).then((willDelete) => {
                if(willDelete) {
                    autosave.manuallyReleaseData();
                    swal("", I18N.processing, "success");
                    window.location.replace(rlink);
                }
            });

            e.preventDefault();
            return false;
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

    if($(".edit_block").length > 0) {
        $(".edit_block").on("click", function() {
            var block = $(this).closest(".block");
            if(block.hasClass("editing")) {
                block.removeClass("editing");
                block.find(".save_block").addClass("d-none");
                $(this).addClass("btn-primary").removeClass("btn-danger").find("i").addClass("fa-edit").removeClass("fa-times");
                this._tippy.setContent(I18N.edit_settings);
                block.find(".form-control").addClass("form-control-plaintext").removeClass("form-control").attr("readonly", "readonly");
            } else {
                block.addClass("editing");
                block.find(".save_block").removeClass("d-none");
                $(this).addClass("btn-danger").removeClass("btn-primary").find("i").addClass("fa-times").removeClass("fa-edit");
                this._tippy.setContent(I18N.cancel_edit);
                block.find(".form-control-plaintext").addClass("form-control").removeClass("form-control-plaintext").removeAttr("readonly");
            }
        });
    }

    if($(".chage_password_button").length > 0) {
        $("#user_new_password, #user_password_confirm").on("keyup", function() {
            var p = $("#user_new_password").val();
            var r = $("#user_password_confirm").val();
            if( (p!=="" && r!== "") && p === r ) {
                $(".chage_password_button").removeAttr("disabled");
            } else {
                $(".chage_password_button").attr("disabled", "disabled");
            }
        });
    }

    if($("#option_office_logo").length > 0) {
        $("#option_office_logo").on("change", function() {
            readURL(this, "#option_office_logo_preview", '[for="option_office_logo"]');
        });
    }

    if($("#option_office_brand").length > 0) {
        $("#option_office_brand").on("change", function() {
            readURL(this, "#option_office_brand_preview", '[for="option_office_brand"]');
        });
    }

    if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
    $('a[data-toggle="tab"], a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
       if(history.pushState) {
            history.pushState(null, null, '#'+$(e.target).attr('href').substr(1));
       } else {
            location.hash = '#'+$(e.target).attr('href').substr(1);
       }
    });

    if($("a[title]").length > 0) {
        tippy('a[title]');
    }

    if($(".auto-save-fields").length > 0) {
        var onSave = false;
        var si = $(".saved-info"),
            sp = $("<span></span>"),
        autosave = $( ".auto-save-fields" ).sisyphus({
            locationBased: true,
            excludeFields: $( ".fallback input" ),
            timeout: 60,
            onBeforeSave: function() {
                if(!onSave) {
                    si.removeClass("no-saved").addClass("saved");
                    onSave = true;
                }
            },
            onSave: function() {
                if(si.children("span").length < 1) {
                    sp.text(I18N.saving_draft).css("opacity", "0");
                    si.prepend(sp);
                    sp.animate({opacity: 1}, 1000);
                }
                setTimeout(() => {
                    onSave = false;
                    si.removeClass("saved").addClass("no-saved");
                    sp.text(I18N.saved_draft);
                    setTimeout(() => {
                        sp.animate({opacity: 0}, 500, function() {
                            $(this).remove();
                        });
                    }, 5000);
                }, 1000);
            },
            onRestore: function() {
                if($("#onRestoreDataAlert").length > 0) {
                    $("#onRestoreDataAlert").show();
                }
            }
        });
        
        if($(".resetDataButton").length > 0) {
            $(".resetDataButton").on("click", function() {
                autosave.manuallyReleaseData();
            });
        }

        function loadDataFromProbatium() {
            $(".btn-probatium").find("i").removeClass("fa-cloud-download-alt");
            $(".btn-probatium").find("i").addClass("fa-spinner fa-spin");
            $(".btn-probatium").attr("disable", "disable");
            $.get( ProbatiumIP + "/data.json", function( data ) {
                var weight = data.data.weight;
                $("#weight").val(weight);
                var height = data.data.height;
                if(height <= 6) {
                    height = 0;
                }
                $("#height").val(height);
                if(typeof heightMask !== "undefined") {
                    heightMask.updateValue();
                }
                if(typeof weightMask !== "undefined") {
                    weightMask.updateValue();
                }

                setTimeout(function(){
                    $(".btn-probatium").find("i").removeClass("fa-spinner fa-spin");
                    $(".btn-probatium").find("i").addClass("fa-cloud-download-alt");
                    $(".btn-probatium").removeAttr("disable", "disable");
                },1000);
            });
        }

        if($(".weight-get-button").length > 0) {
            $(".weight-get-button").on("click", function(e) {
                loadDataFromProbatium($(this));
                e.preventDefault();
                return false;
            });
        }

        if($(".height-get-button").length > 0) {
            $(".height-get-button").on("click", function(e) {
                loadDataFromProbatium($(this));
                e.preventDefault();
                return false;
            });
        }
    }
});