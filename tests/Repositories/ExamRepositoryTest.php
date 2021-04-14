<?php namespace Tests\Repositories;

use App\Models\Exam;
use App\Repositories\ExamRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ExamRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExamRepository
     */
    protected $examRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->examRepo = \App::make(ExamRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_exam()
    {
        $exam = Exam::factory()->make()->toArray();

        $createdExam = $this->examRepo->create($exam);

        $createdExam = $createdExam->toArray();
        $this->assertArrayHasKey('id', $createdExam);
        $this->assertNotNull($createdExam['id'], 'Created Exam must have id specified');
        $this->assertNotNull(Exam::find($createdExam['id']), 'Exam with given id must be in DB');
        $this->assertModelData($exam, $createdExam);
    }

    /**
     * @test read
     */
    public function test_read_exam()
    {
        $exam = Exam::factory()->create();

        $dbExam = $this->examRepo->find($exam->id);

        $dbExam = $dbExam->toArray();
        $this->assertModelData($exam->toArray(), $dbExam);
    }

    /**
     * @test update
     */
    public function test_update_exam()
    {
        $exam = Exam::factory()->create();
        $fakeExam = Exam::factory()->make()->toArray();

        $updatedExam = $this->examRepo->update($fakeExam, $exam->id);

        $this->assertModelData($fakeExam, $updatedExam->toArray());
        $dbExam = $this->examRepo->find($exam->id);
        $this->assertModelData($fakeExam, $dbExam->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_exam()
    {
        $exam = Exam::factory()->create();

        $resp = $this->examRepo->delete($exam->id);

        $this->assertTrue($resp);
        $this->assertNull(Exam::find($exam->id), 'Exam should not exist in DB');
    }
}
