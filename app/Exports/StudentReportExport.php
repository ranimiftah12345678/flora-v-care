<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentReportExport implements FromCollection, WithHeadings
{
    public function __construct(private Collection $rows) {}

    public function collection(): Collection
    {
        return $this->rows->map(fn (array $row): array => [
            $row['inisial'],
            $row['kelas'],
            $row['usia'],
            $row['pretest'],
            $row['posttest'],
            $row['difference'],
            $row['pretest_at'],
            $row['posttest_at'],
        ]);
    }

    public function headings(): array
    {
        return ['Inisial', 'Kelas', 'Usia', 'Skor pretest', 'Skor posttest', 'Selisih', 'Waktu pretest', 'Waktu posttest'];
    }
}
