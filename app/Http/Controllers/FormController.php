<?php

namespace App\Http\Controllers;

use App\Models\FormResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
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

        return response()->json([
            'message' => $shop->config('customization.success_message', 'Thank you for your message'),
            'status' => 'success',
        ], 200);
    }
}
