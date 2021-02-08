<form class="mt-3" action="/raport" method="post" id="">
    @csrf
    <fieldset>
        <div class="form-group row">
            <label for="start_data" class="col-sm-1 col-form-label">Start</label>
            <div class="col-sm-3">
                <input type="date" name="start_data" class="form-control">
            </div>
            <label for="end_data" class="col-sm-1 col-form-label">Koniec</label>
            <div class="col-sm-3">
                <input type="date" name="end_data" class="form-control">
            </div>
        </div>
        <button type="submit" id="" class="btn btn-primary btn-block">Szukaj</button>
        <!-- <a type="button" href="/import-form" class="btn btn-success btn-block">Import z Excel</a> -->
    </fieldset>
</form>
