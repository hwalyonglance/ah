<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTrainingAPIRequest;
use App\Http\Requests\API\UpdateTrainingAPIRequest;
use App\Models\Training;
use App\Repositories\TrainingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TrainingResource;
use Response;

/**
 * Class TrainingController
 * @package App\Http\Controllers\API
 */

class TrainingAPIController extends AppBaseController
{
    /** @var  TrainingRepository */
    private $trainingRepository;

    public function __construct(TrainingRepository $trainingRepo)
    {
        $this->trainingRepository = $trainingRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/training",
     *      summary="Get a listing of the Trainings.",
     *      tags={"Training"},
     *      description="Get all Trainings",
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
     *                  @SWG\Items(ref="#/definitions/Training")
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
        $training = $this->trainingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TrainingResource::collection($training), 'Trainings retrieved successfully');
    }

    /**
     * @param CreateTrainingAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/training",
     *      summary="Store a newly created Training in storage",
     *      tags={"Training"},
     *      description="Store Training",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Training that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Training")
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
     *                  ref="#/definitions/Training"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTrainingAPIRequest $request)
    {
        $input = $request->all();

        $materi = $this->trainingRepository->create($input);

        return $this->sendResponse(new TrainingResource($materi), 'Training saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/training/{id}",
     *      summary="Display the specified Training",
     *      tags={"Training"},
     *      description="Get Training",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Training",
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
     *                  ref="#/definitions/Training"
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
        /** @var Training $materi */
        $materi = $this->trainingRepository->find($id);

        if (empty($materi)) {
            return $this->sendError('Training not found');
        }

        return $this->sendResponse(new TrainingResource($materi), 'Training retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTrainingAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/training/{id}",
     *      summary="Update the specified Training in storage",
     *      tags={"Training"},
     *      description="Update Training",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Training",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Training that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Training")
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
     *                  ref="#/definitions/Training"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTrainingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Training $materi */
        $materi = $this->trainingRepository->find($id);

        if (empty($materi)) {
            return $this->sendError('Training not found');
        }

        $materi = $this->trainingRepository->update($input, $id);

        return $this->sendResponse(new TrainingResource($materi), 'Training updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/training/{id}",
     *      summary="Remove the specified Training from storage",
     *      tags={"Training"},
     *      description="Delete Training",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Training",
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
        /** @var Training $materi */
        $materi = $this->trainingRepository->find($id);

        if (empty($materi)) {
            return $this->sendError('Training not found');
        }

        $materi->delete();

        return $this->sendSuccess('Training deleted successfully');
    }
}
