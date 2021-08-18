<?php

namespace App\Http\Controllers\Administration\Contest;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Models\ContestAnnouncement;
use Illuminate\Http\Request;
use App\Events\Contest\ContestAnnouncementBroadcastEvent;

class ContestAnnouncementController extends Controller
{

    protected $contest;

    public function __construct()
    {
        if (isset(request()->contest_id)) {
            $this->contest = Contest::where(['id' => request()->contest_id])->firstOrFail();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->view('index', [
            'announcements' => $this->contest->announcements()->orderBy('id','desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $announcement = ContestAnnouncement::create([
            'description'  => request()->description,
            'contest_id'   => $this->contest->id,
            'is_published' => request()->is_published ? 1 : 0,
        ]);

        if ($announcement->is_published) {
            event(new ContestAnnouncementBroadcastEvent($announcement));
        }

        return response()->json([
            'message' => "Successflly added new announcement",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($contestId, $announcementId)
    {
        $announcement = $this->contest->announcements()->where(['id' => $announcementId])->firstOrFail();
        return $this->view("show", ['announcement' => $announcement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($contestId, $announcementId)
    {
        $announcement = $this->contest->announcements()->where(['id' => $announcementId])->firstOrFail();
        return $this->view("edit", ['announcement' => $announcement]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contestId, $announcementId)
    {
        $announcement = $this->contest->announcements()->where(['id' => $announcementId])->firstOrFail();
        $announcementBroadcast = $announcement->is_published == 1 ? 0 : 1;
        $announcement->update([
            'description'  => $request->description,
            'is_published' => $request->is_published ? 1 : 0,
        ]);

        if($announcementBroadcast == 1 && $announcement->is_published == 1){
            event(new ContestAnnouncementBroadcastEvent($announcement));
        }

        return response()->json([
            'message' => "Successflly update announcement",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($contestId, $announcementId)
    {
        $announcement = $this->contest->announcements()->where(['id' => $announcementId])->firstOrFail();
    }

    public function view($viewName, $data = [])
    {
        $data['contest'] = $this->contest;
        return view("pages.administration.contest.announcement." . $viewName, $data);
    }
}
