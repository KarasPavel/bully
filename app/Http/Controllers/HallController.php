<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 24.05.18
 * Time: 15:49
 */

namespace App\Http\Controllers;


use App\Cinema;
use App\Event;
use App\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HallController extends Controller
{
    public function index()
    {
        $cinemas = DB::table('cinemas')->get();
        $halls = DB::table('halls')->get();
        if (view()->exists('admin/cinema/hall-management')){
            return view('admin/cinema/hall-management', compact('cinemas','halls'));
        }
        abort(404);
    }

    public function create(Request $request)
    {
        $id = $request->cinema;

        return redirect()->route('admin/cinema-management/hall/create-hall', ['cinema' => $id]);

    }

    public function createHall()
    {
        $id = $_GET['cinema'];
        $cinema = Cinema::find($id);

        return view('admin/cinema/create-hall', compact('cinema','id'));

    }

    public function store(Request $request, $id)
    {
        if($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required|',
            ]);

            DB::table('halls')->insert(
                ['name' => $request->name, 'cinema_id' => $id]);
        }

        return redirect()->route('admin/cinema-management/hall-management');
    }
    public function goHall()
    {
        $hallId = $_GET['hall'];
        return redirect('admin/view-hall/'. $hallId);
    }

    public function getHalls(Request $request)
    {
        return $halls = DB::table('halls')->where(['cinema_id' => $request->item])->get();
    }

    public static function checkHall(Request $request)
    {
        $halls = DB::table('halls')->where(['cinema_id' => $request->item])->get();
        $startReservation = DB::table('halls')
            ->join('event_hall', 'event_hall.hall_id', '=', 'halls.id')
            ->where('event_hall.is_delete', '=', 'false')
            ->join('events', 'event_hall.event_id', '=', 'events.id')
            ->where('events.dateEnd', '>=', date('Y-m-d', strtotime($request->dateStart)))
            ->where('events.is_delete', '=', 'false')
            ->select('halls.*')
            ->get();

        $endReservation = DB::table('halls')
            ->join('event_hall', 'event_hall.hall_id', '=', 'halls.id')
            ->where('event_hall.is_delete', '=', 'false')
            ->join('events', 'event_hall.event_id', '=', 'events.id')
            ->where('events.dateStart', '<=', date('Y-m-d', strtotime($request->dateEnd)))
            ->where('events.is_delete', '=', 'false')
            ->select('halls.*')
            ->get();

        $cinema = DB::table('cinemas')->where(['id' => $request->item])->get();

        $start = [];
        $end = [];

        foreach ($endReservation as $endId){
            $end[] = $endId->id;
        }

        foreach ($startReservation as $startId){
            $start[] = $startId->id;
        }

        $reservation[] = array_intersect($start, $end);


        return [$halls, $cinema, $reservation];
    }


    public function show($id)
    {
        $hall = Hall::find($id);
        $hallId = $hall->id;
        $sectors = DB::table('sectors')->where('hall_id', $hallId)->orderBy('price', 'DESC')->get();
        $sectorsId = [];
        $places = [];
        foreach ($sectors as $sector){
            $sectorsId[] = $sector->id;
        }

        foreach ($sectorsId as $sectorId){
            $places[] = DB::table('places')->where('sector_id', $sectorId)->get();
        }
        
        $cinema = DB::table('cinemas')->where('id', $hall->cinema_id)->get();
        foreach ($cinema as $val){
            $cinema = $val;
        }
        

        if (view()->exists('admin/cinema/view-hall')){
            return view('admin/cinema/view-hall', compact('hall', 'sectors', 'places', 'cinema'));
        }
        abort(404);
    }
}
