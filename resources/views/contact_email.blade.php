<h2>Hello Admin,</h2>
You received an email from :  {{ Auth::user()->name }}
Here are the details:
<b>Email:</b> {{ $email }}
<b>Subject:</b> {{ $subject }}
<b>Message:</b> {{ $user_message }}
Thank You