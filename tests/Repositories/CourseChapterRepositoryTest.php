<?php namespace Tests\Repositories;

use App\Models\CourseChapter;
use App\Repositories\CourseChapterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CourseChapterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CourseChapterRepository
     */
    protected $courseChapterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->courseChapterRepo = \App::make(CourseChapterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_course_chapter()
    {
        $courseChapter = CourseChapter::factory()->make()->toArray();

        $createdCourseChapter = $this->courseChapterRepo->create($courseChapter);

        $createdCourseChapter = $createdCourseChapter->toArray();
        $this->assertArrayHasKey('id', $createdCourseChapter);
        $this->assertNotNull($createdCourseChapter['id'], 'Created CourseChapter must have id specified');
        $this->assertNotNull(CourseChapter::find($createdCourseChapter['id']), 'CourseChapter with given id must be in DB');
        $this->assertModelData($courseChapter, $createdCourseChapter);
    }

    /**
     * @test read
     */
    public function test_read_course_chapter()
    {
        $courseChapter = CourseChapter::factory()->create();

        $dbCourseChapter = $this->courseChapterRepo->find($courseChapter->id);

        $dbCourseChapter = $dbCourseChapter->toArray();
        $this->assertModelData($courseChapter->toArray(), $dbCourseChapter);
    }

    /**
     * @test update
     */
    public function test_update_course_chapter()
    {
        $courseChapter = CourseChapter::factory()->create();
        $fakeCourseChapter = CourseChapter::factory()->make()->toArray();

        $updatedCourseChapter = $this->courseChapterRepo->update($fakeCourseChapter, $courseChapter->id);

        $this->assertModelData($fakeCourseChapter, $updatedCourseChapter->toArray());
        $dbCourseChapter = $this->courseChapterRepo->find($courseChapter->id);
        $this->assertModelData($fakeCourseChapter, $dbCourseChapter->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_course_chapter()
    {
        $courseChapter = CourseChapter::factory()->create();

        $resp = $this->courseChapterRepo->delete($courseChapter->id);

        $this->assertTrue($resp);
        $this->assertNull(CourseChapter::find($courseChapter->id), 'CourseChapter should not exist in DB');
    }
}
