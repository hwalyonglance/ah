<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCourseChapterAPIRequest;
use App\Http\Requests\API\UpdateCourseChapterAPIRequest;
use App\Models\CourseChapter;
use App\Repositories\CourseChapterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CourseChapterResource;
use Response;

/**
 * Class CourseChapterController
 * @package App\Http\Controllers\API
 */

class CourseChapterAPIController extends AppBaseController
{
    /** @var  CourseChapterRepository */
    private $courseChapterRepository;

    public function __construct(CourseChapterRepository $courseChapterRepo)
    {
        $this->courseChapterRepository = $courseChapterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/courseChapters",
     *      summary="Get a listing of the CourseChapters.",
     *      tags={"CourseChapter"},
     *      description="Get all CourseChapters",
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
     *                  @SWG\Items(ref="#/definitions/CourseChapter")
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
        $courseChapters = $this->courseChapterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CourseChapterResource::collection($courseChapters), 'Course Chapters retrieved successfully');
    }

    /**
     * @param CreateCourseChapterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/courseChapters",
     *      summary="Store a newly created CourseChapter in storage",
     *      tags={"CourseChapter"},
     *      description="Store CourseChapter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CourseChapter that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CourseChapter")
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
     *                  ref="#/definitions/CourseChapter"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCourseChapterAPIRequest $request)
    {
        $input = $request->all();

        $courseChapter = $this->courseChapterRepository->create($input);

        return $this->sendResponse(new CourseChapterResource($courseChapter), 'Course Chapter saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/courseChapters/{id}",
     *      summary="Display the specified CourseChapter",
     *      tags={"CourseChapter"},
     *      description="Get CourseChapter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CourseChapter",
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
     *                  ref="#/definitions/CourseChapter"
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
        /** @var CourseChapter $courseChapter */
        $courseChapter = $this->courseChapterRepository->find($id);

        if (empty($courseChapter)) {
            return $this->sendError('Course Chapter not found');
        }

        return $this->sendResponse(new CourseChapterResource($courseChapter), 'Course Chapter retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCourseChapterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/courseChapters/{id}",
     *      summary="Update the specified CourseChapter in storage",
     *      tags={"CourseChapter"},
     *      description="Update CourseChapter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CourseChapter",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CourseChapter that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CourseChapter")
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
     *                  ref="#/definitions/CourseChapter"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCourseChapterAPIRequest $request)
    {
        $input = $request->all();

        /** @var CourseChapter $courseChapter */
        $courseChapter = $this->courseChapterRepository->find($id);

        if (empty($courseChapter)) {
            return $this->sendError('Course Chapter not found');
        }

        $courseChapter = $this->courseChapterRepository->update($input, $id);

        return $this->sendResponse(new CourseChapterResource($courseChapter), 'CourseChapter updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/courseChapters/{id}",
     *      summary="Remove the specified CourseChapter from storage",
     *      tags={"CourseChapter"},
     *      description="Delete CourseChapter",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CourseChapter",
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
        /** @var CourseChapter $courseChapter */
        $courseChapter = $this->courseChapterRepository->find($id);

        if (empty($courseChapter)) {
            return $this->sendError('Course Chapter not found');
        }

        $courseChapter->delete();

        return $this->sendSuccess('Course Chapter deleted successfully');
    }
}
