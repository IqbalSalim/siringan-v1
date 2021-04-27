<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $house = House::find($id);
        // var_dump($house);
        echo "aman";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_room = new \App\Models\Room();
        $new_room->name = $request->get('name');
        $new_room->long = $request->get('long');
        $new_room->wide = $request->get('wide');
        $new_room->height = $request->get('height');
        $new_room->house_id = $request->get('house_id');
        $new_room->category_id = $request->get('categories');
        $new_room->created_by = \Auth::user()->id;
        $new_room->save();
        return redirect()->route('rooms.create_room', [$request->get('house_id')])->with('status', 'Data ruangan berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room_to_edit = \App\Models\Room::findOrFail($id);
        return view('rooms.edit', ['room' => $room_to_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->get('name');
        $long = $request->get('long');
        $wide = $request->get('wide');
        $height = $request->get('height');

        $room = \App\Models\Room::findOrFail($id);
        $room->name = $name;
        $room->long = $long;
        $room->wide = $wide;
        $room->height = $height;
        $room->updated_by = \Auth::user()->id;
        $room->save();
        return redirect()->route('rooms.edit', [$id])->with('status', 'Ruangan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = \App\Models\Room::findOrFail($id);
        $room->forceDelete();
        return redirect()->route('houses.show', [$room->house_id])->with('status', 'Data ruangan berhasil dihapus');
    }

    public function create_room($id)
    {
        $house = House::find($id);
        if ($house) {
            return view('rooms.create', ['house' => $house]);
        } else {
            return redirect()->route('houses.index');
        }
    }

    public function estimated_product($id)
    {
        $rooms = Room::where('house_id', $id)->get()->toArray();
        $long = array_column($rooms, 'long');
        $wide = array_column($rooms, 'wide');
        var_dump('<pre>', $wide, '</pre>');
    }
}
