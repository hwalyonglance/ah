<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExamAPIRequest;
use App\Http\Requests\API\UpdateExamAPIRequest;
use App\Models\Exam;
use App\Repositories\ExamRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ExamResource;
use Response;

/**
 * Class ExamController
 * @package App\Http\Controllers\API
 */

class ExamAPIController extends AppBaseController
{
    /** @var  ExamRepository */
    private $examRepository;

    public function __construct(ExamRepository $examRepo)
    {
        $this->examRepository = $examRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/exams",
     *      summary="Get a listing of the Exams.",
     *      tags={"Exam"},
     *      description="Get all Exams",
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
     *                  @SWG\Items(ref="#/definitions/Exam")
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
        $exams = $this->examRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ExamResource::collection($exams), 'Exams retrieved successfully');
    }

    /**
     * @param CreateExamAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/exams",
     *      summary="Store a newly created Exam in storage",
     *      tags={"Exam"},
     *      description="Store Exam",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Exam that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exam")
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
     *                  ref="#/definitions/Exam"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateExamAPIRequest $request)
    {
        $input = $request->all();

        $exam = $this->examRepository->create($input);

        return $this->sendResponse(new ExamResource($exam), 'Exam saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/exams/{id}",
     *      summary="Display the specified Exam",
     *      tags={"Exam"},
     *      description="Get Exam",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Exam",
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
     *                  ref="#/definitions/Exam"
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
        /** @var Exam $exam */
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            return $this->sendError('Exam not found');
        }

        return $this->sendResponse(new ExamResource($exam), 'Exam retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateExamAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/exams/{id}",
     *      summary="Update the specified Exam in storage",
     *      tags={"Exam"},
     *      description="Update Exam",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Exam",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Exam that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exam")
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
     *                  ref="#/definitions/Exam"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateExamAPIRequest $request)
    {
        $input = $request->all();

        /** @var Exam $exam */
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            return $this->sendError('Exam not found');
        }

        $exam = $this->examRepository->update($input, $id);

        return $this->sendResponse(new ExamResource($exam), 'Exam updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/exams/{id}",
     *      summary="Remove the specified Exam from storage",
     *      tags={"Exam"},
     *      description="Delete Exam",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Exam",
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
        /** @var Exam $exam */
        $exam = $this->examRepository->find($id);

        if (empty($exam)) {
            return $this->sendError('Exam not found');
        }

        $exam->delete();

        return $this->sendSuccess('Exam deleted successfully');
    }
}
