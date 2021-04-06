const base_url = $('meta[name="base_url"]').attr("content");

// select2
$(".select2").select2();

$('.carisiswa').select2({
  allowClear: true,
  placeholder: 'Masukan Nama Siswa',
  ajax: {
    dataType: 'json',
    url: base_url + 'siswa/siswajson',
    data: function(params) {
      return {
        search: params.term
      }
    },
    processResults: function (data, page) {
      return {
        results: data
      };
    },
  }
})

// datatable
$(".datatable").dataTable();

// ubah akses role
$(".ubah_menu").click(function () {
  const id_menu = $(this).data("menu");
  const id_role = $(this).data("role");

  $.ajax({
    url: `${base_url}user/ubah_akses_role/${id_menu}/${id_role}`,
    method: "post",
    success: function () {

      swal({
        title : "Berhasil",
        text : "Data berhasil diubah",
        icon : "success",
        buttons : false
      })

      window.location.reload(true);
    },
  });
});

// role
$(document).on("click", ".hapus_role", function () {
  hapus($(this).data("href"));
});

$(document).on("click", ".hapus_backup", function () {
  hapus($(this).data("href"));
});

$(document).on("click", ".hapus-menu", function () {

  const id = $(this).data('id')
  const href = $(this).data('href')

  swal({
    title: "Apakah anda yakin?",
    text: "Data yang dihapus tidak dapat dikembalikan!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {

    if (willDelete) {

     swal({
      title: "Hapus direktori?",
      text: "Hapus beserta direktori modul ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {

      if (willDelete) {

        $.ajax({
          url : base_url + '/menu/hapus_direktori/' +  id,
          method : 'get',
          success : function () {
            window.location = href
          }
        })

      }else{
        window.location = href
      }

    });

  }

});

});

// iconpicker
$('.iconpicker').iconpicker();

$('.menu_utama').change(function () {
  menu_utama = parseInt($(this).val());
  if (menu_utama == 0) {
    $('.pilih_menu').show();
    $('.ada_submenu').val(0);
  }else{
    $('.pilih_menu').hide();
    $('.ada_submenu').val(1);
  }
})

$(".dd").nestable({
  maxDepth: 2
});

$(".dd").on("change", function () {
  var serializedData = $(this).nestable("serialize");
  $.ajax({
    url: base_url + "/menu/ubah_posisi_menu",
    data: {
      menu: serializedData,
    },
    type: "post",
    success: function (res) {

     swal({
      title : "Berhasil",
      text : "Data berhasil diubah",
      icon : "success",
      buttons : false
    })

     window.location.reload(true);
   },
 });
});


function toRupiah(angka = '0', idr = false) {
  var rupiah = '';
  if (angka == null) {
    angka = '0';
  }
  var angkarev = angka.toString().split('').reverse().join('');
  for (var i = 0; i < angkarev.length; i++) if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
    if (idr == true) {
      return rupiah.split('', rupiah.length - 1).reverse().join('');
    } else {
      return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
    }
  }