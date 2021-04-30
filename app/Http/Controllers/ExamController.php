<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExamRequest;
use App\Http\Requests\CreateTakeExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Requests\UpdateTakeExamRequest;
use App\Repositories\ExamRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\TakeExamRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ExamController extends AppBaseController
{
    /** @var  ExamRepository */
    private $examRepository;

    /** @var  QuestionRepository */
    private $questionRepository;

    /** @var  RoleRepository */
    private $roleRepository;

    /** @var  TakeExamRepository */
    private $takeExamRepository;

    public function __construct(
        ExamRepository $examRepo,
        QuestionRepository $questionRepo,
        RoleRepository $roleRepo,
        TakeExamRepository $takeExamRepo
    ) {
        $this->examRepository = $examRepo;
        $this->questionRepository = $questionRepo;
        $this->roleRepository = $roleRepo;
        $this->takeExamRepository = $takeExamRepo;
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
        $exams = [];
        $examsTaken = [];
        $search = [];
        if (!$user->is_admin) {
            $search['role_id'] = $user->role_id;

            $examsTaken = $this->takeExamRepository
                ->model
                ->where('user_id', $user->id)
                ->with('exam')
                ->get();
            // dd(json_decode($examsTaken));
            $exams = $this->examRepository
                ->model
                ->with(
                    [
                        'role',
                        'questions.answer'
                    ]
                )
                ->whereHas(
                    'questions',
                    function ($where_question) {
                        $where_question
                            ->whereHas(
                                'options',
                                null,
                                '=',
                                4
                            )
                            ->whereHas(
                                'answer',
                            );
                    },
                    '=',
                    10
                )
                ->get();
        } else {
            $exams = $this->examRepository
                ->all(
                    $search,
                    [
                        'questions'=>function($with_questions){
                            $with_questions->select('exam_id');
                        }
                    ]
                );
        }
        // dd(json_decode($exams));

        return view(
            'exams.index',
            compact('exams', 'examsTaken')
        );
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
        $user = auth()->user();
        $questions = [];
        if (!$user->is_admin) {
            $questions = $this->questionRepository->all(
                ['exam_id'=>$id],
                ['options'],
                null,
                null,
                ['id','question']
            );
            // dd(json_decode($questions));
        }
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            Flash::error('Exam not found');

            return redirect(route('exams.index'));
        }

        return view(
            'exams.show',
            compact(
                'user',
                'exam',
                'questions',
            )
        );
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

    /**
     * Take the specified Exam.
     *
     * @param int $exam_id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function take($exam_id, CreateTakeExamRequest $request) {
        $user = auth()->user();
        // dd($exam_id);
        $takeExam = $this->takeExamRepository->create(
            [
                'user_id'   => $user->id,
                'exam_id' => $exam_id,
                'status'    => 0
            ]
        );

        // dd(json_decode($takeExam), json_decode($chapters));

        Flash::success('Exam berhasil diambil.');

        return redirect(route('exams.show',
            [
                'exam'     =>  $exam_id,
            ]
        ));
    }
}
