<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Materi;

class MateriApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_materi()
    {
        $materi = Materi::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/materis', $materi
        );

        $this->assertApiResponse($materi);
    }

    /**
     * @test
     */
    public function test_read_materi()
    {
        $materi = Materi::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/materis/'.$materi->id
        );

        $this->assertApiResponse($materi->toArray());
    }

    /**
     * @test
     */
    public function test_update_materi()
    {
        $materi = Materi::factory()->create();
        $editedMateri = Materi::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/materis/'.$materi->id,
            $editedMateri
        );

        $this->assertApiResponse($editedMateri);
    }

    /**
     * @test
     */
    public function test_delete_materi()
    {
        $materi = Materi::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/materis/'.$materi->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/materis/'.$materi->id
        );

        $this->response->assertStatus(404);
    }
}
