import * as $ from 'jquery';
import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

function calcAge(dateString) {
    var birthday = new Date(dateString);
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getFullYear() - 1970);
}

$(document).ready(function() {
    $('input[name="sex"]').on("change", function() {
        $(".hide-if-sex-is-male").toggle();
    });
    $(".hide-if-sex-is-male").toggle();

    $("#birthdate").change(function() {
        var birt = $(this).val();
        console.log(calcAge(birt));
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
            console.log(file);
        }
    };
    var dz = new Dropzone("div#uploadFiles", options);
    Dropzone.options.uploadFiles = options;
});