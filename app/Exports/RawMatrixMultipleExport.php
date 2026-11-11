<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RawMatrixMultipleExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Pretest' => new RawAnswersExport('pretest'),
            'Posttest' => new RawAnswersExport('posttest'),
        ];
    }
}
