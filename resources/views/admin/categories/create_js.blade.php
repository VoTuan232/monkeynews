<script>

    $(document).on('click','#cat_link',function(e){
            // alert('hihi')
            e.preventDefault();
            var parent_id = $(this).attr('value');
            var parent_name = $(this).text();
            $('#showTreeCategory').modal('hide');
            $('input[name=parent_id]').val(parent_name);

        })

    $(document).on('click','#clear-category',function(e){
            // alert('hihi')
            e.preventDefault();
            var parent_name = null;
            $('input[name=parent_id]').val(parent_name);

        })

	$("#frm-create").on('submit', function(e){
		e.preventDefault();
        var method = $(this).attr('method');
        var url = $(this).attr('action');
            // var name=document.getElementById("category_id").value;
            // var parent_name=document.getElementById("name").value;
            // console.log(name);
            // console.log(parent_name);

        // var data = $(this).serialize();
        // console.log(new FormData(this));
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


				// console.log(data);
    //         	 $('#message').css('display', 'block');
    //              $('#message').html(data.message);
    //              $('#message').addClass(data.class_name);
    //             $("#message").fadeTo(2000, 500).slideUp(500, function(){
    //                     $("#message").slideUp(500);
    //             });

    //             var tr=$("<tr/>",{
    //                 id:data.category.id
    //             });
    //                 tr.append($("<th/>",{
    //                     text : data.category.id
    //                 })).append($("<td/>",{
    //                     text : data.category.name
                        
    //                 })).append($("<td/>",{
    //                     text : data.parent_name
                        
    //                 })).append($("<td/>",{
    //                     html : '<a href="#" class="btn btn-info btn-xs" id="view" data-id="'+data.category.id+'">View </a> ' + 
    //                         '<a href="#" class="btn btn-success btn-xs" id="edit" data-id="'+data.category.id+'">Edit </a> ' +
    //                         '<a href="#" class="btn btn-danger btn-xs" id="delete" data-id="'+data.category.id+'">Delete </a> ' 
    //                 }))
    //             $('#category-info').append(tr);
            }
		})
	})
</script>