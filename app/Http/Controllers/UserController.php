<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $akuns = $this->userRepository->all();

        return view('akuns.index')
            ->with('akuns', $akuns);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('akuns.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $akun = $this->userRepository->create($input);

        Flash::success('User saved successfully.');

        return redirect(route('akuns.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $akun = $this->userRepository->find($id);

        if (empty($akun)) {
            Flash::error('User not found');

            return redirect(route('akuns.index'));
        }

        return view('akuns.show')->with('akun', $akun);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $akun = $this->userRepository->find($id);

        if (empty($akun)) {
            Flash::error('User not found');

            return redirect(route('akuns.index'));
        }

        return view('akuns.edit')->with('akun', $akun);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $akun = $this->userRepository->find($id);

        if (empty($akun)) {
            Flash::error('User not found');

            return redirect(route('akuns.index'));
        }

        $akun = $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('akuns.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $akun = $this->userRepository->find($id);

        if (empty($akun)) {
            Flash::error('User not found');

            return redirect(route('akuns.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }
}
