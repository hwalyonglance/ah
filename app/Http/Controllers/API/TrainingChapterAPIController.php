<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTrainingChapterAPIRequest;
use App\Http\Requests\API\UpdateTrainingChapterAPIRequest;
use App\Models\TrainingChapter;
use App\Repositories\TrainingChapterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TrainingChapterResource;
use Response;

/**
 * Class TrainingChapterController
 * @package App\Http\Controllers\API
 */

class TrainingChapterAPIController extends AppBaseController
{
    /** @var  TrainingChapterRepository */
    private $trainingChapterRepository;

    public function __construct(TrainingChapterRepository $trainingChapterRepo)
    {
        $this->trainingChapterRepository = $trainingChapterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/trainingChapters",
     *      summary="Get a listing of the TrainingChapters.",
     *      tags={"TrainingChapter"},
     *      description="Get all TrainingChapters",
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
     *                  @SWG\Items(ref="#/definitions/TrainingChapter")
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
        $trainingChapters = $this->trainingChapterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TrainingChapterResource::collection($trainingChapters), 'Training Chapters retrieved successfully');
    }

    /**
     * @param CreateTrainingChapterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/trainingChapters",
     *      summary="Store a newly created TrainingChapter in storage",
     *      tags={"TrainingChapter"},
     *      description="Store TrainingChapter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TrainingChapter that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TrainingChapter")
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
     *                  ref="#/definitions/TrainingChapter"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTrainingChapterAPIRequest $request)
    {
        $input = $request->all();

        $trainingChapter = $this->trainingChapterRepository->create($input);

        return $this->sendResponse(new TrainingChapterResource($trainingChapter), 'Training Chapter saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/trainingChapters/{id}",
     *      summary="Display the specified TrainingChapter",
     *      tags={"TrainingChapter"},
     *      description="Get TrainingChapter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TrainingChapter",
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
     *                  ref="#/definitions/TrainingChapter"
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
        /** @var TrainingChapter $trainingChapter */
        $trainingChapter = $this->trainingChapterRepository->find($id);

        if (empty($trainingChapter)) {
            return $this->sendError('Training Chapter not found');
        }

        return $this->sendResponse(new TrainingChapterResource($trainingChapter), 'Training Chapter retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTrainingChapterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/trainingChapters/{id}",
     *      summary="Update the specified TrainingChapter in storage",
     *      tags={"TrainingChapter"},
     *      description="Update TrainingChapter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TrainingChapter",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TrainingChapter that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TrainingChapter")
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
     *                  ref="#/definitions/TrainingChapter"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTrainingChapterAPIRequest $request)
    {
        $input = $request->all();

        /** @var TrainingChapter $trainingChapter */
        $trainingChapter = $this->trainingChapterRepository->find($id);

        if (empty($trainingChapter)) {
            return $this->sendError('Training Chapter not found');
        }

        $trainingChapter = $this->trainingChapterRepository->update($input, $id);

        return $this->sendResponse(new TrainingChapterResource($trainingChapter), 'TrainingChapter updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/trainingChapters/{id}",
     *      summary="Remove the specified TrainingChapter from storage",
     *      tags={"TrainingChapter"},
     *      description="Delete TrainingChapter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TrainingChapter",
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
        /** @var TrainingChapter $trainingChapter */
        $trainingChapter = $this->trainingChapterRepository->find($id);

        if (empty($trainingChapter)) {
            return $this->sendError('Training Chapter not found');
        }

        $trainingChapter->delete();

        return $this->sendSuccess('Training Chapter deleted successfully');
    }
}
