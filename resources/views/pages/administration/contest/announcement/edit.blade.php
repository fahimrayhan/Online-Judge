<form class="form row" id="update_contest_announcement" action="{{route('administration.contest.announcements.update',['contest_id' => request()->contest_id,'announcement' => request()->announcement])}}" method="post">
	@csrf
	@method('PUT')
	
    <div class='form-group' style="margin-bottom: 10px;">
        <div class='col-md-3'>
                <label> Published:</label>
        </div>
        <div class="col-md-9">
             <label class="switch">
	 			<input type="checkbox" name="is_published" {{$announcement->is_published ? "checked" : ""}}>
         		<span class="slider"></span>
    		</label>
        </div>
    </div>

	<div class='form-group' style="margin-bottom: 10px;">
        <div class='col-md-3'>
                <label> Announcement<font color="red"> *</font>:</label>
        </div>
        <div class="col-md-9">
            <textarea rows="15" style="margin-top: 10px;" class="form-control" name="description" placeholder="" required="">{{$announcement->description}}</textarea>
        </div>
    </div>
    
     <div class='form-group' style="margin-bottom: 5px;">
    	<div class="col-md-9 col-md-offset-3">
    		<button class="btn btn-primary" style="margin-top: 15px;" type="submit">Update Announcement</button>
    	</div>
    </div>

	
</form>