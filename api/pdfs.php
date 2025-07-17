<?php
    use Dompdf\Dompdf;
    use Dompdf\Options;
    require_once 'dompdf/autoload.inc.php';
    
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        ob_start();
        require __DIR__."/api/dex.php";
        
        $dompdf->loadHtml(ob_get_clean());
        $dompdf->render();
        $dompdf->stream("DPaciente.pdf",["Attachment" => false]);
        
    
?>

