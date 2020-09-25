<?php
    require('lib/phpToPDF/phpToPDF.php');

    //Set Your Options -- see documentation for all options
    ob_start();
    include('problem_set_print.php');
    $my_html = ob_get_clean();

    //Set Your Options -- we are saving the PDF as 'my_filename.pdf' to a 'my_pdfs' folder
    $pdf_options = array(
      "source_type" => 'html',
      "source" => $my_html,
      "action" => 'save',
      "save_directory" => 'my_pdfs',
      "file_name" => 'my_filename.pdf');
       //Code to generate PDF file from options above
    phptopdf($pdf_options);
    return;
?> 