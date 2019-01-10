$(document).ready(function() {

    $('#update_profile').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ route('ajaxupdate.profile') }}",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var type = data.alert_type;

                switch (type) {
                    case 'success':
                        toastr.success(data.message);
                        break;
                    case 'error':
                        var message = data.message;
                        var key = Object.keys(message);

                        for (var i = 0; i < key.length; i++) {
                            toastr.error(message[key[i]]);
                        }
                        break;
                }
            }
        })
    });

});