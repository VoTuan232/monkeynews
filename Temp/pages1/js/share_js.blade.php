<!-- <script>
    var popupMeta = {
        width: 400,
        height: 400
    }
    $(document).on('click', '.social-share', function(event){
        event.preventDefault();
     
        var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
            hPosition = Math.floor(($(window).height() - popupMeta.height) / 2);
     
        var url = $(this).attr('href');
        var popup = window.open(url, 'Social Share',
            'width='+popupMeta.width+',height='+popupMeta.height+
            ',left='+vpPsition+',top='+hPosition+
            ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');
     
        if (popup) {
            popup.focus();
            return false;
        }
    });
</script> -->