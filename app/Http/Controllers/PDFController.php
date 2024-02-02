<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;

class PDFController extends Controller
{

    public function generatePDF(Request $request)
    {


        $data = [
            'title' => 'Factura ZapFlow',
            'username' => $request->username,
            'email' => $request->email,
            'idfactura' => $request->idfactura,
            'bono' => $request->bono,
            'precio' => $request->precio,
            'fecha' => $request->fecha,
        ];


        $pdf = PDF::loadView('myPDF', $data);
        PDF::setOptions(['defaultFont' => 'sans-serif', 'defaultMediaType'=> 'print']);
        return response($pdf->output(), 200)->header('Content-Type', 'application/pdf');

    }
}
