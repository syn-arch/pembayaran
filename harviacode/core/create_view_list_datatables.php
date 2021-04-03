<?php 

$string = "
<div class=\"row\">
    <div class=\"col-xs-12\">
        <div class=\"box box-primary\">
            <div class=\"box-header with-border\">
                <div class=\"pull-left\">
                    <div class=\"box-title\">
                        <h4><?php echo \$judul ?></h4>
                    </div>
                </div>
                <div class=\"pull-right\">
                    <div class=\"box-title\">
                        <?php echo anchor(site_url('".$c_url."/create'), '<i class=\"fas fa-plus\"></i> Tambah Data', 'class=\"btn btn-primary\"'); ?>";
                        if ($export_excel == '1') {
                            $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), '<i class=\"fas fa-sign-out-alt\"></i> Excel', 'class=\"btn btn-success\"'); ?>";
                        }
                        if ($export_word == '1') {
                            $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), '<i class=\"fas fa-sign-out-alt\"></i> Word', 'class=\"btn btn-warning\"'); ?>";
                        }
                        if ($export_pdf == '1') {
                            $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), '<i class=\"fas fa-sign-out-alt\"></i> Pdf', 'class=\"btn btn-danger\"'); ?>";
                        }
                        $string .= "\n\t
                    </div>
                </div>
            </div>
            <div class=\"box-body\">
                <div class=\"table-responsive\">
                    <table class=\"table table-bordered table-striped dt\" width=\"100%\" id=\"#mytable\">
                       <thead>
                    <tr>
                    <th>No</th>";
                    foreach ($non_pk as $row) {
                        $string .= "\n\t\t    <th>" . label($row['column_name']) . "</th>";
                    }
                    $string .= "\n\t\t    <th>Action</th>
                                    </tr>
                                </thead>";

                    $column_non_pk = array();
                    foreach ($non_pk as $row) {
                        $column_non_pk[] .= "{\"data\": \"".$row['column_name']."\"}";
                    }
                    $col_non_pk = implode(',', $column_non_pk);

                    $string .= "\n\t    
                            </table>
                </div>
            </div>
        </div>
    </div>

        <script type=\"text/javascript\">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        \"iStart\": oSettings._iDisplayStart,
                        \"iEnd\": oSettings.fnDisplayEnd(),
                        \"iLength\": oSettings._iDisplayLength,
                        \"iTotal\": oSettings.fnRecordsTotal(),
                        \"iFilteredTotal\": oSettings.fnRecordsDisplay(),
                        \"iPage\": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        \"iTotalPages\": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $(\".dt\").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: \"loading...\"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {\"url\": \"".$c_url."/json\", \"type\": \"POST\"},
                    columns: [
                        {
                            \"data\": \"$pk\",
                            \"orderable\": false
                        },".$col_non_pk.",
                        {
                            \"data\" : \"action\",
                            \"orderable\": false,
                            \"className\" : \"text-center\"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });

               $(document).on(\"click\", \".hapus-data\", function () {
                  hapus($(this).data(\"href\"));
                });

            });

        </script>";


$hasil_view_list = createFile($string, $target . $module . "/views/" . $v_list_file);

?>