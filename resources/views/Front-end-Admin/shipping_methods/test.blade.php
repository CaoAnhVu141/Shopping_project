<form action="{{ route('adddataroom') }}" method="POST">
    @csrf
    <div class="box-body">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="name">Name <span class="text-danger">(*)</span></label>
                <input type="text" class="form-control" name="name" placeholder="Name ......">

            </div>
        </div>
    </div>
    <div class="box-footer" >
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
    </div>
    </div>
</form>

