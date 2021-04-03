<?php

namespace App\Http\Controllers;

use App\DataTables\MateriDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMateriRequest;
use App\Http\Requests\UpdateMateriRequest;
use App\Repositories\MateriRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MateriController extends AppBaseController
{
    /** @var  MateriRepository */
    private $materiRepository;

    public function __construct(MateriRepository $materiRepo)
    {
        $this->materiRepository = $materiRepo;
    }

    /**
     * Display a listing of the Materi.
     *
     * @param MateriDataTable $materiDataTable
     * @return Response
     */
    public function index(MateriDataTable $materiDataTable)
    {
        return $materiDataTable->render('materis.index');
    }

    /**
     * Show the form for creating a new Materi.
     *
     * @return Response
     */
    public function create()
    {
        return view('materis.create');
    }

    /**
     * Store a newly created Materi in storage.
     *
     * @param CreateMateriRequest $request
     *
     * @return Response
     */
    public function store(CreateMateriRequest $request)
    {
        $input = $request->all();

        $materi = $this->materiRepository->create($input);

        Flash::success('Materi saved successfully.');

        return redirect(route('materis.index'));
    }

    /**
     * Display the specified Materi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $materi = $this->materiRepository->find($id);

        if (empty($materi)) {
            Flash::error('Materi not found');

            return redirect(route('materis.index'));
        }

        return view('materis.show')->with('materi', $materi);
    }

    /**
     * Show the form for editing the specified Materi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $materi = $this->materiRepository->find($id);

        if (empty($materi)) {
            Flash::error('Materi not found');

            return redirect(route('materis.index'));
        }

        return view('materis.edit')->with('materi', $materi);
    }

    /**
     * Update the specified Materi in storage.
     *
     * @param  int              $id
     * @param UpdateMateriRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMateriRequest $request)
    {
        $materi = $this->materiRepository->find($id);

        if (empty($materi)) {
            Flash::error('Materi not found');

            return redirect(route('materis.index'));
        }

        $materi = $this->materiRepository->update($request->all(), $id);

        Flash::success('Materi updated successfully.');

        return redirect(route('materis.index'));
    }

    /**
     * Remove the specified Materi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $materi = $this->materiRepository->find($id);

        if (empty($materi)) {
            Flash::error('Materi not found');

            return redirect(route('materis.index'));
        }

        $this->materiRepository->delete($id);

        Flash::success('Materi deleted successfully.');

        return redirect(route('materis.index'));
    }
}
