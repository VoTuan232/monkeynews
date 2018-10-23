<script>
	$.ajaxSetup({
    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$('#update-role').on('submit', function(e) {
            e.preventDefault();
            var role = document.getElementById("role").value;
            if(role==""){
            	 		$('#message').css('display', 'block');
                        $('#message').html('Vui lòng chọn Role...');
                        $('#message').addClass('alert-danger');
                        $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                    	});
            }
            else {
			    var permissions = $('input[name="roles[]"]:checked').map(function(){
			        return this.value;
			    }).get()
	            var url = $(this).attr('action');
	            var method = $(this).attr('method');
	           $.post('{{ URL::to("manager/roles/update") }}',{ role_id: role, pers:permissions},function(data){
	           			$('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                    	});
	            })
            }
    })
</script>