function readURL(input) {
    $('#image_preview').removeClass("hidden");
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            $('#image_preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("input[type=file]").change(function() {
    readURL(this);
});
