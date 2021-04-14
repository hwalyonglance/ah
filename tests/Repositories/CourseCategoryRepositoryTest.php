<?php namespace Tests\Repositories;

use App\Models\CourseCategory;
use App\Repositories\CourseCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CourseCategoryRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CourseCategoryRepository
     */
    protected $courseCategoryRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->courseCategoryRepo = \App::make(CourseCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_course_category()
    {
        $courseCategory = CourseCategory::factory()->make()->toArray();

        $createdCourseCategory = $this->courseCategoryRepo->create($courseCategory);

        $createdCourseCategory = $createdCourseCategory->toArray();
        $this->assertArrayHasKey('id', $createdCourseCategory);
        $this->assertNotNull($createdCourseCategory['id'], 'Created CourseCategory must have id specified');
        $this->assertNotNull(CourseCategory::find($createdCourseCategory['id']), 'CourseCategory with given id must be in DB');
        $this->assertModelData($courseCategory, $createdCourseCategory);
    }

    /**
     * @test read
     */
    public function test_read_course_category()
    {
        $courseCategory = CourseCategory::factory()->create();

        $dbCourseCategory = $this->courseCategoryRepo->find($courseCategory->id);

        $dbCourseCategory = $dbCourseCategory->toArray();
        $this->assertModelData($courseCategory->toArray(), $dbCourseCategory);
    }

    /**
     * @test update
     */
    public function test_update_course_category()
    {
        $courseCategory = CourseCategory::factory()->create();
        $fakeCourseCategory = CourseCategory::factory()->make()->toArray();

        $updatedCourseCategory = $this->courseCategoryRepo->update($fakeCourseCategory, $courseCategory->id);

        $this->assertModelData($fakeCourseCategory, $updatedCourseCategory->toArray());
        $dbCourseCategory = $this->courseCategoryRepo->find($courseCategory->id);
        $this->assertModelData($fakeCourseCategory, $dbCourseCategory->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_course_category()
    {
        $courseCategory = CourseCategory::factory()->create();

        $resp = $this->courseCategoryRepo->delete($courseCategory->id);

        $this->assertTrue($resp);
        $this->assertNull(CourseCategory::find($courseCategory->id), 'CourseCategory should not exist in DB');
    }
}
