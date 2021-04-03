<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMateriBabAPIRequest;
use App\Http\Requests\API\UpdateMateriBabAPIRequest;
use App\Models\MateriBab;
use App\Repositories\MateriBabRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\MateriBabResource;
use Response;

/**
 * Class MateriBabController
 * @package App\Http\Controllers\API
 */

class MateriBabAPIController extends AppBaseController
{
    /** @var  MateriBabRepository */
    private $materiBabRepository;

    public function __construct(MateriBabRepository $materiBabRepo)
    {
        $this->materiBabRepository = $materiBabRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/materiBabs",
     *      summary="Get a listing of the MateriBabs.",
     *      tags={"MateriBab"},
     *      description="Get all MateriBabs",
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
     *                  @SWG\Items(ref="#/definitions/MateriBab")
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
        $materiBabs = $this->materiBabRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(MateriBabResource::collection($materiBabs), 'Materi Babs retrieved successfully');
    }

    /**
     * @param CreateMateriBabAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/materiBabs",
     *      summary="Store a newly created MateriBab in storage",
     *      tags={"MateriBab"},
     *      description="Store MateriBab",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MateriBab that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MateriBab")
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
     *                  ref="#/definitions/MateriBab"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMateriBabAPIRequest $request)
    {
        $input = $request->all();

        $materiBab = $this->materiBabRepository->create($input);

        return $this->sendResponse(new MateriBabResource($materiBab), 'Materi Bab saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/materiBabs/{id}",
     *      summary="Display the specified MateriBab",
     *      tags={"MateriBab"},
     *      description="Get MateriBab",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MateriBab",
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
     *                  ref="#/definitions/MateriBab"
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
        /** @var MateriBab $materiBab */
        $materiBab = $this->materiBabRepository->find($id);

        if (empty($materiBab)) {
            return $this->sendError('Materi Bab not found');
        }

        return $this->sendResponse(new MateriBabResource($materiBab), 'Materi Bab retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMateriBabAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/materiBabs/{id}",
     *      summary="Update the specified MateriBab in storage",
     *      tags={"MateriBab"},
     *      description="Update MateriBab",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MateriBab",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MateriBab that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MateriBab")
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
     *                  ref="#/definitions/MateriBab"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMateriBabAPIRequest $request)
    {
        $input = $request->all();

        /** @var MateriBab $materiBab */
        $materiBab = $this->materiBabRepository->find($id);

        if (empty($materiBab)) {
            return $this->sendError('Materi Bab not found');
        }

        $materiBab = $this->materiBabRepository->update($input, $id);

        return $this->sendResponse(new MateriBabResource($materiBab), 'MateriBab updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/materiBabs/{id}",
     *      summary="Remove the specified MateriBab from storage",
     *      tags={"MateriBab"},
     *      description="Delete MateriBab",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MateriBab",
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
        /** @var MateriBab $materiBab */
        $materiBab = $this->materiBabRepository->find($id);

        if (empty($materiBab)) {
            return $this->sendError('Materi Bab not found');
        }

        $materiBab->delete();

        return $this->sendSuccess('Materi Bab deleted successfully');
    }
}
