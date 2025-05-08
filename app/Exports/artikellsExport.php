<?php

namespace App\Exports;

use App\Models\artikell;
use Maatwebsite\Excel\Concerns\FromCollection;

class artikellsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return artikell::all();
    }
}
