<?php

$hasil = array();

if (isset($_POST['generate']))
{
    // get form data
    $table_name = safe($_POST['table_name']);
    $jenis_tabel = safe($_POST['jenis_tabel']);

    if (isset($_POST['export_excel'])) {
        $export_excel = safe($_POST['export_excel']);
    }else{
        $export_excel = '0';
    }

    if (isset($_POST['export_word'])) {
        $export_word = safe($_POST['export_word']);
    }else{
        $export_word = '0';
    }

    if (isset($_POST['export_pdf'])) {
        $export_pdf = safe($_POST['export_pdf']);
    }else{
        $export_pdf = '0';
    }

    $controller = safe($_POST['controller']);
    $model = safe($_POST['model']);

    if ($table_name <> '')
    {
        // set data
        $table_name = $table_name;
        $c = $controller <> '' ? ucfirst($controller) : ucfirst($table_name);
        $m = $model <> '' ? ucfirst($model) : ucfirst($table_name) . '_model';
        $v_list = $table_name . "_list";
        $v_read = $table_name . "_read";
        $v_form = $table_name . "_form";
        $v_doc = $table_name . "_doc";
        $v_pdf = $table_name . "_pdf";

        // url
        $c_url = strtolower($c);
        $module = strtolower($table_name);

        // filename
        $c_file = $c . '.php';
        $m_file = $m . '.php';
        $v_list_file = $v_list . '.php';
        $v_read_file = $v_read . '.php';
        $v_form_file = $v_form . '.php';
        $v_doc_file = $v_doc . '.php';
        $v_pdf_file = $v_pdf . '.php';

        // read setting
        $target = FCPATH . 'application/modules/';


        if (!file_exists($target . $module . "/controllers/"))
        {
            mkdir($target . $module . "/controllers/", 0777, true);
        }

        if (!file_exists($target . $module . "/models/"))
        {
            mkdir($target . $module . "/models/", 0777, true);
        }

        if (!file_exists($target . $module . "/views/"))
        {
            mkdir($target . $module . "/views/", 0777, true);
        }

        $pk = $hc->primary_field($table_name);
        $non_pk = $hc->not_primary_field($table_name);
        $all = $hc->all_field($table_name);

        // generate
        include FCPATH . 'harviacode/core/create_config_pagination.php';
        include FCPATH . 'harviacode/core/create_controller.php';
        include FCPATH . 'harviacode/core/create_model.php';
        if ($jenis_tabel == 'reguler_table') {
            include FCPATH . 'harviacode/core/create_view_list.php';
        } else {
            include FCPATH . 'harviacode/core/create_view_list_datatables.php';
            include FCPATH . 'harviacode/core/create_libraries_datatables.php';
        }
        include FCPATH . 'harviacode/core/create_view_form.php';
        include FCPATH . 'harviacode/core/create_view_read.php';

        $export_excel == 1 ? include FCPATH . 'harviacode/core/create_exportexcel_helper.php' : '';
        $export_word == 1 ? include FCPATH . 'harviacode/core/create_view_list_doc.php' : '';
        $export_pdf == 1 ? include FCPATH . 'harviacode/core/create_pdf_library.php' : '';
        $export_pdf == 1 ? include FCPATH . 'harviacode/core/create_view_list_pdf.php' : '';

        $hasil[] = $hasil_controller;
        $hasil[] = $hasil_model;
        $hasil[] = $hasil_view_list;
        $hasil[] = $hasil_view_form;
        $hasil[] = $hasil_view_read;
        if (isset($_POST['export_word'])) {
            $hasil[] = $hasil_view_doc;
        }
        if (isset($_POST['export_pdf'])) {
            $hasil[] = $hasil_view_pdf;
            $hasil[] = $hasil_pdf;
        }
        if (isset($_POST['export_excel'])) {
            $hasil[] = $hasil_exportexcel;
        }

        $hasil[] = $hasil_config_pagination;
    } else
    {
        $hasil[] = 'No table selected.';
    }
}
?>