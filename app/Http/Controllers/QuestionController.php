<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Exam;
use App\Repositories\ExamRepository;
use App\Repositories\QuestionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use Flash;
use Response;

class QuestionController extends AppBaseController
{
    /** @var  QuestionRepository */
    private $questionRepository;

    /** @var  ExamRepository */
    private $examRepository;

    /** @var  Exam */
    private $exam;

    public function __construct(
        ExamRepository $examRepo,
        QuestionRepository $questionRepo
    )
    {
        $this->examRepository = $examRepo;
        $this->questionRepository = $questionRepo;

        $exam_id = \Route::current()->parameter('exam');
        $this->exam = $this->examRepository->model->findOrFail($exam_id);
        // dd($this->exam);
    }

    /**
     * Display a listing of the Question.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request, $exam_id)
    {
        $exam = $this->exam;
        $questions = $this->questionRepository->all(['exam_id'=>$exam_id]);

        return view('exams.questions.index', compact('questions','exam','exam_id'));
    }

    /**
     * Show the form for creating a new Question.
     *
     * @return Response
     */
    public function create($exam_id)
    {
        return view('exams.questions.create', compact('exam_id'));
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param CreateQuestionRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionRequest $request, $exam_id)
    {
        $input = $request->all();

        $question = $this->questionRepository->create($input);

        Flash::success('Question saved successfully.');

        return redirect(route('exams.questions.index', $exam_id));
    }

    /**
     * Display the specified Question.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($exam_id, $id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('exams.questions.index'));
        }
        $exam = $this->exam;
        return view('exams.questions.show', compact('exam_id', 'exam', 'question'));
    }

    /**
     * Show the form for editing the specified Question.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($exam_id, $id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('exams.questions.index'));
        }

        return view('exams.questions.edit', compact('exam_id','question'));
    }

    /**
     * Update the specified Question in storage.
     *
     * @param int $id
     * @param UpdateQuestionRequest $request
     *
     * @return Response
     */
    public function update($exam_id, $id, UpdateQuestionRequest $request)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('exams.questions.index', $exam_id));
        }

        $question = $this->questionRepository->update($request->all(), $id);

        Flash::success('Question updated successfully.');

        return redirect(route('exams.questions.index', ['exam'=>$exam_id]));
    }

    /**
     * Remove the specified Question from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }

        $this->questionRepository->delete($id);

        Flash::success('Question deleted successfully.');

        return redirect(route('questions.index'));
    }
}
