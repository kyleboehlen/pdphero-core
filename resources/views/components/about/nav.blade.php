<nav class="about">
    {{-- Close icon --}}
    <img id="close-nav" class="close hover-white" src="{{ asset('icons/close-black.png') }}" />
    
    {{-- Logo --}}
    <img class="logo" src="{{ asset('logos/logo-white.png') }}" onclick="location.href='{{ route('about') }}'"/>

    {{-- Nav ul --}}
    <ul>
        <a class="close-nav" href="#about"><li>About</li></a>
        <a class="close-nav" href="#features"><li>Features</li></a>
        <a class="close-nav" href="#why"><li>Why?</li></a>
        <a class="close-nav" href="#pricing"><li>Pricing</li></a>
        {{-- Change to tutorials --}}
        <a href="#tutorials"><li>Tutorials</li></a>
        {{-- Change to FAQs page --}}
        <a href="#faqs"><li>FAQs</li></a>
        <a href="{{ route('privacy') }}" target="_blank"><li>Privacy Policy</li></a>
    </ul>
</nav>