<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionOptionAPIRequest;
use App\Http\Requests\API\UpdateQuestionOptionAPIRequest;
use App\Models\QuestionOption;
use App\Repositories\QuestionOptionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\QuestionOptionResource;
use Response;

/**
 * Class QuestionOptionController
 * @package App\Http\Controllers\API
 */

class QuestionOptionAPIController extends AppBaseController
{
    /** @var  QuestionOptionRepository */
    private $questionOptionRepository;

    public function __construct(QuestionOptionRepository $questionOptionRepo)
    {
        $this->questionOptionRepository = $questionOptionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/questionOptions",
     *      summary="Get a listing of the QuestionOptions.",
     *      tags={"QuestionOption"},
     *      description="Get all QuestionOptions",
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
     *                  @SWG\Items(ref="#/definitions/QuestionOption")
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
        $questionOptions = $this->questionOptionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(QuestionOptionResource::collection($questionOptions), 'Question Options retrieved successfully');
    }

    /**
     * @param CreateQuestionOptionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/questionOptions",
     *      summary="Store a newly created QuestionOption in storage",
     *      tags={"QuestionOption"},
     *      description="Store QuestionOption",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="QuestionOption that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/QuestionOption")
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
     *                  ref="#/definitions/QuestionOption"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateQuestionOptionAPIRequest $request)
    {
        $input = $request->all();

        $questionOption = $this->questionOptionRepository->create($input);

        return $this->sendResponse(new QuestionOptionResource($questionOption), 'Question Option saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/questionOptions/{id}",
     *      summary="Display the specified QuestionOption",
     *      tags={"QuestionOption"},
     *      description="Get QuestionOption",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of QuestionOption",
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
     *                  ref="#/definitions/QuestionOption"
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
        /** @var QuestionOption $questionOption */
        $questionOption = $this->questionOptionRepository->find($id);

        if (empty($questionOption)) {
            return $this->sendError('Question Option not found');
        }

        return $this->sendResponse(new QuestionOptionResource($questionOption), 'Question Option retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateQuestionOptionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/questionOptions/{id}",
     *      summary="Update the specified QuestionOption in storage",
     *      tags={"QuestionOption"},
     *      description="Update QuestionOption",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of QuestionOption",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="QuestionOption that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/QuestionOption")
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
     *                  ref="#/definitions/QuestionOption"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateQuestionOptionAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuestionOption $questionOption */
        $questionOption = $this->questionOptionRepository->find($id);

        if (empty($questionOption)) {
            return $this->sendError('Question Option not found');
        }

        $questionOption = $this->questionOptionRepository->update($input, $id);

        return $this->sendResponse(new QuestionOptionResource($questionOption), 'QuestionOption updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/questionOptions/{id}",
     *      summary="Remove the specified QuestionOption from storage",
     *      tags={"QuestionOption"},
     *      description="Delete QuestionOption",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of QuestionOption",
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
        /** @var QuestionOption $questionOption */
        $questionOption = $this->questionOptionRepository->find($id);

        if (empty($questionOption)) {
            return $this->sendError('Question Option not found');
        }

        $questionOption->delete();

        return $this->sendSuccess('Question Option deleted successfully');
    }
}
