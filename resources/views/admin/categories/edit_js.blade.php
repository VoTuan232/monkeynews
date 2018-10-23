<script>
   $(document).on('click','#edit',function(e){
            var id=$(this).data('id');
            $.get("{{ URL::to('manager/categories/edit')}}", {id: id}, function(data){
            	console.log(data);
                $('#frm-update').find('#id-update').val(data.category.id)
                $('#frm-update').find('#name-update').val(data.category.name)
                if(data.parent_name == "null") {
                    $('#frm-update').find('#parent_id').val()
                }
                else {
                    $('#frm-update').find('#parent_id').val(data.parent_name)

                }
                $('#editCategory').modal('show');
            })
  })
   
    $(document).on('click','#clear-category',function(e){
            e.preventDefault();
            var parent_name = null;
            $('input[name=parent_id]').val(parent_name);

        })

    $('#frm-update').on('submit',function(e){
            e.preventDefault();
            var id=document.getElementById("id-update").value;
            var name=document.getElementById("name-update").value;
            var parent_name=document.getElementById("parent_id").value;
           
            $.post('{{ URL::to("manager/categories/update") }}',{id:id, name: name, parent_name: parent_name},function(data){

                    if(data.category)
                    {
                        $('#editCategory').modal('hide');
                        location.reload();

                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);

                        $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                        });

                    }

                    else{
                        $('#message-fail').css('display', 'block');
                        $('#message-fail').html(data.message);
                        $('#message-fail').addClass(data.class_name);
                        
                        $("#message-fail").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message-fail").slideUp(500);
                        });
                    }




            })
        })      
</script>