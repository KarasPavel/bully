<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 19.05.18
 * Time: 10:28
 */

namespace App\Http\Controllers;


use App\Hall;
use App\Row;
use App\Sector;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {


        if (view()->exists('admin/admin')){
            return view('admin/admin');
        }
        abort(404);
    }


    public function showHall($id)
    {
        $hall = Hall::find($id);
        $sectors = Hall::amountSectors($hall->id);

        foreach ($sectors as $sector){
            $rows = Sector::amountRows($sector->id);

            foreach ($rows as $row){
                $places = Row::amountPlaces($row->id);


                dump($rows);

                $countRows = count($rows);
                $countPlaces = count($places);

                return view('admin/hall', compact('hall', 'countRows', 'countPlaces'));

            }
        }


    }

}