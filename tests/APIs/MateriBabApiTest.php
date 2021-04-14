<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TrainingChapter;

class TrainingChapterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_materi_chapter()
    {
        $materiBab = TrainingChapter::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/materi_chapters', $materiBab
        );

        $this->assertApiResponse($materiBab);
    }

    /**
     * @test
     */
    public function test_read_materi_chapter()
    {
        $materiBab = TrainingChapter::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/materi_chapters/'.$materiBab->id
        );

        $this->assertApiResponse($materiBab->toArray());
    }

    /**
     * @test
     */
    public function test_update_materi_chapter()
    {
        $materiBab = TrainingChapter::factory()->create();
        $editedTrainingChapter = TrainingChapter::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/materi_chapters/'.$materiBab->id,
            $editedTrainingChapter
        );

        $this->assertApiResponse($editedTrainingChapter);
    }

    /**
     * @test
     */
    public function test_delete_materi_chapter()
    {
        $materiBab = TrainingChapter::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/materi_chapters/'.$materiBab->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/materi_chapters/'.$materiBab->id
        );

        $this->response->assertStatus(404);
    }
}
