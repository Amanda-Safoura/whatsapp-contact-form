<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendNotifFormRequest;

class WhatsAppCloudAPIController extends Controller
{
    public function sendMessage(SendNotifFormRequest $request)
    {
        //récupération des données validées
        $validatedDatas = $request->validated();

        $from = env('WHATSAPP_NUMBER_ID'); // le numero de test/live fourni par Meta for developpers


        // Try and Catch de l'envoi de messages à l'utilisateur ayant rempli le form
        try {

            $message = $validatedDatas['message'];
            $recipientNumber = $validatedDatas['phone_number'];

            $api_endpoint = "https://graph.facebook.com/v18.0/$from/messages"; // Replace with your own API endpoint
            $access_token = env('WHATSAPP_ACCESS_TOKEN'); // Replace with your own API token


            // text message
            $postDatasToSend = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $recipientNumber,
                'type' => 'text',
                'text' => [
                    'preview_url' => false,
                    'body' => $message
                ]
            ];
            $this->sendJsonThroughCurl($api_endpoint, $access_token, $postDatasToSend);

            //enregistrement du fichier dans le storage
            if (key_exists('file', $validatedDatas)) {

                /** @var UploadedFile $file*/
                $file = $validatedDatas['file'];

                // Récupération de l'extension
                $validatedDatas['file_extension'] = $file->clientExtension();

                // Enregistrement du fichier dans le répertoire 'whatsappform' du storage public
                $filePath = $file->store('whatsappform', 'public');

                // Génération de l'URL pour le fichier en utilisant asset()
                $validatedDatas['file'] = asset("storage/$filePath");

                $type = $validatedDatas['file_extension'] === 'pdf' ? 'document' : 'image';


                // Envoi du message
                $postDatasToSend = [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => $recipientNumber,
                    'type' => $type,

                    $type => [
                        'link' => $validatedDatas['file']
                    ]
                ];
                $this->sendJsonThroughCurl($api_endpoint, $access_token, $postDatasToSend);
            }


            return response()->json(['message' => 'Un message WhatsApp a été envoyé avec succès']);
        } catch (\Exception $e) {
            return response()->json(['erreur' => $e->getMessage()], 500);
        }
    }


    private function sendJsonThroughCurl(string $api_endpoint, string $access_token, array $postDatasToSend)
    {
        $ch = curl_init($api_endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postDatasToSend));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', "Authorization: Bearer $access_token"));
        curl_exec($ch);
        curl_close($ch);
    }
}
