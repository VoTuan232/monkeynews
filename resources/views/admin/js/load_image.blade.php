<script type="text/javascript">
    console.log('haha');
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#upload-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function(){
        console.log('hihi');

        readURL(this);
    });

</script>