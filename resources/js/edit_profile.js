$(document).ready(function() {

    $('#update_profile').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "updateProfile",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if(data.post_data) {
                        toastr.success(data.message);
                    
                }
                switch (type) {
                    case 'success':
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