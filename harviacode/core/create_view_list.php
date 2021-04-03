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
                        <a href=\"<?php echo base_url('".$c_url."/create') ?>\" class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i> Tambah Data</a>
                    </div>
                </div>
            </div>
            <div class=\"box-body\">
                <div class=\"table-responsive\">
                    <table class=\"table table-bordered table-striped\" width=\"100%\">
                        <tr>
                            <th>No</th>";
            foreach ($non_pk as $row) {
                $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
            }
            $string .= "\n\t\t<th>Action</th>
                        </tr>";
            $string .= "<?php
                        foreach ($" . $c_url . "_data as \$$c_url)
                        {
                            ?>
                            <tr>";

            $string .= "\n\t\t\t<td><?php echo ++\$start ?></td>";
            foreach ($non_pk as $row) {
                $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
            }

            $string .= "<td>
                        <a href=\"<?php echo site_url('".$table_name."/read/' . $".$c_url."->".$pk." ) ?>\" class=\"btn btn-info\"><i class=\"fa fa-eye\"></i></a>
                        <a href=\"<?php echo site_url('".$table_name."/update/' . $".$c_url."->".$pk." ) ?>\" class=\"btn btn-warning\"><i class=\"fa fa-edit\"></i></a>
                        <a data-href=\"<?php echo site_url('".$table_name."/delete/' . $".$c_url."->".$pk." ) ?>\" class=\"btn btn-danger hapus-data\"><i class=\"fa fa-trash\"></i></a>
                     </td>";


            $string .=  "\n\t\t</tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <div class=\"row\">
                        <div class=\"col-md-6\">
                            <a href=\"#\" class=\"btn btn-primary\">Total Record : <?php echo \$total_rows ?></a>";
            if ($export_excel == '1') {
                $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
            }
            if ($export_word == '1') {
                $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
            }
            if ($export_pdf == '1') {
                $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
            }
            $string .= "\n\t    
                        </div>
                        <div class=\"col-md-6 text-right\">
                            <?php echo \$pagination ?>
                        </div>
                    </div>
                 
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
       $(document).on(\"click\", \".hapus-data\", function () {
          hapus($(this).data(\"href\"));
        });
    });
</script>
";

$hasil_view_list = createFile($string, $target . $module . "/views/" . $v_list_file);

?>