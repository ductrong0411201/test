<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Controllers\Controller;
class CompanyController extends Controller
{
    public function index() {
        $index = Company::all();
        return response()->json($index);
    }
    public function Filter(){
        $company = Company::where('id', '>' , 5)->orderBy('id')->get();
        return response()->json($company);
        // $company = Company::all();
        // $filter = $company->filter(function ($value) {
        //     return data_get($value, 'id') > 3 ;
        // });
        // $filter = $filter->all();
        // return response()->json($filter);
    }
    public function store(Request $request)
    {
      $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required',
      ]);
      $newCompany = new Company([
        'name' => $request->get('name'),
        'address' => $request->get('address'),
      ]);

      $newCompany->save();

      return response()->json($newCompany);
    }
    public function show($id)
    {
    $show = Company::findOrFail($id);
    return response()->json($show);
    }
    public function update(Request $request, $id)
    {
      $update = Company::findOrFail($id);
        $request->validate([
        'name' => 'required|max:255',
        'address' => 'required',
        ]);
        $update->name = $request->get('name');
        $update->address = $request->get('address');
        $update->save();
    return response()->json($update);
  }
  public function destroy($id)
  {
    $destroy = Company::findOrFail($id);
    $destroy->delete();
    return response()->json($destroy::all());
  }

}
