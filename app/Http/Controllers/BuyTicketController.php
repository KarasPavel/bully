<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 08.05.18
 * Time: 13:37
 */

namespace App\Http\Controllers;

use App\Event;
use App\Order;
use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Sujip\Guid\Facades\Guid;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

class BuyTicketController extends Controller
{
    public function index()
    {
        if (view()->exists('buy-ticket')){
            return view('buy-ticket');
        }
        abort(404);
    }

    public function getTicket()
    {
        \Session::forget('tickets');
        $orderNumber = $_GET['orderNumber'];
        $orders = Order::where('guid', $orderNumber)->get();
        $orderId = 0;
        foreach($orders as $order){
            $orderId = $order->id;
        }

        $allTickets = DB::table('tickets')->where('order_id', $orderId)->get();

        $responce = array();
        $eventId = 0;

        foreach ($allTickets as $ticket){
            $ticketDescription = array();
            $eventId = $ticket->event_id;
            $barcode = new BarcodeGenerator();
            $barcode->setText($ticket->guid);
            $barcode->setType(BarcodeGenerator::Code128);
            $barcode->setScale(2);
            $barcode->setThickness(25);
            $barcode->setFontSize(10);
            $barCodeResult = $barcode->generate();

            $qrCode = new QrCode();
            $qrCode->setText($ticket->guid);
            $qrCode ->setSize(300);
            $qrCode ->setPadding(10);
            $qrCode->setErrorCorrection('high');
            $qrCode->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0));
            $qrCode->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0));
            $qrCode->setLabel('Scan Qr Code');
            $qrCode->setLabelFontSize(16);
            $qrCode->setImageType(QrCode::IMAGE_TYPE_PNG);

            $ticketDescription['id'] = $ticket->id;
            $ticketDescription['event_name'] = $ticket->event_name;
            $ticketDescription['event_image'] = $ticket->event_image;
            $ticketDescription['address'] = $ticket->address;
            $ticketDescription['date'] = $ticket->date;
            $ticketDescription['time'] = $ticket->time;
            $ticketDescription['row'] = $ticket->row;
            $ticketDescription['place'] = $ticket->place;
            $ticketDescription['price'] = $ticket->price / 100;
            $ticketDescription['qrCode'] = $qrCode;
            $ticketDescription['barcode'] = $barCodeResult;

            array_push($responce, $ticketDescription);

            if($ticket->sector_id){
                $place = DB::table('places')
                    ->where([['sector_id', $ticket->sector_id],
                        ['name', $ticket->row . 'row ' . $ticket->place.'place']])
                    ->get();
            }else{
                $place = Place::where('name', '=', $ticket->event_name . $eventId)
                    ->join('event_place', 'event_place.place_id', '=', 'places.id')
                    ->where('status', '=', 'free')
                    ->groupBy('places.id')
                    ->limit(1)
                    ->select('places.id')
                    ->get();
            }

            foreach ($place as $val){
                DB::table('event_place')
                    ->where([['event_id', $ticket->event_id], ['place_id', $val->id]])
                    ->update(['status' => 'sales']);
            }
        }

        $event = Event::find($eventId);


        DB::table('orders')->where('guid', $orderNumber)->update(['status_payment' => 'yes']);

        if(isset($_GET['success']) && !empty($_GET['success'])){
            $success = $_GET['success'];
        }

        if (view()->exists('ticket')){
            return view('ticket', compact('responce', 'success', 'event'));
        }
        abort(404);
    }

    public function saveTicket(Request $request)
    {


        DB::table('orders')->insert(
            ['guid' => $request->guid, 'purchase_amount' => $request->amount,]);

        $orderId = DB::getPdo()->lastInsertId();

        foreach ($request->tickets as $ticket){
            $guidToTicket = Guid::create();
            $prise = $ticket['price'] * 100;
            DB::table('tickets')->insert(
                ['order_id' => $orderId, 'guid' => $guidToTicket, 'event_name' => $ticket['eventName'],
                    'event_image' => $ticket['eventImage'], 'address' => $ticket['address'], 'date' => $ticket['date'],
                    'time' => $ticket['time'], 'price' => $prise, 'place' => $ticket['place'], 'row' => $ticket['row'],
                    'sector_id' => $ticket['sectorId'], 'event_id' => $ticket['eventId']]);
        }

        return response('true', 200);
    }

    public function getSession(Request $request)
    {
        $tickets = $request->session()->get('tickets');
        if(isset($tickets) && !empty($tickets)){
            return $tickets;
        }else{
            return response('false', 200);
        }

    }

    public function setSession(Request $request)
    {
        $request->session()->put('tickets', $request->tickets);
    }
}
