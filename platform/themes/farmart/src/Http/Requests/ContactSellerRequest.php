<?php

namespace Theme\Farmart\Http\Requests;

use Botble\Support\Http\Requests\Request;

class ContactSellerRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        $rules = [
            'content' => 'required',
        ];

        if (!auth('customer')->check()) {
            $rules += [
                'name'    => 'required',
                'email'   => 'required|email',
            ];
        }

        if (is_plugin_active('captcha')) {
            if (setting('enable_captcha_for_contact_seller')) {
                $rules += [
                    'g-recaptcha-response' => 'required|captcha',
                ];
            }

            if (setting('enable_math_captcha_for_contact_seller', 0)) {
                $rules['math-captcha'] = 'required|math_captcha';
            }
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required' => __('Captcha Verification Failed!'),
            'g-recaptcha-response.captcha'  => __('Captcha Verification Failed!'),
            'math-captcha.required'         => __('Math function Verification Failed!'),
            'math_captcha'                  => __('Math function Verification Failed!'),
        ];
    }
}
