<script>
   $(document).on('click','#delete',function(e){
            var id=$(this).data('id');
            $.get("{{ URL::to('manager/tags/edit')}}", {id: id}, function(data){
            	console.log(data);
                $('#frm-delete').find('#id').val(data.tag.id)
                $('#frm-delete').find('#name').val(data.tag.name)
                $('#deleteTag').modal('show');
            })
  })

    $('#frm-delete').on('submit',function(e){
            e.preventDefault();
            var id=document.getElementById('id').value;
           
            $.post('{{ URL::to("manager/tags/destroy") }}',{id:id},function(data){

                    $('#tag-info #'+id).remove();

                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                    $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                    });

                    $('#deleteTag').modal('hide');
            })
        })      
</script>