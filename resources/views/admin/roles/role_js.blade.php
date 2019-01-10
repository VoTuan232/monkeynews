<script>

 $('select[name="role"]').on('change', function() {

    var checkbox = document.querySelectorAll('input[name="roles[]"]'), values = [];
     Array.prototype.forEach.call(checkbox, function(el) {
        document.getElementById(el.value).checked = false;
    });
    var data = $(this).val();

    $.ajax({
        url: 'ajax/getPermissions',
        type: "GET",
        dataType: "json",
        data : { role_id : data },
        success:function(data){
          $.each(data.data, function(key, sub_cat){
                var checkboxes = document.querySelectorAll('input[name="roles[]"]'), values = [];
                Array.prototype.forEach.call(checkboxes, function(el) {
                    if(el.value == sub_cat) {
                        document.getElementById(el.value).checked = true;
                    }
                });
            });
         
        }
    });

    });
 
    $(document).ready(function () {
         $("#permission").on('keyup', function (e) {

                if (e.keyCode == 13) {
                    var value = document.getElementById('permission').value;

                    if(value != "") {
                        var myDiv = document.getElementById("show-permissions");
                        $("#show-permissions").append('<div class="col-md-3"><div><input id="'+value+'" class="checkbox-custom" name="roles[]" type="checkbox" value="'+value+'"><label for="roles" class="checkbox-custom-label">&nbsp;'+value+'</label></div></div>');
                    }
                    else {
                        $('#message').css('display', 'block');
                        $('#message').html('Vui lòng nhập nội dung permissions...');
                        $('#message').addClass('alert-danger');
                        $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                        });
                    }
                }

            });
    });
</script>