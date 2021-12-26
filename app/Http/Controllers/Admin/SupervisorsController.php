<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SupervisorUpdateRequest;
use App\Http\Requests\Admin\SupervisorSaveRequest;
use App\Models\Supervisor;
use Storage;

class SupervisorsController extends Controller
{
    /*
    |
    |   this method will show list of supervisors
    |
    */
    public function index(){
        $supervisors = Supervisor::get();
        return view('dashboard.supervisors.index',compact('supervisors'));
    }
    /*
    |
    |   this method will show supervisor by id
    |
    */
    public function view(Supervisor $supervisor){
        return view('dashboard.supervisors.view',compact('supervisor'));

    }
    /*
    |
    |   this method will show new supervisor form
    |
    */
    public function add(){
        return view('dashboard.supervisors.add');
    }
    /*
    |
    |   this method will update supervisor by id
    |
    */
    public function save(SupervisorSaveRequest $request){
        $dataToSave = ['username','phone','email','status'];
        if($request->has('status')){
            $request['status'] = 'ON';
        }else{
            $request['status'] = 'BLOCKED';
        }
        if($request->has('password') && !empty($request->input('password'))){
            $dataToSave[] = 'password';
        }
        if($request->hasFile('avatar_file')){
            $file = $request->file('avatar_file');
            $filename = 'supervisors/'.\Str::uuid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($filename, \File::get($file));
            $request['avatar'] = $filename;
            $dataToSave[] = 'avatar';
        }
        Supervisor::create($request->only($dataToSave));
        return redirect()->back()->withSuccess('Supervisor created Successfully ...');
    }
    /*
    |
    |   this method will update supervisor by id
    |
    */
    public function update(SupervisorUpdateRequest $request,Supervisor $supervisor){
        $dataToUpdate = ['username','phone','email','status'];
        if($request->has('status')){
            $request['status'] = 'ON';
        }else{
            $request['status'] = 'BLOCKED';
        }
        if($request->has('password') && !empty($request->input('password'))){
            $dataToUpdate[] = 'password';
        }
        if($request->hasFile('avatar_file')){
            $file = $request->file('avatar_file');
            if($supervisor->avatar != 'placeholder.jpg'){
                Storage::disk('public')->delete($supervisor->avatar);
            }
            $filename = 'supervisors/'.\Str::uuid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($filename, \File::get($file));
            $request['avatar'] = $filename;
            $dataToUpdate[] = 'avatar';
        }
        $supervisor->update($request->only($dataToUpdate));
        return redirect()->back()->withSuccess('Supervisor updated Successfully ...');
    }
    /*
    |
    |   this method will soft delete array of supervisors 
    |
    */
    public function destroy(Request $request){
        Supervisor::whereIn('id',explode(',',$request->input('ids')))->delete();
        return redirect()->back()->withSuccess('Supervisors deleted Successfully ...');
    }
}
