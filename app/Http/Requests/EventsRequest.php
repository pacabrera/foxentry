<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'eventName' => 'required|string|max:100',
            'eventDateFrom' => 'required|string',
            'eventVenue' => 'required|string|max:100',
            'eventTime' => 'required|string',
            'eventFee' => 'required',
            'eventPhoto' => 'mimes:jpeg,bmp,png',
        ];
    }
}
