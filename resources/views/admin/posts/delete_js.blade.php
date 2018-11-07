uuuuu<script>
        $(document).on('click','#delete',function(e){
            var id=$(this).data('id');
           if(confirm("Are You Sure to delete this")){
            $.post('{{URL::to("manager/posts/destroy")}}',{id:id},function(data){
                if (data.success){
                    
                $('#post-info #'+id).remove();
                }
                    
                    $('#message_delete').css('display', 'block');
                    $('#message_delete').html(data.message);
                    $('#message_delete').addClass(data.class_name);

                     $("#message_delete").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message_delete").slideUp(500);
                    });
            })
    		}
        })      

</script>