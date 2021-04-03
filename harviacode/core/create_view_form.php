<?php 

    
$string = "<div class=\"row\">
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
                        <a href=\"<?php echo base_url('".$c_url."') ?>\" class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class=\"box-body\">
                <div class=\"row\">
                    <div class=\"col-md-2\"></div>
                    <div class=\"col-md-8\">
                <form action=\"<?php echo \$action; ?>\" method=\"post\">";
                foreach ($non_pk as $row) {
                    if ($row["data_type"] == 'text')
                    {
                    $string .= "\n\t    <div class=\"form-group <?php if(form_error('".$row['column_name']."')) echo 'has-error'?> \">
                            <label for=\"".$row["column_name"]."\">".label($row["column_name"])."</label>
                            <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
                            <?php echo form_error('".$row["column_name"]."', '<small style=\"color:red\">','</small>') ?>
                        </div>";
                    } else
                    {
                    $string .= "\n\t    <div class=\"form-group <?php if(form_error('".$row['column_name']."')) echo 'has-error'?> \">
                            <label for=\"".$row["data_type"]."\">".label($row["column_name"])."</label>
                            <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
                            <?php echo form_error('".$row["column_name"]."', '<small style=\"color:red\">','</small>') ?>
                        </div>";
                    }
                }
                $string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
                $string .= "\n\t    <button type=\"submit\" class=\"btn btn-primary btn-block\">SUBMIT</button> ";
                $string .= "\n\t</form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>";



$hasil_view_form = createFile($string, $target . $module . "/views/" . $v_form_file);

?>