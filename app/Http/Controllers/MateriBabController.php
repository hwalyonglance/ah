<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMateriBabRequest;
use App\Http\Requests\UpdateMateriBabRequest;
use App\Models\Materi;
use App\Repositories\MateriRepository;
use App\Repositories\MateriBabRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MateriBabController extends AppBaseController
{
    /** @var  Materi */
    public $materi;

    /** @var  MateriRepository */
    private $materiRepository;

    /** @var  MateriBabRepository */
    private $materiBabRepository;

    public function __construct(
        MateriRepository $materiRepository,
        MateriBabRepository $materiBabRepository
    )
    {
        $this->materiRepository = $materiRepository;
        $this->materiBabRepository = $materiBabRepository;
        $materi_id = \Route::current()->parameter('materi');
        $this->materi = $this->materiRepository->model->findOrFail($materi_id);
    }

    /**
     * Display a listing of the MateriBab.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request, $materi_id)
    {
        // dd($materi_id);
        $materiBabs = $this->materiBabRepository->all(['materi_id'=>$materi_id]);

        $materi = $this->materi;

        return view('materi.bab.index', compact('materiBabs','materi', 'materi_id'));
    }

    /**
     * Show the form for creating a new MateriBab.
     *
     * @return Response
     */
    public function create($materi_id)
    {
        $materis = $this->materiRepository->options('judul');

        $materi = $this->materi;
        // dd($materi);

        return view('materi.bab.create', compact('materi_id', 'materi','materis'));
    }

    /**
     * Store a newly created MateriBab in storage.
     *
     * @param CreateMateriBabRequest $request
     *
     * @return Response
     */
    public function store(CreateMateriBabRequest $request, $materi_id)
    {
        $input = $request->all();

        $materiBab = $this->materiBabRepository->create($input);

        Flash::success('Materi Bab saved successfully.');

        return redirect(route('materi.bab.index', $materi_id));
    }

    /**
     * Display the specified MateriBab.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($materi_id, $id)
    {
        $materiBab = $this->materiBabRepository->find($id);

        if (empty($materiBab)) {
            Flash::error('Materi Bab not found');

            return redirect(route('materi.bab.index',$materi_id));
        }

        $materi = $this->materi;

        return view('materi.bab.show', compact('materiBab', 'materi','materi_id'));
    }

    /**
     * Show the form for editing the specified MateriBab.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $materiBab = $this->materiBabRepository->find($id);

        if (empty($materiBab)) {
            Flash::error('Materi Bab not found');

            return redirect(route('materiBabs.index'));
        }

        return view('materi.bab.edit')->with('materiBab', $materiBab);
    }

    /**
     * Update the specified MateriBab in storage.
     *
     * @param int $id
     * @param UpdateMateriBabRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMateriBabRequest $request)
    {
        $materiBab = $this->materiBabRepository->find($id);

        if (empty($materiBab)) {
            Flash::error('Materi Bab not found');

            return redirect(route('materiBabs.index'));
        }

        $materiBab = $this->materiBabRepository->update($request->all(), $id);

        Flash::success('Materi Bab updated successfully.');

        return redirect(route('materiBabs.index'));
    }

    /**
     * Remove the specified MateriBab from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $materiBab = $this->materiBabRepository->find($id);

        if (empty($materiBab)) {
            Flash::error('Materi Bab not found');

            return redirect(route('materiBabs.index'));
        }

        $this->materiBabRepository->delete($id);

        Flash::success('Materi Bab deleted successfully.');

        return redirect(route('materiBabs.index'));
    }
}
