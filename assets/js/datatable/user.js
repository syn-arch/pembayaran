$(function () {

    const userTable = $('#table-user').dataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + "user/get_user_json",
            "type": "POST"
        },
        "columns": [
            { "data": "id_user" },
            { "data": "nama_user" },
            { "data": "alamat" },
            { "data": "jk" },
            { "data": "telepon" },
            { "data": "email" },
            { "data": "nama_role" },
            {
                "data": "id_user",
                "render": function (data, type, row) {
                    return `<a title="ubah" class="btn btn-warning" href="${base_url}user/ubah/${data}"><i class="fa fa-edit"></i></a>
				<a title="hapus" class="btn btn-danger hapus_user" data-href="${base_url}user/hapus/${data}"><i class="fa fa-trash"></i></a>`
                }
            }
        ],
    })

    $(document).on('click', '.hapus_user', function () {
        hapus($(this).data('href'))
    })

})
