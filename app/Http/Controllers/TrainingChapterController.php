<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateTrainingChapterRequest;
use App\Http\Requests\UpdateTrainingChapterRequest;
use App\Models\Training;
use App\Repositories\TrainingRepository;
use App\Repositories\TrainingChapterRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class TrainingChapterController extends AppBaseController
{
    /** @var  Training */
    public $training;

    /** @var  TrainingRepository */
    private $trainingRepository;

    /** @var  TrainingChapterRepository */
    private $trainingChapterRepository;

    public function __construct(
        TrainingRepository $trainingRepository,
        TrainingChapterRepository $trainingChapterRepository
    ) {
        $this->trainingRepository = $trainingRepository;
        $this->trainingChapterRepository = $trainingChapterRepository;
        $training_id = \Route::current()->parameter('training');
        $this->training = $this->trainingRepository->model->findOrFail($training_id);
    }

    /**
     * Display a listing of the TrainingChapter.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request, $training_id)
    {
        $user = auth()->user();
        $trainingChapters = $this->trainingChapterRepository->all(['training_id'=>$training_id]);

        if (!$user->is_admin) {
            $firstChapter = $trainingChapters->first();
            return redirect(route('training.chapter.show',
                [
                    'training'  =>  $training_id,
                    'chapter'   =>  $firstChapter->id
                ]
            ));
        }

        $training = $this->training;

        return view(
            'training.chapter.index',
            compact('trainingChapters','training', 'training_id')
        );
    }

    /**
     * Show the form for creating a new TrainingChapter.
     *
     * @return Response
     */
    public function create($training_id)
    {
        return view('training.chapter.create', compact('training_id'));
    }

    /**
     * Store a newly created TrainingChapter in storage.
     *
     * @param CreateTrainingChapterRequest $request
     *
     * @return Response
     */
    public function store(CreateTrainingChapterRequest $request, $training_id)
    {
        $input = $request->all();

        $trainingChapter = $this->trainingChapterRepository->create($input);

        Flash::success('Training Chapter saved successfully.');

        return redirect(route('training.chapter.index', $training_id));
    }

    /**
     * Display the specified TrainingChapter.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($training_id, $id)
    {
        $user = auth()->user();
        $trainingChapter = $this->trainingChapterRepository->find($id);

        if (empty($trainingChapter)) {
            Flash::error('Training Chapter not found');

            return redirect(route('training.chapter.index',$training_id));
        }

        $training = $this->training;

        $chapters = [];

        if (!$user->is_admin) {
            $chapters = $this->trainingChapterRepository->all(['training_id'=>$training_id]);
        }

        return view(
            'training.chapter.show',
            compact(
                'user',
                'trainingChapter',
                'training',
                'training_id',
                'chapters'
            )
        );
    }

    /**
     * Show the form for editing the specified TrainingChapter.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($training_id, $id)
    {
        $trainingChapter = $this->trainingChapterRepository->find($id);

        if (empty($trainingChapter)) {
            Flash::error('Training Chapter not found');

            return redirect(route('training.chapter.index'));
        }

        return view('training.chapter.edit', compact('trainingChapter', 'training_id'));
    }

    /**
     * Update the specified TrainingChapter in storage.
     *
     * @param int $id
     * @param UpdateTrainingChapterRequest $request
     *
     * @return Response
     */
    public function update(UpdateTrainingChapterRequest $request, $training_id, $id)
    {
        $trainingChapter = $this->trainingChapterRepository->find($id);

        if (empty($trainingChapter)) {
            Flash::error('Training Chapter not found');

            return redirect(route('training.chapter.index', $training_id));
        }

        $trainingChapter = $this->trainingChapterRepository->update($request->all(), $id);

        Flash::success('Training Chapter updated successfully.');

        return redirect(route('training.chapter.index', $training_id));
    }

    /**
     * Remove the specified TrainingChapter from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($training_id, $id)
    {
        $trainingChapter = $this->trainingChapterRepository->find($id);

        if (empty($trainingChapter)) {
            Flash::error('Training Chapter not found');

            return redirect(route('training.chapter.index', $training_id));
        }

        $this->trainingChapterRepository->delete($id);

        Flash::success('Training Chapter deleted successfully.');

        return redirect(route('training.chapter.index', $training_id));
    }
}
