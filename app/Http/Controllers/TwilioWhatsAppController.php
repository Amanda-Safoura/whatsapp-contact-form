<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendNotifFormRequest;
use Illuminate\Contracts\View\View;
use Twilio\Rest\Client;

class TwilioWhatsAppController extends Controller
{
    public function index(): View
    {
        return view('form');
    }

    public function sendWhatsAppMessage(SendNotifFormRequest $request)
    {
        //récupération des données validées
        $datas = $request->validated();

        // Création du client Twilio
        $from = config('services.twilio.whatsapp_from');
        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));


        // Try and Catch de l'envoi de messages à l'utilisateur ayant rempli le form
        try {

            $message = $datas['message'];
            $recipientNumber = $datas['phone_number'];
            $recipientName = $datas['username'];

            $twilio->messages->create('whatsapp:' . $recipientNumber, [
                "from" => 'whatsapp:' . $from,
                "body" => 'Salut ' . $recipientName . '! Ceci est le message rempli dans notre formulaire:
' . $message,
            ]);

            //enregistrement du fichier dans le storage
            if (key_exists('file', $datas)) {

                /** @var UploadedFile $file*/
                $file = $datas['file'];

                // Enregistrement du fichier dans le répertoire 'whatsappform' du storage public
                $filePath = $file->store('whatsappform', 'public');

                // Génération de l'URL pour le fichier en utilisant asset()
                $datas['file'] = asset("storage/$filePath");


                $twilio->messages->create('whatsapp:' . $recipientNumber, [
                    "from" => 'whatsapp:' . $from,
                    "mediaUrl" => [$datas['file']]
                ]);
            }

            return response()->json(['message' => 'Un message WhatsApp a été envoyé avec succès']);
        } catch (\Exception $e) {
            return response()->json(['erreur' => $e->getMessage()], 500);
        }
    }
}
