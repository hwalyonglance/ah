<?php namespace Tests\Repositories;

use App\Models\Training;
use App\Repositories\TrainingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TrainingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TrainingRepository
     */
    protected $materiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->materiRepo = \App::make(TrainingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_materi()
    {
        $materi = Training::factory()->make()->toArray();

        $createdTraining = $this->materiRepo->create($materi);

        $createdTraining = $createdTraining->toArray();
        $this->assertArrayHasKey('id', $createdTraining);
        $this->assertNotNull($createdTraining['id'], 'Created Training must have id specified');
        $this->assertNotNull(Training::find($createdTraining['id']), 'Training with given id must be in DB');
        $this->assertModelData($materi, $createdTraining);
    }

    /**
     * @test read
     */
    public function test_read_materi()
    {
        $materi = Training::factory()->create();

        $dbTraining = $this->materiRepo->find($materi->id);

        $dbTraining = $dbTraining->toArray();
        $this->assertModelData($materi->toArray(), $dbTraining);
    }

    /**
     * @test update
     */
    public function test_update_materi()
    {
        $materi = Training::factory()->create();
        $fakeTraining = Training::factory()->make()->toArray();

        $updatedTraining = $this->materiRepo->update($fakeTraining, $materi->id);

        $this->assertModelData($fakeTraining, $updatedTraining->toArray());
        $dbTraining = $this->materiRepo->find($materi->id);
        $this->assertModelData($fakeTraining, $dbTraining->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_materi()
    {
        $materi = Training::factory()->create();

        $resp = $this->materiRepo->delete($materi->id);

        $this->assertTrue($resp);
        $this->assertNull(Training::find($materi->id), 'Training should not exist in DB');
    }
}
