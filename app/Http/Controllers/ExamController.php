<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Repositories\ExamRepository;
use App\Repositories\RoleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ExamController extends AppBaseController
{
    /** @var  ExamRepository */
    private $examRepository;

    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(
        ExamRepository $examRepo,
        RoleRepository $roleRepo
    )
    {
        $this->examRepository = $examRepo;
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Exam.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = [];
        if (!$user->is_admin) {
            $search['role_id'] = $user->role_id;
        }
        $exams = $this->examRepository->all($search, ['role']);

        return view('exams.index')
            ->with('exams', $exams);
    }

    /**
     * Show the form for creating a new Exam.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->roleRepository->options('nama');
        unset($roles[1]);
        return view('exams.create', compact('roles'));
    }

    /**
     * Store a newly created Exam in storage.
     *
     * @param CreateExamRequest $request
     *
     * @return Response
     */
    public function store(CreateExamRequest $request)
    {
        $input = $request->all();

        $gambar = $request->file('image_url');
        $input['image_url'] = $gambar->store('uploads/exam', 'public');
        // return redirect(url($input['image_url']));

        $exam = $this->examRepository->create($input);

        Flash::success('Exam saved successfully.');

        return redirect(route('exams.index'));
    }

    /**
     * Display the specified Exam.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }

        return view('exams.show')->with('exam', $exam);
    }

    /**
     * Show the form for editing the specified Exam.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }
        $roles = $this->roleRepository->options('nama');
        unset($roles[1]);

        return view('exams.edit', compact('exam', 'roles'));
    }

    /**
     * Update the specified Exam in storage.
     *
     * @param int $id
     * @param UpdateExamRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamRequest $request)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }

        $input = $request->all();

        if ($request->hasFile('image_url')) {
            $image_url = $request->file('image_url');
            $prev_gambar_path = storage_path('app/public/'.$exam->image_url);
            // dd($prev_gambar_path);
            @unlink($prev_gambar_path);
            $input['image_url'] = $image_url->store('uploads/exam', 'public');
        }

        $exam = $this->examRepository->update($input, $id);

        Flash::success('Exam updated successfully.');

        return redirect(route('exams.index'));
    }

    /**
     * Remove the specified Exam from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }

        $this->examRepository->delete($id);

        Flash::success('Exam deleted successfully.');

        return redirect(route('exams.index'));
    }
}
