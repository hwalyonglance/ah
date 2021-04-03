<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateMateriRequest;
use App\Http\Requests\UpdateMateriRequest;
use App\Repositories\MateriRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Role;

class MateriController extends AppBaseController
{
    /** @var  MateriRepository */
    private $materiRepository;

    public function __construct(
        MateriRepository $materiRepo,
        RoleRepository $roleRepo)
    {
        $this->materiRepository = $materiRepo;
        $this->roleRepository = $roleRepo;
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
        $materis = $this->materiRepository->all([],['role']);

        return view('materi.index')
            ->with('materis', $materis);
    }

    /**
     * Show the form for creating a new Materi.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->roleRepository->options();
        // dd($roles);
        return view('materi.create', compact('roles'));
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

        return redirect(route('materi.index'));
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

            return redirect(route('materi.index'));
        }

        return view('materi.show')->with('materi', $materi);
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

            return redirect(route('materi.index'));
        }

        return view('materi.edit')->with('materi', $materi);
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

            return redirect(route('materi.index'));
        }

        $materi = $this->materiRepository->update($request->all(), $id);

        Flash::success('Materi updated successfully.');

        return redirect(route('materi.index'));
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

            return redirect(route('materi.index'));
        }

        $this->materiRepository->delete($id);

        Flash::success('Materi deleted successfully.');

        return redirect(route('materi.index'));
    }
}
