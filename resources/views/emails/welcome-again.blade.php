@component('mail::message')
# Introduction

Thanks so much for registering!

@component('mail::button', ['url' => 'blog.com'])
Start Browsing
@endcomponent

@component('mail::panel', ['url' => ''])
Inspirational Quote
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
