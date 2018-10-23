
<script>

$(document).ready(function(){

	 $('#name').keyup(function(){ 

	        var query = $(this).val();
	        console.log(query);
	        if(query != '')
	        {
	         var _token = $('input[name="_token"]').val();
	         $.ajax({
	          url:"{{ route('categories.search') }}",
	          method:"POST",
	          data:{query:query, _token:_token},
	          success:function(data){
	           $('#categoryList').fadeIn();  
	            $('#categoryList').html(data);
	          }
	         });
	        }
	    });

	    $(document).on('click', 'li', function(){  
	        $('#name').val($(this).text());  
	        $('#categoryList').fadeOut();  
	    });  

	});
</script>