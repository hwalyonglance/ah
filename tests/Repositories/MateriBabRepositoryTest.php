<?php namespace Tests\Repositories;

use App\Models\TrainingChapter;
use App\Repositories\TrainingChapterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TrainingChapterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TrainingChapterRepository
     */
    protected $materiBabRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->materiBabRepo = \App::make(TrainingChapterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_materi_chapter()
    {
        $materiBab = TrainingChapter::factory()->make()->toArray();

        $createdTrainingChapter = $this->materiBabRepo->create($materiBab);

        $createdTrainingChapter = $createdTrainingChapter->toArray();
        $this->assertArrayHasKey('id', $createdTrainingChapter);
        $this->assertNotNull($createdTrainingChapter['id'], 'Created TrainingChapter must have id specified');
        $this->assertNotNull(TrainingChapter::find($createdTrainingChapter['id']), 'TrainingChapter with given id must be in DB');
        $this->assertModelData($materiBab, $createdTrainingChapter);
    }

    /**
     * @test read
     */
    public function test_read_materi_chapter()
    {
        $materiBab = TrainingChapter::factory()->create();

        $dbTrainingChapter = $this->materiBabRepo->find($materiBab->id);

        $dbTrainingChapter = $dbTrainingChapter->toArray();
        $this->assertModelData($materiBab->toArray(), $dbTrainingChapter);
    }

    /**
     * @test update
     */
    public function test_update_materi_chapter()
    {
        $materiBab = TrainingChapter::factory()->create();
        $fakeTrainingChapter = TrainingChapter::factory()->make()->toArray();

        $updatedTrainingChapter = $this->materiBabRepo->update($fakeTrainingChapter, $materiBab->id);

        $this->assertModelData($fakeTrainingChapter, $updatedTrainingChapter->toArray());
        $dbTrainingChapter = $this->materiBabRepo->find($materiBab->id);
        $this->assertModelData($fakeTrainingChapter, $dbTrainingChapter->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_materi_chapter()
    {
        $materiBab = TrainingChapter::factory()->create();

        $resp = $this->materiBabRepo->delete($materiBab->id);

        $this->assertTrue($resp);
        $this->assertNull(TrainingChapter::find($materiBab->id), 'TrainingChapter should not exist in DB');
    }
}
