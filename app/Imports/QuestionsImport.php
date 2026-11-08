<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Test;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToCollection, WithHeadingRow
{
    public int $importedCount = 0;

    public function collection(Collection $rows): void
    {
        $pretest = Test::query()->where('type', 'pretest')->firstOrFail();
        if ($pretest->attempts()->whereHas('answers')->exists()) {
            throw ValidationException::withMessages([
                'file' => 'Impor pertanyaan tidak dapat dilakukan setelah jawaban pretest masuk.',
            ]);
        }

        foreach ($rows as $index => $row) {
            $attributes = $row->toArray();
            $validator = Validator::make($attributes, [
                'question_text' => ['required', 'string', 'max:2000', 'regex:/\?$/u'],
                'aspect' => ['required', 'in:kognitif,afektif,konatif'],
                'is_unfavorable' => ['required', 'in:0,1,positif,negatif,true,false'],
                'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
            ], [
                'question_text.regex' => 'Pertanyaan harus diakhiri tanda tanya.',
            ]);

            if ($validator->fails()) {
                throw ValidationException::withMessages([
                    'file' => 'Baris '.($index + 2).': '.$validator->errors()->first(),
                ]);
            }

            $data = $validator->validated();
            $isUnfavorable = in_array(mb_strtolower((string) $data['is_unfavorable']), ['1', 'true', 'negatif'], true);
            $question = Question::query()->create([
                'question_text' => trim($data['question_text']),
                'aspect' => $data['aspect'],
                'is_unfavorable' => $isUnfavorable,
                'sort_order' => $data['sort_order'],
            ]);
            $pretest->questions()->attach($question->id, [
                'sort_order' => $pretest->questions()->count() + 1,
            ]);
            $this->importedCount++;
        }
    }
}
