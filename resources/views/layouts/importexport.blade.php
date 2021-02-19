<form class="mt-3" action="/export-excel" method="post" id="">
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
        <button type="submit" id="" class="btn btn-primary btn-block">Eksport do Excel</button>
        <a type="button" href="/import-form" class="btn btn-success btn-block">Import z Excel</a>
        <a type="button" href="/klientForm" class="btn btn-warning btn-block">Wprowadź Klienta</a>

    </fieldset>
</form>
