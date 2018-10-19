<script>

    $(document).on('click','#cat_link',function(e){
            // alert('hihi')
            e.preventDefault();
            var parent_id = $(this).attr('value');
            var parent_name = $(this).text();
            $('#showTreeCategory').modal('hide');
            $('input[name=category]').val(parent_name);

        }) 

    $(document).on('click','#clear-category',function(e){
        // alert('hihi')
        e.preventDefault();
        var parent_name = null;
        $('input[name=category]').val(parent_name);

    })

    $('#frm-update').on('submit', function(e) {

            var data = CKEDITOR.instances.body.getData();
            // document.getElementById('body_hidden').value = data;
            document.getElementById('body').value = data;
            // console.log(data);
            // alert('hihi');
            e.preventDefault();
            var url = $(this).attr('action');
            var method = $(this).attr('method');
             $.ajax({
                type: method,
                url: url,
                data:new FormData(this),
                dataTy:'json',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    console.log(data.message1);
                   
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);

                    $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                    });
                }});
    })
</script>

@include('admin.js.load_image')