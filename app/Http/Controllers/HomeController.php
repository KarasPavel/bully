<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use Sujip\Guid\Facades\Guid;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/');
    }

    public function barcode()
    {
$str = Guid::create();

        $qrCode = new QrCode();
        $qrCode->setText($str);
        $qrCode ->setSize(300);
        $qrCode ->setPadding(10);
        $qrCode->setErrorCorrection('high');
        $qrCode->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0));
        $qrCode->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0));
        $qrCode->setLabel('Scan Qr Code');
        $qrCode->setLabelFontSize(16);
        $qrCode->setImageType(QrCode::IMAGE_TYPE_PNG);

        $barcode = new BarcodeGenerator();
        $barcode->setText($str);
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(2);
        $barcode->setThickness(25);
        $barcode->setFontSize(10);
        $code = $barcode->generate();



        echo '<img src="data:'.$qrCode->getContentType().';base64,'.$qrCode->generate().'" />';
        echo '<img src="data:image/png;base64,'.$code.'"/>';
        return view('barcode');
    }
}
