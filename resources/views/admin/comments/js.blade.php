<script>
    /*DataTable*/
    var table = $('#manager_comment_table').DataTable({
        processing: true,
        ajax: {
            url: route('manager.comments.getComment'),
        },
        columns: [
            {data: 'DT_Row_Index', name: 'id'},
        ]
    });
    /*----------*/
</script>
