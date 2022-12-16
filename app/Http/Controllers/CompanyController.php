<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Library\QueryBuilder\QueryBuilder;
use Carbon\Carbon;
class CompanyController extends Controller
{
    public function __construct($date_format = null)
    {
        $this->date_format = $date_format;
    }
    public function index(Request $request) {
      if($request->start_date){
          $start = Carbon::parse($request->start_date)->startOfDay();
          $end = Carbon::parse($request->end_date)->endOfDay();
          $data = Company::whereBetween('created_at',[$start,$end])->get();
          return response()->json($data);
      } else {
          $company=Company::all();
          return response()->json($company);
      }
    }
    public function Filter(){
      $date_filter = Carbon::now()->startOfDay();
      $data = Company::whereDate('created_at','>=',$date_filter)->get();
      return response()->json($data);
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
