<script>
	$("#frm-create").on('submit', function(e){
		e.preventDefault();
        var method = $(this).attr('method');
        var url = $(this).attr('action');
        // var data = $(this).serialize();
        // console.log(data);
		$.ajax({
			type: method,
            url: url,
            data:new FormData(this),
            dataTy:'json',
            contentType: false,
            cache: false,
            processData: false,
			success:function(data){
				console.log(data);
            	 $('#message').css('display', 'block');
                 $('#message').html(data.message);
                 $('#message').addClass(data.class_name);
                 $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                 });

                 var tr=$("<tr/>",{
                    id:data.tag.id
                });
                    tr.append($("<th/>",{
                        text : data.tag.id
                    })).append($("<td/>",{
                        html : '<a href="#" class="">'+data.tag.name+'</a>'
                        
                    })).append($("<td/>",{
                        html : '<a href="#" class="btn btn-info btn-xs" id="view" data-id="'+data.tag.id+'">View </a> ' + 
                            '<a href="#" class="btn btn-success btn-xs" id="edit" data-id="'+data.tag.id+'">Edit </a> ' +
                            '<a href="#" class="btn btn-danger btn-xs" id="delete" data-id="'+data.tag.id+'">Delete </a> ' 
                    }))
                $('#tag-info').append(tr);

                }
		})
	})
</script>