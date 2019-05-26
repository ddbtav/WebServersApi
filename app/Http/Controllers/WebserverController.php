<?php

namespace App\Http\Controllers;

use App\Webserver;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebserverController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Return the list of webservers
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $webservers = Webserver::all();
        return $this->successResponse($webservers);
    }
    /**
     * Create a webserver
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'port' => 'required|max:255',
            'userID' => 'required|max:255',
            'password' => 'required|max:255',
        ];
        $this->validate($request, $rules);
        $webserver = Webserver::create($request->all());
        return $this->successResponse($webserver, Response::HTTP_CREATED);
    }
    /**
     * Show the Webserver
     * @return Illuminate\Http\Response
     */
    public function show($webserver)
    {
        $webserver = Webserver::findOrFail($webserver);
        return $this->successResponse($webserver);
    }
    /**
     * Update an existing Webserver
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $webserver)
    {
        $rules = [
            'name' => 'max:255',
            'port' => 'max:255',
            'userID' => 'max:255',
            'password' => 'max:255',
        ];
        $this->validate($request, $rules);
        $webserver = Webserver::findOrFail($webserver);
        $webserver->fill($request->all());
        if ($webserver->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $webserver->save();
        return $this->successResponse($webserver);
    }
    /**
     * Remove an existing Webserver
     * @return Illuminate\Http\Response
     */
    public function destroy($webserver)
    {
        $webserver = Webserver::findOrFail($webserver);
        $webserver->delete();
        return $this->successResponse($webserver);
    }
}
