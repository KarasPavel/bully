<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 24.05.18
 * Time: 18:46
 */

namespace App\Http\Controllers;


use App\Cinema;
use App\Hall;
use App\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SectorController extends Controller
{
    public function index(Request $request)
    {
        $cinemas = DB::table('cinemas')->get();

        if (view()->exists('admin/cinema/sector')){
            return view('admin/cinema/sector', compact('cinemas', 'halls'));
        }
        abort(404);
    }



    public function create()
    {
        $hallId = $_GET['hall'];
        $hall = Hall::find($hallId);
        return view('admin/cinema/create-sector', compact('hall'));
    }

    public function getSector(Request $request)
    {
        return Sector::find($request->sectorId);
    }

    public function store(Request $request)
    {
        if($request->isMethod('post')) {

            $price = $request->price * 100;

            DB::table('sectors')->insert([
                'name' => $request->name, 'color' => $request->color,
                'price' => $price, 'hall_id' => $request->hallId,
                'rows' => $request->row, 'cols' => $request->column,
            ]);

            $sectorId = DB::getPdo()->lastInsertId();

            foreach ($request->placeData as $place) {

                DB::table('places')->insert([
                    'name' => $place, 'sector_id' => $sectorId,
                ]);

            }
        }

        return response('true', 200);
    }

    public function selectSector(Request $request)
    {
        return DB::table('sectors')->where('hall_id', $request->hallId)->get();
    }
}