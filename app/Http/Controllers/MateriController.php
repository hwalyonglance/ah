<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMateriRequest;
use App\Http\Requests\UpdateMateriRequest;
use App\Repositories\MateriRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
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
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $materis = $this->materiRepository->all();

        return view('materis.index')
            ->with('materis', $materis);
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
     * @param int $id
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
     * @param int $id
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
     * @param int $id
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
     * @param int $id
     *
     * @throws \Exception
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
