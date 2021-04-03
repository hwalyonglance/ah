<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MateriBab;

class MateriBabApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_materi_bab()
    {
        $materiBab = MateriBab::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/materi_babs', $materiBab
        );

        $this->assertApiResponse($materiBab);
    }

    /**
     * @test
     */
    public function test_read_materi_bab()
    {
        $materiBab = MateriBab::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/materi_babs/'.$materiBab->id
        );

        $this->assertApiResponse($materiBab->toArray());
    }

    /**
     * @test
     */
    public function test_update_materi_bab()
    {
        $materiBab = MateriBab::factory()->create();
        $editedMateriBab = MateriBab::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/materi_babs/'.$materiBab->id,
            $editedMateriBab
        );

        $this->assertApiResponse($editedMateriBab);
    }

    /**
     * @test
     */
    public function test_delete_materi_bab()
    {
        $materiBab = MateriBab::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/materi_babs/'.$materiBab->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/materi_babs/'.$materiBab->id
        );

        $this->response->assertStatus(404);
    }
}
