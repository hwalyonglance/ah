<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMateriBabRequest;
use App\Http\Requests\UpdateMateriBabRequest;
use App\Repositories\MateriBabRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MateriBabController extends AppBaseController
{
    /** @var  MateriBabRepository */
    private $materiBabRepository;

    public function __construct(MateriBabRepository $materiBabRepo)
    {
        $this->materiBabRepository = $materiBabRepo;
    }

    /**
     * Display a listing of the MateriBab.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $materiBabs = $this->materiBabRepository->all();

        return view('materi_babs.index')
            ->with('materiBabs', $materiBabs);
    }

    /**
     * Show the form for creating a new MateriBab.
     *
     * @return Response
     */
    public function create()
    {
        return view('materi_babs.create');
    }

    /**
     * Store a newly created MateriBab in storage.
     *
     * @param CreateMateriBabRequest $request
     *
     * @return Response
     */
    public function store(CreateMateriBabRequest $request)
    {
        $input = $request->all();

        $materiBab = $this->materiBabRepository->create($input);

        Flash::success('Materi Bab saved successfully.');

        return redirect(route('materiBabs.index'));
    }

    /**
     * Display the specified MateriBab.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $materiBab = $this->materiBabRepository->find($id);

        if (empty($materiBab)) {
            Flash::error('Materi Bab not found');

            return redirect(route('materiBabs.index'));
        }

        return view('materi_babs.show')->with('materiBab', $materiBab);
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

        return view('materi_babs.edit')->with('materiBab', $materiBab);
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
