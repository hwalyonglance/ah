<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMateriAPIRequest;
use App\Http\Requests\API\UpdateMateriAPIRequest;
use App\Models\Materi;
use App\Repositories\MateriRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\MateriResource;
use Response;

/**
 * Class MateriController
 * @package App\Http\Controllers\API
 */

class MateriAPIController extends AppBaseController
{
    /** @var  MateriRepository */
    private $materiRepository;

    public function __construct(MateriRepository $materiRepo)
    {
        $this->materiRepository = $materiRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/materis",
     *      summary="Get a listing of the Materis.",
     *      tags={"Materi"},
     *      description="Get all Materis",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Materi")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $materis = $this->materiRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(MateriResource::collection($materis), 'Materis retrieved successfully');
    }

    /**
     * @param CreateMateriAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/materis",
     *      summary="Store a newly created Materi in storage",
     *      tags={"Materi"},
     *      description="Store Materi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Materi that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Materi")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Materi"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMateriAPIRequest $request)
    {
        $input = $request->all();

        $materi = $this->materiRepository->create($input);

        return $this->sendResponse(new MateriResource($materi), 'Materi saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/materis/{id}",
     *      summary="Display the specified Materi",
     *      tags={"Materi"},
     *      description="Get Materi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Materi",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Materi"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Materi $materi */
        $materi = $this->materiRepository->find($id);

        if (empty($materi)) {
            return $this->sendError('Materi not found');
        }

        return $this->sendResponse(new MateriResource($materi), 'Materi retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMateriAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/materis/{id}",
     *      summary="Update the specified Materi in storage",
     *      tags={"Materi"},
     *      description="Update Materi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Materi",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Materi that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Materi")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Materi"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMateriAPIRequest $request)
    {
        $input = $request->all();

        /** @var Materi $materi */
        $materi = $this->materiRepository->find($id);

        if (empty($materi)) {
            return $this->sendError('Materi not found');
        }

        $materi = $this->materiRepository->update($input, $id);

        return $this->sendResponse(new MateriResource($materi), 'Materi updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/materis/{id}",
     *      summary="Remove the specified Materi from storage",
     *      tags={"Materi"},
     *      description="Delete Materi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Materi",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Materi $materi */
        $materi = $this->materiRepository->find($id);

        if (empty($materi)) {
            return $this->sendError('Materi not found');
        }

        $materi->delete();

        return $this->sendSuccess('Materi deleted successfully');
    }
}
