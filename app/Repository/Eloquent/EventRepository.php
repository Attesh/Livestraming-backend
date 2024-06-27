<?php

namespace App\Repository\Eloquent;

use App\Models\Event;
use App\Models\EventItChain;
use App\Repository\EventRepositoryInterface;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{

   public function __construct(Event $model)
   {
       parent::__construct($model);
   }

   public function addEvent(Request $request) {

      $image = null;

      if (!empty($request->thumbnail)) {
         $thumbnail = $request->thumbnail;
         $image = saveFile($thumbnail, 'event/uploads', $thumbnail->getClientOriginalName());

      }

       $event = $this->model->create([
         'name'         => $request->name,
         'user_id'      => auth()->user()->id,
         'category_id'  => $request->category_id,
         'country_id'   => $request->country_id,
         'state_id'     => $request->state_id,
         'city_id'      => $request->city_id,
         'date'         => $request->date,
         'location'     => $request->location,
         'lat'          => $request->lat ?? null,
         'lng'          => $request->lng ?? null,
         'description'  => $request->description ?? null,
         'thumbnail'    => $image['path'] ?? null
       ]);

       return $event;
   }

   public function eventToItChain(Request $request){
      for ($i=0; $i <count($request->event_id) ; $i++) { 
        
            EventItChain::updateOrCreate(
               [
                  'event_id' => $request->event_id[$i],
                  'user_id' => auth()->user()->id,
               ],
               [
                  'event_id' => $request->event_id[$i],
                  'user_id' => auth()->user()->id,
                  'order' => $request->order[$i] ?? 0,
               ]
            );
      }

      return true;
   }

   public function getEventList(Request $request) {
      $events = $this->model;

      if ($request->date) {
         $events = $events->whereDate('date',$request->date);
      }

      if ($request->name) {
         $events = $events->where('name',$request->name);
      }

      $events = $events->orderByDesc('id')->paginate(10);

      $eventCollection = EventResource::collection($events)->response()->getData(true);
      return [
         'data'   => paginate($eventCollection),
         'status' => 200 
      ];
   }

   public function eventDetail($id) {
      $event = $this->model->find($id);

      return [
         'data' => new EventResource($event),
         'status' => 200
      ];
   }
}