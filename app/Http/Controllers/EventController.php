<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::orderBy('created_at', 'desc')->paginate(3);
        return view('event.index', ['event' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'event_date' => 'required|date|after:today',
            'event_name' => 'required',
            'event_location' => 'required',
            'event_description' => 'required',
            'file_name' => 'required',
            'file_name.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        // return dd($request);
        // Ngolah semua foto yang di uploade
        foreach ($request->file('file_name') as $image) {
            $name = $image->getClientOriginalName();
            $name =  Str::random(15) . "." . explode('.',$name)[1];
            $image->move(public_path().'/storage/image/', $name);
            $data[] = $name;
        }

        // Ngolah sisa datanya
        $upload_event = new Event;
        $upload_event->event_date = date('Y-m-d', strtotime($request->event_date));
        $upload_event->event_name = $request->event_name;
        $upload_event->event_location = $request->event_location;
        $upload_event->event_description = $request->event_description;
        $upload_event->file_name = json_encode($data);
        $upload_event->save();
        return redirect('/event/admin/add')->with('success', 'Success add data.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Event::where('id', $id)->first();
        return view('event.show', ['event' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Event::where('id', $id)->first();
        return view('event.edit', ['event' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // make file list
        $oldFileName = explode(',' , str_replace(array('[', '"', ']'), '', Event::find($id)->file_name));
        // put all file in list
        if ($request->file('file_name') != null) {
            foreach ($request->file('file_name') as $image) {
                $name = $image->getClientOriginalName();
                $name =  Str::random(15) . "." . explode('.',$name)[1];
                $image->move(public_path().'/storage/image/', $name);
                array_push($oldFileName, $name);
            }
        }

        $event = Event::where('id', $id)
                ->update([
                    'event_name' => $request->event_name,
                    'event_date' => date('Y-m-d', strtotime($request->event_date)),
                    'event_location' => $request->event_location,
                    'event_description' => $request->event_description, 
                    'file_name' => json_encode($oldFileName) 
                ]);
        return redirect('/event/admin/' . $id . '/edit')->with('success', 'Success, edited data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Event::find($request->id);
        $fileName = $data->file_name;
        $fileName = explode(',', str_replace(array('[', '"', ']'), '', $fileName));
        foreach ($fileName as $img){
            Storage::delete('public/image/' . $img);
        }
        $data->delete();
        return redirect('/event/admin');
    }
    /**
     * indexAdmin function
     */
    public function editPhoto(Request $request, $id)
    {
        $data = Event::find($id);
        $deleteTarget = $request->file_name;
        $file_name = explode(',' , str_replace(array('[', '"', ']'), '', $data->file_name));
        $updatePhoto = array();
        foreach ($file_name as $item) {
            if ($item == $deleteTarget) {
                Storage::delete('public/image/' . $deleteTarget);
                $file_name = array_diff($file_name, array($deleteTarget));
            }
            else{
                $updatePhoto[] = $item;
            }
        }
        Event::where('id', $id)->update(['file_name' => json_encode($updatePhoto)]);
        return redirect('/event/admin/' . $id . '/edit')->with('success', 'Success! You have deleted the picture');
    }

    /**
     * indexAdmin function
     */
    public function indexAdmin()
    {
        $data = Event::orderBy('created_at', 'desc')->paginate(3);
        return view('event.indexAdmin', ['event' => $data]);
    }

    /**
     * showAdmin function
     */
    public function showAdmin($id)
    {
        $data = Event::where('id', $id)->first();
        return view('event.showAdmin', ['event' => $data]);
    }
}
