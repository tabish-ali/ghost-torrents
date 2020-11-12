$(document).ready(function (e) {

    const out_img = document.getElementById('out-img');

    document.getElementById('image-file').onchange = function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                out_img.src = fr.result;
            }
            fr.readAsDataURL(files[0]);
            $('#save-image-btn').fadeIn("slow");

            out_img.style = "height: 200px; border: 1px solid black";
        }

        // Not supported
        else {
            // fallback -- perhaps submit the input to an iframe and temporarily store
            // them on the server until the user's session ends.
        }
    }

});