<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_imports_students_with_required_password_change(): void
    {
        $admin = User::factory()->admin()->create();
        $file = UploadedFile::fake()->createWithContent(
            'siswi.csv',
            "name,username,email,password,inisial,kelas,usia,sekolah\nRani Contoh,rani.contoh,rani@example.test,Temporary-password-123,RC,XI,16,SMK Arga Husada\n",
        );

        $this->actingAs($admin)
            ->post(route('admin.students.import'), ['file' => $file])
            ->assertRedirect()
            ->assertSessionHas('status', '1 akun siswi berhasil diimpor.');

        $student = User::query()->where('username', 'rani.contoh')->firstOrFail();
        $this->assertSame('siswi', $student->role);
        $this->assertTrue($student->password_change_required);
        $this->assertTrue(Hash::check('Temporary-password-123', $student->password));
        $this->assertSame('RC', $student->studentProfile->inisial);
    }

    public function test_invalid_student_import_creates_no_records(): void
    {
        $admin = User::factory()->admin()->create();
        $file = UploadedFile::fake()->createWithContent(
            'siswi.csv',
            "name,username,email,password,inisial,kelas,usia,sekolah\nBad User,bad.user,bad@example.test,short,B,XIV,9,SMK\n",
        );

        $this->actingAs($admin)
            ->from(route('admin.students'))
            ->post(route('admin.students.import'), ['file' => $file])
            ->assertRedirect(route('admin.students'))
            ->assertSessionHasErrors('file');

        $this->assertDatabaseCount('student_profiles', 0);
        $this->assertDatabaseMissing('users', ['username' => 'bad.user']);
    }

    public function test_admin_imports_question_rows_only_as_question_items(): void
    {
        $admin = User::factory()->admin()->create();
        $file = UploadedFile::fake()->createWithContent(
            'questions.csv',
            "question_text,aspect,is_unfavorable,sort_order\nApakah materi ini jelas?,kognitif,negatif,1\n",
        );

        $this->actingAs($admin)
            ->post(route('admin.questions.import'), ['file' => $file])
            ->assertRedirect()
            ->assertSessionHas('status', '1 pertanyaan berhasil diimpor ke pretest.');

        $question = Question::query()->firstOrFail();
        $this->assertSame('Apakah materi ini jelas?', $question->question_text);
        $this->assertTrue($question->is_unfavorable);
        $this->assertTrue($question->tests()->where('type', 'pretest')->exists());
    }

    public function test_invalid_question_import_is_rolled_back(): void
    {
        $admin = User::factory()->admin()->create();
        $file = UploadedFile::fake()->createWithContent(
            'questions.csv',
            "question_text,aspect,is_unfavorable,sort_order\nThis is a statement,kognitif,positif,1\n",
        );

        $this->actingAs($admin)
            ->from(route('admin.questions'))
            ->post(route('admin.questions.import'), ['file' => $file])
            ->assertRedirect(route('admin.questions'))
            ->assertSessionHasErrors('file');

        $this->assertDatabaseCount('questions', 0);
        $this->assertDatabaseCount('test_questions', 0);
    }
}
