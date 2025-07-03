<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        /*
        認証処理
        入力されたemailとpasswordをもとに認証を行う
        認証成功時はtrue、認証失敗時はfalseを返す
        $this->boolean('remember')は、「Remember me」にチェックしたらどうか
        */
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {

            //ログイン失敗時の処理↓

            //連続ログイン失敗の制御（複数回失敗するとしばらくログインされない）
            RateLimiter::hit($this->throttleKey());

            /*
            ValidationExceptionがスローされると、
            バリデーション失敗として処理される
            メッセージはlang/en/auth.phpのfailed属性を参照しているので、
            日本語に変更する場合は、lang/ja/auth.phpを作成する
            */
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        //ログイン失敗回数をクリア
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
