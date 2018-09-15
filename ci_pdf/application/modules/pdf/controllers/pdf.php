<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends MY_Controller {


	function __construct()
	{
        parent::__construct();
    }

	public function index()
	{
		// $filename = time()."_pdf.pdf";

		// // $html = $this->load->view('unpaid_voucher',$data,true);
		// $html = $this->load->view('pdf_v',"",true);

		// // unpaid_voucher is unpaid_voucher.php file in view directory and $data variable has infor mation that you want to render on view.

		// $this->load->library('mpdf');

		// $this->m_pdf->pdf->WriteHTML($html);

		// //download it D save F.

		// $this->m_pdf->pdf->Output("./uploads/".$filename, "F");

		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];

		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];

		$filename = time()."_pdf.pdf";

		$mpdf = new \Mpdf\Mpdf([
		    'fontDir' => array_merge($fontDirs, [
		        __DIR__ . '/custom/font/directory',
		    ]),
		    'fontdata' => $fontData + [
		        'solaimanlipi' => [
		            'R' => 'SolaimanLipi.ttf',
		            'useOTL' => 0xFF,
		        ]
		    ],
		    'default_font' => 'solaimanlipi'
		]);

        $html = $this->load->view('pdf_v',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output("./uploads/".$filename, "F");
        $this->load->view('pdf_v');
	}
}
