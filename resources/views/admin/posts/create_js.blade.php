  <script type="text/javascript">

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


        $('#frm-insert').on('submit',function(e){
            e.preventDefault();
            // var data=$(this).serialize();
            // var img = $('#image.image').attr('src');
            // console.log(img);
            var url=$(this).attr('action');
            var post=$(this).attr('method');
            var data = CKEDITOR.instances.body.getData();
            // console.log(data);
            // console.log(new FormData(this).slug);
            document.getElementById('body').value = data;
            // document.getElementById('body_hidden').value = data;
            $.ajax({
                type: post,
                url: url,
                data:new FormData(this),
                dataTy:'json',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    // console.log(data.message);
                    // console.log(data.post_data.id);
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);

                     $("#message").fadeTo(2000, 500).slideUp(500, function(){
                            $("#message").slideUp(500);
                        });
                     
                    $('#upload-image').html(data.uploaded_image);
                    var post_id=data.post_data.id;
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
                        text : data.post_data.body
                    })).append($("<td/>",{
                        text : data.post_data.published
                    })).append($("<td/>",{
                        text : data.post_data.image
                    })).append($("<td/>",{
                        text : data.post_data.username
                    })).append($("<td/>",{
                        text : data.post_data.vote
                    })).append($("<td/>",{
                        text : data.post_data.view
                    })).append($("<td/>",{
                        html : '<a href="#" class="btn btn-info btn-xs" id="view" data-id="'+data.post_data.id+'">View </a> ' + 
                            '<a href="" class="btn btn-success btn-xs" id="edit" data-id="'+data.post_data.id+'">Edit </a> ' +
                            '<a href="#" class="btn btn-danger btn-xs" id="delete" data-id="'+data.post_data.id+'">Delete </a>' 
                    }))
                $('#post-info').append(tr);

                }});
        });
    </script>
    

    


    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>
    {{-- Load subcategory khi change category --}}
   {{--  <script>

              $('select[name="category_id[]"]').on('change', function(){
                    var data = $(this).val();

                    // console.log(data);
                    $.ajax({
                        url: 'ajax/getCategoriesChildren',
                        type: "POST",
                        dataType: "json",
                        data : {arr:data},

                        success:function(data){
                            // console.log(data.sub_cat[0]);
                          $('select[name="sub_cat_id[]"]').empty();
                          $.each(data.sub_cats, function(key, sub_cat){
                                 $.each(sub_cat, function(key, value){
                                  $('select[name="sub_cat_id[]"]').append(
                                      "<option selected value='"+value.id+"'>"+value.name+"</option>"
                                        );
                                 });
                          });
                         
                        }
                    });

              });
    </script> --}}

    @include('admin.js.load_image')
