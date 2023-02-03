
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="token" id="token" value="{{ csrf_token() }}">
   <meta name="user" content="{{ Auth::id() ?? 0 }}">
   
   <title>{{ config('app.name', 'Laravel') }}</title>

   <!-- Fonts -->
   <link rel="dns-prefetch" href="//fonts.gstatic.com">
   <link href="{{asset('selec2/dist/css/select2.min.css')}}" rel="stylesheet" />
   <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
   <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
   <link rel="stylesheet" href="{{'css/adminlte.min.css'}}">
   <link rel="stylesheet" href="{{asset('css/style.css')}}"> 
   <link rel="stylesheet" type="text/css"
   href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

 <!-- font awesome style -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 <!-- bootstrap core css -->
 <link rel="stylesheet" type="text/css" href="{{asset('index_styles/css/bootstrap.css')}}" />

 <!-- fonts style -->
 <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700|Roboto:400,700&display=swap" rel="stylesheet">

 <!-- Custom styles for this template -->
 <link href="{{asset('index_styles/css/style.css')}}" rel="stylesheet" />
 <!-- responsive style --> 
 <link href="css/responsive.css" rel="stylesheet" />
   <!-- Scripts -->
   <script src="{{asset('selec2/dist/js/select2.min.js')}}"></script>
   @vite(['resources/sass/app.scss', 'resources/js/app.js'])
   <script nonce="3aded2e6-3cee-4a8b-8393-b8aa2ba55db9">(function(w,d){!function(e,f,g,h){e.zarazData=e.zarazData||{};e.zarazData.executed=[];e.zaraz={deferred:[],listeners:[]};e.zaraz.q=[];e.zaraz._f=function(i){return function(){var j=Array.prototype.slice.call(arguments);e.zaraz.q.push({m:i,a:j})}};for(const k of["track","set","debug"])e.zaraz[k]=e.zaraz._f(k);e.zaraz.init=()=>{var l=f.getElementsByTagName(h)[0],m=f.createElement(h),n=f.getElementsByTagName("title")[0];n&&(e.zarazData.t=f.getElementsByTagName("title")[0].text);e.zarazData.x=Math.random();e.zarazData.w=e.screen.width;e.zarazData.h=e.screen.height;e.zarazData.j=e.innerHeight;e.zarazData.e=e.innerWidth;e.zarazData.l=e.location.href;e.zarazData.r=f.referrer;e.zarazData.k=e.screen.colorDepth;e.zarazData.n=f.characterSet;e.zarazData.o=(new Date).getTimezoneOffset();if(e.dataLayer)for(const r of Object.entries(Object.entries(dataLayer).reduce(((s,t)=>({...s[1],...t[1]})))))zaraz.set(r[0],r[1],{scope:"page"});e.zarazData.q=[];for(;e.zaraz.q.length;){const u=e.zaraz.q.shift();e.zarazData.q.push(u)}m.defer=!0;for(const v of[localStorage,sessionStorage])Object.keys(v||{}).filter((x=>x.startsWith("_zaraz_"))).forEach((w=>{try{e.zarazData["z_"+w.slice(7)]=JSON.parse(v.getItem(w))}catch{e.zarazData["z_"+w.slice(7)]=v.getItem(w)}}));m.referrerPolicy="origin";m.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(e.zarazData)));l.parentNode.insertBefore(m,l)};["complete","interactive"].includes(f.readyState)?zaraz.init():e.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,0,"script");})(window,document); </script>  

</head>

<body>
 <div id="app">
      <index/> 
   </div>
   
   
   <!--,'public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js','public/js/adminlte.min.js','public/js/demo.js','public/plugins/fontawesome-free/css/all.min.css',
   'public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css','public/css/adminlte.min.css' 
   --> 
 
   
</body>



