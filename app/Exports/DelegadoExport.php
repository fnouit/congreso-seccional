<?php

namespace App\Exports;

use App\Delegado;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class DelegadoExport implements FromView
{
    use Exportable;
    
    public function view(): View
    {

        return view('admin.delegados.excel', [
            'delegados' => Delegado::all()
        ]);
    }
}