<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionOptionRequest;
use App\Http\Requests\UpdateQuestionOptionRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Repositories\ExamRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\QuestionOptionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class QuestionOptionController extends AppBaseController
{
    /** @var  QuestionRepository */
    private $questionRepository;

    /** @var  ExamRepository */
    private $examRepository;

    /** @var  QuestionOptionRepository */
    private $questionOptionRepository;

    /** @var  Exam */
    private $exam;

    public function __construct(
        ExamRepository $examRepo,
        QuestionRepository $questionRepo,
        QuestionOptionRepository $questionOptionRepo

    ) {
        $this->examRepository = $examRepo;
        $this->questionRepository = $questionRepo;
        $this->questionOptionRepository = $questionOptionRepo;

        $exam_id = (int) \Route::current()->parameter('exam');
        $question_id = (int) \Route::current()->parameter('question');

        $this->exam = $this->examRepository->model->findOrFail($exam_id);
        $this->question = $this->questionRepository->model->findOrFail($question_id);
        // dd('__construct', $exam_id, $question_id);
    }

    /**
     * Display a listing of the QuestionOption.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request, $exam_id, $question_id)
    {
        $exam = $this->exam;
        $question = $this->question;
        $questionOptions = $this->questionOptionRepository->all(['question_id'=>$question_id]);

        return view('exams.questions.options.index', compact('exam','question','questionOptions'));
    }

    /**
     * Show the form for creating a new QuestionOption.
     *
     * @return Response
     */
    public function create($exam_id, $question_id)
    {
        return view('exams.questions.options.create', compact('exam_id','question_id'));
    }

    /**
     * Store a newly created QuestionOption in storage.
     *
     * @param CreateQuestionOptionRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionOptionRequest $request, $exam_id, $question_id)
    {
        $input = $request->all();

        $questionOption = $this->questionOptionRepository->create($input);

        Flash::success('Question Option saved successfully.');

        return redirect(route('exams.questions.options.index', ['exam'=>$exam_id, 'question'=>$question_id]));
    }

    /**
     * Display the specified QuestionOption.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($exam_id, $question_id, $option_id)
    {
        $questionOption = $this->questionOptionRepository->find($option_id);

        if (empty($questionOption)) {
            Flash::error('Question Option not found');

            return redirect(route('exams.questions.options.index', ['exam'=>$exam_id, 'question'=>$question_id]));
        }

        return view('exams.questions.options.show', compact('exam_id','question_id','questionOption'));
    }

    /**
     * Show the form for editing the specified QuestionOption.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($exam_id, $question_id, $option_id)
    {
        $questionOption = $this->questionOptionRepository->find($option_id);

        if (empty($questionOption)) {
            Flash::error('Question Option not found');

            return redirect(route('exams.questions.options.index', ['exam'=>$exam_id,'question'=>$question_id]));
        }

        return view(
            'exams.questions.options.edit',
            compact(
                'exam_id',
                'question_id',
                'option_id',
                'questionOption',
            )
        );
    }

    /**
     * Update the specified QuestionOption in storage.
     *
     * @param int $id
     * @param UpdateQuestionOptionRequest $request
     *
     * @return Response
     */
    public function update($exam_id, $question_id, $id, UpdateQuestionOptionRequest $request)
    {
        $questionOption = $this->questionOptionRepository->find($id);

        if (empty($questionOption)) {
            Flash::error('Question Option not found');

            return redirect(route('exams.questions.options.index', ['exam'=>$exam_id,'question'=>$question_id]));
        }

        $questionOption = $this->questionOptionRepository->update($request->all(), $id);

        Flash::success('Question Option updated successfully.');

        return redirect(route('exams.questions.options.index', ['exam'=>$exam_id,'question'=>$question_id]));
    }

    /**
     * Remove the specified QuestionOption from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($exam_id, $question_id, $option_id)
    {
        $questionOption = $this->questionOptionRepository->find($option_id);

        if (empty($questionOption)) {
            Flash::error('Question Option not found');

            return redirect(route('exams.questions.options.index', ['exam'=>$exam_id, 'question'=>$question_id]));
        }

        $this->questionOptionRepository->delete($option_id);

        Flash::success('Question Option deleted successfully.');

        return redirect(route('exams.questions.options.index', ['exam'=>$exam_id, 'question'=>$question_id]));
    }

    public function setCorrect($exam_id, $question_id, $option_id) {
        $questionOption = $this->questionOptionRepository->find($option_id);

        if (empty($questionOption)) {
            Flash::error('Question Option not found');

            return redirect(route('questionOptions.index'));
        }

        $options = $this->questionOptionRepository
            ->all(['question_id'=>$question_id]);
        $options->each(function($option) {
            $option->status = 0;
            $option->save();
        });

        $questionOption->status = 1;
        $questionOption->save();

        return redirect(route('exams.questions.options.index', ['exam'=>$exam_id, 'question'=>$question_id]));
    }
}
