<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Repositories\CourseRepository;
use App\Repositories\CourseCategoryRepository;
use App\Repositories\RoleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CourseController extends AppBaseController
{
    /** @var  CourseRepository */
    private $courseRepository;

    /** @var  CourseCategoryRepository */
    private $courseCategoryRepo;

    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(
        CourseRepository $courseRepo,
        CourseCategoryRepository $courseCategoryRepo,
        RoleRepository $roleRepository
    )
    {
        $this->courseRepository = $courseRepo;
        $this->courseCategoryRepo = $courseCategoryRepo;
        $this->roleRepository = $roleRepository;
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
        $courses = $this->courseRepository->all([], ['category','role']);

        return view('courses.index')
            ->with('courses', $courses);
    }

    /**
     * Show the form for creating a new Course.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->roleRepository->options('nama');
        // dd($roles);
        $categories = $this->courseCategoryRepo->options('name');

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
        $categories = $this->courseCategoryRepo->options('name');

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
            unlink($prev_gambar_path);
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
}
