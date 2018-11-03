<script>
	$(document).ready(function() {
		$("#languageSwitcher").change(function() {
			console.log('hihi');
			var locale = $(this).val();
			var _token = $("input[name=_token]").val();

			$.ajax({
				url:"/language",
				type:'POST',
				data: {locale:locale, _token:_token},
				dataType: 'json',
				success: function(data) {
					console.log(data);
				},
				error: function(data) {

				},
				beforeSend: function(data) {

				},
				complete: function(data) {
					window.location.reload(true);
				}
			});
		});
	});
</script>