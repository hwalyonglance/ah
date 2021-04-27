<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CourseChapter;

class CourseChapterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_course_chapter()
    {
        $courseChapter = CourseChapter::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/course_chapters', $courseChapter
        );

        $this->assertApiResponse($courseChapter);
    }

    /**
     * @test
     */
    public function test_read_course_chapter()
    {
        $courseChapter = CourseChapter::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/course_chapters/'.$courseChapter->id
        );

        $this->assertApiResponse($courseChapter->toArray());
    }

    /**
     * @test
     */
    public function test_update_course_chapter()
    {
        $courseChapter = CourseChapter::factory()->create();
        $editedCourseChapter = CourseChapter::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/course_chapters/'.$courseChapter->id,
            $editedCourseChapter
        );

        $this->assertApiResponse($editedCourseChapter);
    }

    /**
     * @test
     */
    public function test_delete_course_chapter()
    {
        $courseChapter = CourseChapter::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/course_chapters/'.$courseChapter->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/course_chapters/'.$courseChapter->id
        );

        $this->response->assertStatus(404);
    }
}
