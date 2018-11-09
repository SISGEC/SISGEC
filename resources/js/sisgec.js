import * as $ from 'jquery';
import Dropzone from 'dropzone';

$(document).ready(function() {
    $('input[name="sex"]').on("change", function() {
        $(".hide-if-sex-is-male").toggle();
    });
    $(".hide-if-sex-is-male").toggle();

    //var dz = new Dropzone("div#upload-files", { url: HOME_URL + "/attachments/new" });
    Dropzone.options.uploadFiles = {
        url: HOME_URL + "/attachments/new",
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 5,
        maxFilesize: 1,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        accept: function(file, done) {
            console.log(file);
        }
    };
});