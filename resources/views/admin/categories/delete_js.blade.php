<script>
   $(document).on('click','#delete',function(e){
            var id=$(this).data('id');
            $.get("{{ URL::to('manager/categories/edit')}}", {id: id}, function(data){
            	console.log(data);
                $('#frm-delete').find('#id').val(data.category.id)
                $('#frm-delete').find('#name').val(data.category.name)
                $('#frm-delete').find('#parent_id').val(data.parent_name)
                $('#deleteCategory').modal('show');
            })
  })

    $('#frm-delete').on('submit',function(e){
            e.preventDefault();
            var id=document.getElementById('id').value;
           
            $.post('{{ URL::to("manager/categories/destroy") }}',{id:id},function(data){
                    $('#deleteCategory').modal('hide');
                    location.reload();
                    
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                    $("#message").fadeTo(2000, 500).slideUp(500, function(){
                        $("#message").slideUp(5000);
                    });
            })
        })      
</script>