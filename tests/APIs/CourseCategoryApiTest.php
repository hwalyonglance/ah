<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CourseCategory;

class CourseCategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_course_category()
    {
        $courseCategory = CourseCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/course_categories', $courseCategory
        );

        $this->assertApiResponse($courseCategory);
    }

    /**
     * @test
     */
    public function test_read_course_category()
    {
        $courseCategory = CourseCategory::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/course_categories/'.$courseCategory->id
        );

        $this->assertApiResponse($courseCategory->toArray());
    }

    /**
     * @test
     */
    public function test_update_course_category()
    {
        $courseCategory = CourseCategory::factory()->create();
        $editedCourseCategory = CourseCategory::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/course_categories/'.$courseCategory->id,
            $editedCourseCategory
        );

        $this->assertApiResponse($editedCourseCategory);
    }

    /**
     * @test
     */
    public function test_delete_course_category()
    {
        $courseCategory = CourseCategory::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/course_categories/'.$courseCategory->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/course_categories/'.$courseCategory->id
        );

        $this->response->assertStatus(404);
    }
}
