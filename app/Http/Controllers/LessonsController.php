<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lesson;

use Illuminate\Support\Facades\Response;

use App\Sunil\Transformers\LessonTransformer;

use App\Http\Controllers\ApiController;

class LessonsController extends ApiController
{
    /**
    * @var App\Sunil\Transformers\LessonTransformer
    */
    protected $lessonTransformer;

    function __construct(LessonTransformer $lessonTransformer){
        $this->lessonTransformer = $lessonTransformer;
        $this->middleware('auth.basic', ['only' => 'post']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$lessons = Lesson::all();
        $limit = $request->get('limit') ? : 3;
        $lessons = Lesson::paginate($limit);
        //dd($lessons);
        return $this->respond([
            'data'=>$this->lessonTransformer->transformCollection($lessons->all()),
            'paginator'=>[
                'total_count'=>$lessons->total(),
                'total_pages'=>ceil($lessons->total()/$lessons->perPage()),
                'current_page'=>$lessons->currentPage(),
                'limit'=>$lessons->perPage()
            ]
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(! $request->input('title') or ! $request->input('body')){
            return $this->setStatusCode(422)->respondWithError('Parameters failed validation for a lesson.');
        }

        Lesson::create($request->all());

        return $this->respondCreated('Lesson Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        //if lesson does not exist
        if(! $lesson){
            return $this->respondNotFound('Lesson does not exist.');
            //return Response::json(['error'=>['message'=>'Lesson does not exist.']], 404);
        }

        return $this->respond([
            'data'=>$this->lessonTransformer->transform($lesson)
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
