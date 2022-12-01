<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index() {
        $index = Department::all();
        return response()->json($index);
    }
    public function store(Request $request)
    {
      $request->validate([
        'name' => 'required|max:255',
        'company_id' => 'required',
      ]);
      $newDepartment = new Department([
        'name' => $request->get('name'),
        'company_id' => $request->get('company_id'),
      ]);

      $newDepartment->save();

      return response()->json($newDepartment);
    }
    public function show($id)
    {
    $show = Department::findOrFail($id);
    return response()->json($show);
    }
    public function update(Request $request, $id)
    {
      $update = Department::findOrFail($id);
        $request->validate([
        'name' => 'required|max:255',
        'company_id' => 'required',
        ]);
        $update->name = $request->get('name');
        $update->company_id = $request->get('company_id');
        $update->save();
        return response()->json($update);
    }
    public function destroy($id)
    {
        $destroy = Department::findOrFail($id);
        $destroy->delete();
        return response()->json($destroy::all());
    }
}
