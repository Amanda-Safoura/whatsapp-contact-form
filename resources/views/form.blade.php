<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Youpi Challenge</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <div class="row col-12 col-lg-8 mx-auto">
        <div class="card my-5">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0">Envoyez nous un message</h5>
                    </div>
                    <hr>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="username" class="col-sm-3 col-form-label">Votre nom</label>
                            <div class="col-sm-9">
                                <input name="username" type="text" value="{{ old('username') }}" class="form-control"
                                    id="username">
                            </div>
                            @error('username')
                                <div class="col-sm-12 text-danger my-2 d-flex justify-content-center">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="phone_number" class="col-sm-3 col-form-label">Votre Numéro WhatsApp</label>
                            <div class="col-sm-9">
                                <input name="phone_number" type="text" value="{{ old('phone_number') }}"
                                    class="form-control" id="phone_number" placeholder="+229...">
                            </div>
                            @error('phone_number')
                                <div class="col-sm-12 text-danger my-2 d-flex justify-content-center">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="file" class="col-sm-3 col-form-label">Fichier/Image à Transférer</label>
                            <div class="col-sm-9">
                                <input name="file" type="file" class="form-control" id="file" accept="image/*,.pdf">
                            </div>
                            @error('file')
                                <div class="col-sm-12 text-danger my-2 d-flex justify-content-center">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="message" class="col-sm-3 col-form-label">Votre Message</label>
                            <div class="col-sm-9">
                                <textarea name="message" class="form-control" id="message" rows="5" placeholder="Écrivez une message ici...">{{ old('message') }}</textarea>
                            </div>
                            @error('message')
                                <div class="col-sm-12 text-danger my-2 d-flex justify-content-center">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <button type="submit" class="btn btn-primary py-md-3 px-md-5 mt-2">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
