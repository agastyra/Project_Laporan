<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class NeracaSaldoController extends Controller
{
    public function index()
    {
        return view('NeracaSaldo.index');
    }

    public function print()
    {
        $data = [
            "title" => 'Neraca Saldo',
            "mergeData" => [0123],
        ];
    
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $paperSize = 'A4';
        $paperOrientation = 'portrait';
        $config = app(Repository::class);
        $files = app(Filesystem::class);
        $view = app(Factory::class);
        $pdf = new PDF($dompdf, $config, $files, $view, $paperSize, $paperOrientation);
        $pdf->loadView('NeracaSaldo.print', $data);
        return $pdf->download('NeracaSaldo.print');
    }

}