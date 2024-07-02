<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Example;
use Illuminate\Http\Request;
use App\Repositories\ExampleRepository;
use App\Traits\Controller\RestControllerTrait;
use App\Validators\ExampleValidator;

class ExampleController extends Controller
{
    private $repository;
    private $validator;
    private $partialUpdateFields = ['status'];

    use RestControllerTrait;

    public function __construct(ExampleRepository $repository, ExampleValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        return view('example.list', $data);
    }

    public function exampleListData(Request $request)
    {
        $data = $request->all();
        $data['search'] = $search = $request->search;
        $paginate = Helper::paginate($data);
        $data['sn'] = $paginate->serial;
        $data['perPage'] = $paginate->perPage;

        $data['examples'] = $this->repository->listData($search, $paginate);
        return view('example.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('example.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['example'] = $this->repository->show($id);
        return view('example.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['example'] = $this->repository->findById($id);
        return view('example.update', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
    }
}
