{{--
    Spam honeypot — include inside any public form (@include('frontend.partials.honeypot')).
    Real users never see or fill the "website" field; bots do. The encrypted "_hpt"
    timestamp lets the controller reject forms submitted implausibly fast (bots).
    No id/for attributes so the partial is safe to use multiple times on one page.
--}}
<div style="position:absolute!important;left:-9999px!important;top:-9999px!important;width:1px;height:1px;overflow:hidden;" aria-hidden="true">
    <input type="text" name="website" tabindex="-1" autocomplete="off" value="" placeholder="Leave this field empty">
</div>
<input type="hidden" name="_hpt" value="{{ \Illuminate\Support\Facades\Crypt::encryptString((string) now()->timestamp) }}">
