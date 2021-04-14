<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseCategoryRequest;
use App\Http\Requests\UpdateCourseCategoryRequest;
use App\Repositories\CourseCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CourseCategoryController extends AppBaseController
{
    /** @var  CourseCategoryRepository */
    private $courseCategoryRepository;

    public function __construct(CourseCategoryRepository $courseCategoryRepo)
    {
        $this->courseCategoryRepository = $courseCategoryRepo;
    }

    /**
     * Display a listing of the CourseCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $courseCategories = $this->courseCategoryRepository->all();

        return view('course_categories.index')
            ->with('courseCategories', $courseCategories);
    }

    /**
     * Show the form for creating a new CourseCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('course_categories.create');
    }

    /**
     * Store a newly created CourseCategory in storage.
     *
     * @param CreateCourseCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseCategoryRequest $request)
    {
        $input = $request->all();

        $courseCategory = $this->courseCategoryRepository->create($input);

        Flash::success('Course Category saved successfully.');

        return redirect(route('courseCategories.index'));
    }

    /**
     * Display the specified CourseCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $courseCategory = $this->courseCategoryRepository->find($id);

        if (empty($courseCategory)) {
            Flash::error('Course Category not found');

            return redirect(route('courseCategories.index'));
        }

        return view('course_categories.show')->with('courseCategory', $courseCategory);
    }

    /**
     * Show the form for editing the specified CourseCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $courseCategory = $this->courseCategoryRepository->find($id);

        if (empty($courseCategory)) {
            Flash::error('Course Category not found');

            return redirect(route('courseCategories.index'));
        }

        return view('course_categories.edit')->with('courseCategory', $courseCategory);
    }

    /**
     * Update the specified CourseCategory in storage.
     *
     * @param int $id
     * @param UpdateCourseCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseCategoryRequest $request)
    {
        $courseCategory = $this->courseCategoryRepository->find($id);

        if (empty($courseCategory)) {
            Flash::error('Course Category not found');

            return redirect(route('courseCategories.index'));
        }

        $courseCategory = $this->courseCategoryRepository->update($request->all(), $id);

        Flash::success('Course Category updated successfully.');

        return redirect(route('courseCategories.index'));
    }

    /**
     * Remove the specified CourseCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $courseCategory = $this->courseCategoryRepository->find($id);

        if (empty($courseCategory)) {
            Flash::error('Course Category not found');

            return redirect(route('courseCategories.index'));
        }

        $this->courseCategoryRepository->delete($id);

        Flash::success('Course Category deleted successfully.');

        return redirect(route('courseCategories.index'));
    }
}
