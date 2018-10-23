  <script type="text/javascript">
        
        $(document).on('click','#cat_link',function(e){
            e.preventDefault();
            var parent_id = $(this).attr('value');
            var parent_name = $(this).text();
            $('#showTreeCategory').modal('hide');
            $('input[name=category]').val(parent_name);

        }) 

        $(document).on('click','#clear-category',function(e){
            e.preventDefault();
            var parent_name = null;
            $('input[name=category]').val(parent_name);

        })
        


        $('#frm-insert').on('submit',function(e){
            e.preventDefault();
          
            var url=$(this).attr('action');
            var post=$(this).attr('method');
            var data = CKEDITOR.instances.body.getData();
        
            document.getElementById('body').value = data;
            $.ajax({
                type: post,
                url: url,
                data:new FormData(this),
                dataTy:'json',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);

                     $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                        });
                    if(data.post_data) {
                        var tr=$("<tr/>",{
                            id:data.post_data.id
                        });
                            tr.append($("<td/>",{
                                text : data.post_data.id
                            })).append($("<td/>",{
                                text : data.post_data.title
                            })).append($("<td/>",{
                                text : data.post_data.slug
                         })).append($("<td/>",{
                                text : data.post_data.body.substring(0,50)
                            })).append($("<td/>",{
                                html : '<a href="#" class="btn btn-info btn-sm" id="view" data-id="'+data.post_data.id+'">View </a> ' + 
                                    '<a href="posts/edit/'+data.post_data.id+'" class="btn btn-success btn-sm" id="edit" data-id="'+data.post_data.id+'">Edit </a> ' +
                                    '<a href="#" class="btn btn-danger btn-sm" id="delete" data-id="'+data.post_data.id+'">Delete </a>' 
                            })).append($("<td/>",{
                                html : '<a href="posts/store/'+data.post_data.id+'" class="btn btn-info btn-sm" id="view" data-id="'+data.post_data.id+'">Send</a>'
                         }))
                        $('#post-info').append(tr);
                    }
                }});
        });
    </script>
    

    


   {{--  <script type="text/javascript">
        $('.select2-multi').select2();
    </script> --}}

    @include('admin.js.load_image')
