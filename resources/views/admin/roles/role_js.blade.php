<script>

 $('select[name="role"]').on('change', function() {

    var checkbox = document.querySelectorAll('input[name="roles"]'), values = [];
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
            // console.log(data);
          // $('select[name="sub_cat_id[]"]').empty();
          $.each(data.data, function(key, sub_cat){
                 // $.each(sub_cat, function(key, value){
                 //  $('select[name="sub_cat_id[]"]').append(
                 //      "<option selected value='"+value.id+"'>"+value.name+"</option>"
                 //        );
                 // // });
                var checkboxes = document.querySelectorAll('input[name="roles"]'), values = [];
                Array.prototype.forEach.call(checkboxes, function(el) {
                    // console.log(el);
                    // values.push(el.value);
                    if(el.value == sub_cat) {
                        document.getElementById(el.value).checked = true;
                        // console.log('hihi');
                        // console.log('#'+el.value);
                        // $('#'+el.value).prop("checked", true);
                    }
                });
                // console.log(values);
                // foreach ($roles as $key => $value)
                //     {
                //     }
            });
         
        }
    });

  });
</script>