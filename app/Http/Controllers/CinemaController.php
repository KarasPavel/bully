<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 25.05.18
 * Time: 10:31
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cinema;


class CinemaController extends Controller
{
    public function index()
    {
        $cinemas =  DB::table('cinemas')->orderBy('id', 'DESC')->paginate(10);

        foreach ($cinemas as $cinema){
            if((strpos($cinema->image, 'https://') !== false) || (strpos($cinema->image, 'http://') !== false)){
                try{
                    file_get_contents($cinema->image);
                }catch(\Exception $e){
                    $cinema->image = 'img/pics/iayjjZok.jpg';
                }
            }
        }

        if (view()->exists('admin/cinema/cinema-management')){
            return view('admin/cinema/cinema-management', compact('cinemas'));
        }
        abort(404);
    }

    public function create()
    {

        if (view()->exists('admin/cinema/create-cinema')){
            return view('admin/cinema/create-cinema');
        }
        abort(404);
    }

    public function show($id)
    {
        $cinema = Cinema::find($id);

        if (view()->exists('admin/cinema/cinema')){
            return view('admin/cinema/cinema', compact('cinema'));
        }
        abort(404);
    }

    public function store(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'title' => 'sometimes|string|max:255',
                'address' => 'sometimes|string|max:255',
                'image' => 'sometimes|image|dimensions:max_width=2048,max_height=1080',
                'lat' => 'sometimes',
                'lng' => 'sometimes',
            ]);

            $pathCinemaImage = $request->file('image')->move(public_path() . '/img/cinemaImage/', $request->image . '.jpg');


            DB::table('cinemas')->insert(
                ['name' => $request->title,'address' => $request->address, 'image' => $pathCinemaImage,
                    'lng' => $request->lng, 'lat' => $request->lat,]);


        }
        return redirect('admin/cinema-management');
    }

    public function edit($id)
    {
        $cinema = Cinema::find($id);
        if (view()->exists('admin/cinema/edit-cinema')){
            return view('admin/cinema/edit-cinema', compact('cinema'));
        }
        abort(404);

    }

    public function update(Request $request, $id)
    {

        if($request->isMethod('post')) {
            $this->validate($request, [
                'title' => 'required|string|max:255',
                'address' => 'sometimes|string|max:255',
                'image' => 'sometimes|image|dimensions:max_width=2048,max_height=1080',
                'lat' => 'sometimes',
                'lng' => 'sometimes',
            ]);

            if($request->image !== null && !empty($request->image)){
                $pathCinemaImage = $request->file('image')->move(public_path() . '/img/cinemaImage/', $request->image . '.jpg');
            }else{
                $pathCinemaImage = $request->oldImage;
            }

            DB::table('cinemas')
                ->where('id', $id)
                ->update(['name' => $request->title,'address' => $request->address, 'image' => $pathCinemaImage,
                    'lng' => $request->lng, 'lat' => $request->lat,]);
        }
        return redirect('admin/cinema-management');
    }

    public function showPlace($id)
    {
        $cinema = Cinema::find($id);
        if((strpos($cinema->image, 'https://') !== false) || (strpos($cinema->image, 'http://') !== false)){
            try{
                file_get_contents($cinema->image);
            }catch(\Exception $e){
                $cinema->image = 'img/pics/iayjjZok.jpg';
            }
        }
        return view('place', compact('cinema'));
    }
}