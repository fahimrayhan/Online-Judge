<form action="{{route('administration.contest.create')}}" class="form" id="create_contest" method="post">
        @csrf
        <div class="alert-area">
            <div class="alert alert-danger error-area"></div>
            <div class="alert alert-success success-area"></div>
        </div>
        <div class='row' style="margin-bottom: 5px;">
            <div class='col-md-4 label-area'>
                <label> Contest Name<font color="red"> *</font>:</label>
            </div>
            <div class="col-md-8">
                <input type="text" class='form-control-input' name="name" placeholder="Enter Contest Name">
            </div>
        </div>
        <div class='row' style="margin-bottom: 5px;">
            <div class='col-md-4 label-area'>
                <label> Contest Start<font color="red"> *</font>:</label>
            </div>
            <div class="col-md-8">
                <input type="datetime-local" class='form-control-input' name="start" placeholder="Enter Contest Start Time">
            </div>
        </div>
        <div class='row' style="margin-bottom: 5px;">
            <div class='col-md-4 label-area'>
                <label> Contest Duration<font color="red"> *</font>:</label>
            </div>
            <div class="col-md-8">
                <input type="number" class='form-control-input' name="duration" placeholder="Enter Contest Duration">
                <small class="text-muted">Contest duration in minutes</small>
            </div>
        </div>
        <div class='row'>
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <div>
                    <button type="submit" class="btn submit-btn" onclick="Contest.create()" style="margin-top: 15px;">Create Contest</button>
                </div>
            </div>
        </div>
</form>
