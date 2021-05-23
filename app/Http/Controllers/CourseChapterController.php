<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCourseChapterRequest;
use App\Http\Requests\UpdateCourseChapterRequest;
use App\Models\Training;
use App\Repositories\CourseRepository;
use App\Repositories\CourseChapterRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class CourseChapterController extends AppBaseController
{
    /** @var  Course */
    public $course;

    /** @var  CourseRepository */
    private $courseRepository;

    /** @var  CourseChapterRepository */
    private $courseChapterRepository;

    public function __construct(
        CourseRepository $courseRepo,
        CourseChapterRepository $courseChapterRepo
    ) {
        $this->courseRepository = $courseRepo;
        $this->courseChapterRepository = $courseChapterRepo;
        $course_id = \Route::current()->parameter('course');
        $this->course = $this->courseRepository->model->findOrFail($course_id);
        // dd($course_id);
    }

    /**
     * Display a listing of the CourseChapter.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request, int $course_id)
    {
        $user = auth()->user();
        $courseChapters = $this->courseChapterRepository->all(['course_id' => $course_id]);

        if (!$user->is_trainer) {
            $firstChapter = $courseChapters->first();
            return redirect(route(
                'courses.chapter.show',
                [
                    'course'    =>  $course_id,
                    'chapter'   =>  $firstChapter->id
                ]
            ));
        }

        $course = $this->course;

        return view(
            'courses.chapters.index',
            compact('courseChapters', 'course', 'course_id')
        );
    }

    /**
     * Show the form for creating a new CourseChapter.
     *
     * @return Response
     */
    public function create($course_id)
    {
        return view('courses.chapters.create', compact('course_id'));
    }

    /**
     * Store a newly created CourseChapter in storage.
     *
     * @param CreateCourseChapterRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseChapterRequest $request, $chapter_id)
    {
        $input = $request->all();

        $courseChapter = $this->courseChapterRepository->create($input);

        Flash::success('Course Chapter saved successfully.');

        return redirect(route('courses.chapter.index', $chapter_id));
    }

    /**
     * Display the specified CourseChapter.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($course_id, $id)
    {
        $user = auth()->user();
        $courseChapter = $this->courseChapterRepository->find($id);

        if (empty($courseChapter)) {
            Flash::error('Course Chapter not found');

            return redirect(route('courses.chapter.index', $course_id));
        }

        $course = $this->course;

        $chapters = [];

        if (!$user->is_trainer) {
            $chapters = $this->courseChapterRepository->all(['course_id' => $course_id]);
        }

        return view(
            'courses.chapters.show',
            compact(
                'user',
                'courseChapter',
                'course',
                'course_id',
                'chapters',
            )
        );
    }

    /**
     * Show the form for editing the specified CourseChapter.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($course_id, $id)
    {
        $courseChapter = $this->courseChapterRepository->find($id);

        if (empty($courseChapter)) {
            Flash::error('Course Chapter not found');

            return redirect(route('courseChapters.index'));
        }

        return view('courses.chapters.edit', compact('courseChapter', 'course_id'));
    }

    /**
     * Update the specified CourseChapter in storage.
     *
     * @param int $id
     * @param UpdateCourseChapterRequest $request
     *
     * @return Response
     */
    public function update(UpdateCourseChapterRequest $request, $course_id, $id)
    {
        $courseChapter = $this->courseChapterRepository->find($id);

        if (empty($courseChapter)) {
            Flash::error('Course Chapter not found');

            return redirect(route('courses.chapter.index', $course_id));
        }

        $courseChapter = $this->courseChapterRepository->update($request->all(), $id);

        Flash::success('Course Chapter updated successfully.');

        return redirect(route('courses.chapter.index', $course_id));
    }

    /**
     * Remove the specified CourseChapter from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($course_id, $id)
    {
        $courseChapter = $this->courseChapterRepository->find($id);

        if (empty($courseChapter)) {
            Flash::error('Course Chapter not found');

            return redirect(route('courses.chapter.index', $course_id));
        }

        $this->courseChapterRepository->delete($id);

        Flash::success('Course Chapter deleted successfully.');

        return redirect(route('courses.chapter.index', $course_id));
    }
}
