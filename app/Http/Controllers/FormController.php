<?php

namespace App\Http\Controllers;

use App\Events\FormSubmittedEvent;
use App\Mail\SendAdminNotificationMail;
use App\Mail\SendConfirmationMail;
use App\Models\FormResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function index()
    {
        $responses = FormResponse::query()->orderBy('created_at', 'desc')->get();
        return view('responses.index', compact('responses'));
    }
    public function storeResponse(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
            'shop' => 'required|string',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json([
                'message' => 'Validation error, some fields are required',
                'status' => 'error',
            ], 422);
        }

        $shop = User::where('name', $request->shop)->first();

        if (!$shop) {
            return response()->json([
                'message' => 'Shop not found',
                'status' => 'error',
            ], 404);
        }

        $data = $request->except('shop');
        $data['user_id'] = $shop->id;

        $formResponse = new FormResponse();
        $formResponse->fill($data);
        $formResponse->save();

        $adminEmail = $shop->config('general.admin_notification');
        $wantsConfirmation = $shop->config('general.send_confirmation_mail', false);

        logger()->info('confirmation', [$wantsConfirmation]);

        if ($adminEmail) {
            Mail::to($adminEmail)->send(new SendAdminNotificationMail($formResponse));
        }

        if ($wantsConfirmation) {
            Mail::to($data['email'])->send(new SendConfirmationMail($formResponse));
        }

        if ($shop->config('general.save_as_customer', false)) {
            event(new FormSubmittedEvent($formResponse));
        }

        return response()->json([
            'message' => $shop->config('customization.success_message', 'Thank you for your message'),
            'status' => 'success',
        ], 200);
    }
}
