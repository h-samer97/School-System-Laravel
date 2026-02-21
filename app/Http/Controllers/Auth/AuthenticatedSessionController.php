<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider; // تأكد من وجود هذا المسار
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    // 1. قمنا بحذف use AuthTrait; لأننا لم نعد بحاجة لفحص الـ Guard

    public function create(): View
    {
        // العودة لعرض صفحة الدخول بدون تمرير متغير type
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        // 2. استخدام ميزة authenticate الموجودة داخل LoginRequest (الوضع الافتراضي)
        $request->authenticate();

        $request->session()->regenerate();

        // التوجيه إلى الصفحة الرئيسية المعرفة في RouteServiceProvider
        return redirect()->intended(route('dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        // 3. تسجيل الخروج من الحارس الافتراضي مباشرة دون الحاجة لمتغير type
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}