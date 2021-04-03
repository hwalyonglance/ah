<?php namespace Tests\Repositories;

use App\Models\MateriBab;
use App\Repositories\MateriBabRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MateriBabRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MateriBabRepository
     */
    protected $materiBabRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->materiBabRepo = \App::make(MateriBabRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_materi_bab()
    {
        $materiBab = MateriBab::factory()->make()->toArray();

        $createdMateriBab = $this->materiBabRepo->create($materiBab);

        $createdMateriBab = $createdMateriBab->toArray();
        $this->assertArrayHasKey('id', $createdMateriBab);
        $this->assertNotNull($createdMateriBab['id'], 'Created MateriBab must have id specified');
        $this->assertNotNull(MateriBab::find($createdMateriBab['id']), 'MateriBab with given id must be in DB');
        $this->assertModelData($materiBab, $createdMateriBab);
    }

    /**
     * @test read
     */
    public function test_read_materi_bab()
    {
        $materiBab = MateriBab::factory()->create();

        $dbMateriBab = $this->materiBabRepo->find($materiBab->id);

        $dbMateriBab = $dbMateriBab->toArray();
        $this->assertModelData($materiBab->toArray(), $dbMateriBab);
    }

    /**
     * @test update
     */
    public function test_update_materi_bab()
    {
        $materiBab = MateriBab::factory()->create();
        $fakeMateriBab = MateriBab::factory()->make()->toArray();

        $updatedMateriBab = $this->materiBabRepo->update($fakeMateriBab, $materiBab->id);

        $this->assertModelData($fakeMateriBab, $updatedMateriBab->toArray());
        $dbMateriBab = $this->materiBabRepo->find($materiBab->id);
        $this->assertModelData($fakeMateriBab, $dbMateriBab->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_materi_bab()
    {
        $materiBab = MateriBab::factory()->create();

        $resp = $this->materiBabRepo->delete($materiBab->id);

        $this->assertTrue($resp);
        $this->assertNull(MateriBab::find($materiBab->id), 'MateriBab should not exist in DB');
    }
}
