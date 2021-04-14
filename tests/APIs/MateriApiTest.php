<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Training;

class TrainingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_materi()
    {
        $materi = Training::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/trainings', $materi
        );

        $this->assertApiResponse($materi);
    }

    /**
     * @test
     */
    public function test_read_materi()
    {
        $materi = Training::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/trainings/'.$materi->id
        );

        $this->assertApiResponse($materi->toArray());
    }

    /**
     * @test
     */
    public function test_update_materi()
    {
        $materi = Training::factory()->create();
        $editedTraining = Training::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/trainings/'.$materi->id,
            $editedTraining
        );

        $this->assertApiResponse($editedTraining);
    }

    /**
     * @test
     */
    public function test_delete_materi()
    {
        $materi = Training::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/trainings/'.$materi->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/trainings/'.$materi->id
        );

        $this->response->assertStatus(404);
    }
}
