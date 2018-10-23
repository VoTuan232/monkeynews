<script>

    $(document).on('click','#cat_link',function(e){
            e.preventDefault();
            var parent_id = $(this).attr('value');
            var parent_name = $(this).text();
            $('#showTreeCategory').modal('hide');
            $('input[name=parent_id]').val(parent_name);

        })

    $(document).on('click','#clear-category',function(e){
            e.preventDefault();
            var parent_name = null;
            $('input[name=parent_id]').val(parent_name);

        })

	$("#frm-create").on('submit', function(e){
		e.preventDefault();
        var method = $(this).attr('method');
        var url = $(this).attr('action');
           
		$.ajax({
			type: method,
            url: url,
            data:new FormData(this),
            dataTy:'json',
            contentType: false,
            cache: false,
            processData: false,
			success:function(data){
                if(data.category)
                {
                    location.reload();
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                    $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(5000);
                    });
                }
                else {
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                    });
                }
            }
		})
	})
</script>