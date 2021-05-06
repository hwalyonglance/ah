<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\CreateTakeCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Repositories\TakeCourseRepository;
use App\Repositories\CourseRepository;
use App\Repositories\CourseChapterRepository;
use App\Repositories\CourseCategoryRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class CourseController extends AppBaseController
{
    /** @var  CourseRepository */
    private $courseRepository;

    /** @var  CourseChapterRepository */
    private $courseChapterRepository;

    /** @var  CourseCategoryRepository */
    private $courseCategoryRepository;

    /** @var  RoleRepository */
    private $roleRepository;

    /** @var  TakeCourseRepository */
    private $takeCourseRepository;

    public function __construct(
        TakeCourseRepository $takeCourseRepo,
        CourseRepository $courseRepo,
        CourseChapterRepository $courseChapterRepo,
        CourseCategoryRepository $courseCategoryRepository,
        RoleRepository $roleRepository
    ) {
        $this->courseRepository         = $courseRepo;
        $this->courseChapterRepository  = $courseChapterRepo;
        $this->courseCategoryRepository = $courseCategoryRepository;
        $this->roleRepository           = $roleRepository;
        $this->takeCourseRepository     = $takeCourseRepo;
    }

    /**
     * Display a listing of the Course.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user                    = auth()->user();
        $courses                 = [];
        $coursesGroupByCategory  = [];
        $coursesTaken            = [];
        $search                  = [];
        if (!$user->is_admin) {
            $search['role_id'] = $user->role_id;

            $coursesTaken = $this->takeCourseRepository
                ->model
                ->where('user_id', $user->id)
                ->with('course')
                ->whereHas('course')
                ->whereHas('user')
                ->get();

            $coursesGroupByCategory = $this->courseCategoryRepository
                ->model
                ->with(
                    [
                        'courses' => function ($with_courses) {

                        }
                    ]
                )
                ->whereHas(
                    'courses',
                    function ($where_courses)
                    use ($user, $coursesTaken) {
                        $where_courses
                            ->where('role_id', $user->role_id)
                            ->whereNotIn('id', $coursesTaken->pluck('id'));
                    }
                )
                ->get();
            // dd(
            //     [
            //         'coursesGroupByCategory' => json_decode($coursesGroupByCategory),
            //         'coursesTaken'           => json_decode($coursesTaken),
            //     ]
            // );
        } else {
            $courses = $this->courseRepository->all($search, ['category','role']);
        }

        return view(
            'courses.index',
            compact(
                'user',
                'courses',
                'coursesGroupByCategory',
                'coursesTaken'
            )
        );
    }

    /**
     * Show the form for creating a new Course.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->roleRepository->options('nama');
        unset($roles[1]);
        $categories = $this->courseCategoryRepository->options('name');

        return view('courses.create', compact('categories', 'roles'));
    }

    /**
     * Store a newly created Course in storage.
     *
     * @param CreateCourseRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseRequest $request)
    {
        $input = $request->all();

        $gambar = $request->file('gambar');
        $input['gambar'] = $gambar->store('uploads/course', 'public');
        // return redirect(url($input['gambar']));

        $course = $this->courseRepository->create($input);

        Flash::success('Course saved successfully.');

        return redirect(route('courses.index'));
    }

    /**
     * Display the specified Course.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $chapters = [];
        if (!$user->is_admin) {
            $chapters = $this->courseChapterRepository->all(
                ['course_id'=>$id],
                [],
                null,
                null,
                ['id']
            );
            // dd(json_decode($chapters));
            $firstChapter = $chapters->first();
            return redirect(route('training.chapter.show',
                [
                    'training'  =>  $id,
                    'chapter'   =>  $firstChapter->id
                ]
            ));
        }
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        return view('courses.show')->with('course', $course);
    }

    /**
     * Show the form for editing the specified Course.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }
        $roles = $this->roleRepository->options('nama');
        unset($roles[1]);
        $categories = $this->courseCategoryRepository->options('name');

        return view('courses.edit', compact('course', 'roles','categories'));
    }

    /**
     * Update the specified Course in storage.
     *
     * @param int $id
     * @param UpdateCourseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseRequest $request)
    {
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $prev_gambar_path = storage_path('app/public/'.$course->gambar);
            // dd($prev_gambar_path);
            @unlink($prev_gambar_path);
            $input['gambar'] = $gambar->store('uploads/course', 'public');
        }

        $course = $this->courseRepository->update($input, $id);

        Flash::success('Course updated successfully.');

        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified Course from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        $this->courseRepository->delete($id);

        Flash::success('Course deleted successfully.');

        return redirect(route('courses.index'));
    }

    /**
     * Take the specified Course.
     *
     * @param int $course_id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function take($course_id, CreateTakeCourseRequest $request) {
        $user = auth()->user();
        // dd($course_id);
        // $takeCourse = TakeCourse::create();
        $takeCourse = $this->takeCourseRepository->create(
            [
                'user_id'   => $user->id,
                'course_id' => $course_id,
                'status'    => 0
            ]
        );

        $chapters = $this->courseChapterRepository->all(
            ['course_id'=>$course_id],
            [],
            null,
            null,
            ['id']
        );

        $firstChapter = $chapters->first();

        // dd(json_decode($takeCourse), json_decode($chapters));

        Flash::success('Course berhasil diambil.');

        return redirect(route('courses.chapter.show',
            [
                'course'   =>  $course_id,
                'chapter'  =>  $firstChapter->id
            ]
        ));
    }
}
