<?php namespace Tests\Repositories;

use App\Models\Materi;
use App\Repositories\MateriRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MateriRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MateriRepository
     */
    protected $materiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->materiRepo = \App::make(MateriRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_materi()
    {
        $materi = Materi::factory()->make()->toArray();

        $createdMateri = $this->materiRepo->create($materi);

        $createdMateri = $createdMateri->toArray();
        $this->assertArrayHasKey('id', $createdMateri);
        $this->assertNotNull($createdMateri['id'], 'Created Materi must have id specified');
        $this->assertNotNull(Materi::find($createdMateri['id']), 'Materi with given id must be in DB');
        $this->assertModelData($materi, $createdMateri);
    }

    /**
     * @test read
     */
    public function test_read_materi()
    {
        $materi = Materi::factory()->create();

        $dbMateri = $this->materiRepo->find($materi->id);

        $dbMateri = $dbMateri->toArray();
        $this->assertModelData($materi->toArray(), $dbMateri);
    }

    /**
     * @test update
     */
    public function test_update_materi()
    {
        $materi = Materi::factory()->create();
        $fakeMateri = Materi::factory()->make()->toArray();

        $updatedMateri = $this->materiRepo->update($fakeMateri, $materi->id);

        $this->assertModelData($fakeMateri, $updatedMateri->toArray());
        $dbMateri = $this->materiRepo->find($materi->id);
        $this->assertModelData($fakeMateri, $dbMateri->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_materi()
    {
        $materi = Materi::factory()->create();

        $resp = $this->materiRepo->delete($materi->id);

        $this->assertTrue($resp);
        $this->assertNull(Materi::find($materi->id), 'Materi should not exist in DB');
    }
}
