@component('mail::message')
# Change Password Confirmation Email -  {{ $user_name_for_mail }}

@component('mail::panel')
Your password has been changed successfully  !!!!!!
@endcomponent

@component('mail::button', ['url' => 'Shohan'])
View Invoice
@endcomponent

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
