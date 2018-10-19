{{-- <script>

$('body').delegate('#post-info #edit','click',function(e){
	// console.log('hihi');
            var id=$(this).data('id');
            // console.log(id);
            $.get("{{ URL::to('manager/posts/edit')}}", {id: id}, function(data){
            	// console.log('hihi');
            	// console.log(data.id);
                $('#frm-update').find('#id').val(data.id)
                $('#frm-update').find('#title').val(data.title)
                $('#frm-update').find('#slug').val(data.slug)
                $('#frm-update').find('#body').val(data.body)
                // $('#frm-update').find('#upload-image').html('<img src="/images/'+data.image+'" class="img-thumbnail" width="300" />')
                // $('#frm-update').find('#title').val(data.title)
                $('#updatePost').modal('show');

            })
})

</script> --}}

<script>
    $('#frm-update').on('submit', function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var method = $(this).attr('method');
             $.ajax({
                type: method,
                url: url,
                data:new FormData(this),
                dataTy:'json',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    console.log(data.message);
                    // console.log(data.post_data.id);
                     // console.log(data.post_data);
                     // console.log(data.message);
                     // console.log(data.class_name);
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                }});
    })
</script>

@include('admin.js.load_image')
