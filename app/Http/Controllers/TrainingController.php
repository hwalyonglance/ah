<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateTrainingRequest;
use App\Http\Requests\UpdateTrainingRequest;
use App\Repositories\TrainingRepository;
use App\Repositories\TrainingChapterRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Role;

class TrainingController extends AppBaseController
{
    /** @var  TrainingRepository */
    private $trainingRepository;

    /** @var  TrainingChapterRepository */
    private $trainingChapterRepository;

    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(
        TrainingRepository $trainingRepo,
        TrainingChapterRepository $trainingChapterRepo,
        RoleRepository $roleRepo)
    {
        $this->trainingRepository = $trainingRepo;
        $this->trainingChapterRepository = $trainingChapterRepo;
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Training.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $trainings = $this->trainingRepository->all([],['role']);

        return view('training.index')
            ->with('trainings', $trainings);
    }

    /**
     * Show the form for creating a new Training.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->roleRepository->options();
        // dd($roles);
        return view('training.create', compact('roles'));
    }

    /**
     * Store a newly created Training in storage.
     *
     * @param CreateTrainingRequest $request
     *
     * @return Response
     */
    public function store(CreateTrainingRequest $request)
    {
        $input = $request->all();

        $gambar = $request->file('gambar');
        $input['gambar'] = $gambar->store('uploads/training', 'public');
        // return redirect(url($input['gambar']));

        $training = $this->trainingRepository->create($input);

        Flash::success('Training saved successfully.');

        return redirect(route('training.index'));
    }

    /**
     * Display the specified Training.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $training = $this->trainingRepository->find($id);

        if (empty($training)) {
            Flash::error('Training not found');

            return redirect(route('training.index'));
        }

        return view('training.show')->with('training', $training);
    }

    /**
     * Show the form for editing the specified Training.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $training = $this->trainingRepository->find($id);

        if (empty($training)) {
            Flash::error('Training not found');

            return redirect(route('training.index'));
        }

        $roles = $this->roleRepository->options();

        return view('training.edit', compact('training', 'roles'));
    }

    /**
     * Update the specified Training in storage.
     *
     * @param int $id
     * @param UpdateTrainingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTrainingRequest $request)
    {
        $training = $this->trainingRepository->find($id);

        if (empty($training)) {
            Flash::error('Training not found');

            return redirect(route('training.index'));
        }

        $input = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $prev_gambar_path = storage_path('app/public/'.$training->gambar);
            // dd($prev_gambar_path);
            unlink($prev_gambar_path);
            $input['gambar'] = $gambar->store('uploads/training', 'public');
        }

        $training = $this->trainingRepository->update($input, $id);

        Flash::success('Training updated successfully.');

        return redirect(route('training.index'));
    }

    /**
     * Remove the specified Training from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $training = $this->trainingRepository->find($id);

        if (empty($training)) {
            Flash::error('Training not found');

            return redirect(route('training.index'));
        }

        $this->trainingRepository->delete($id);

        Flash::success('Training deleted successfully.');

        return redirect(route('training.index'));
    }
}
