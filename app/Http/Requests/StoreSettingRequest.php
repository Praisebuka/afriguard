<?php

namespace App\Http\Requests;

use App\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;


class StoreSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'key' => [
                'required',
                'unique:settings',
            ],
        ];
    }
}
