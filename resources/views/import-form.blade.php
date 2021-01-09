<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

    <section style="padding-top:60px">
        <div class="container">
            <div class="row">
                <dic class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            Import
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="{{route('client.import')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="file">Wybierz Plik</label>
                                    <input type="file" name="file" class="form-control" >
                                </div>
                                <button type="submit" class="btn btn-primary">Zapisz</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>