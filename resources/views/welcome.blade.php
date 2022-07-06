  <!-- ************************************************************************ !-->
    <!-- ***                                                              *** !-->
    <!-- ***       ¤ Designed and Developed by  LEADconcept               *** !-->
    <!-- ***               http://www.leadconcept.com                     *** !-->
    <!-- ***                                                              *** !-->
    <!-- ************************************************************************ !-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Zillas Top Swap</title>
  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />  
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/styles.css')}}">
  <link rel="stylesheet" href="{{asset('css/datatable.css')}}">
  <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap-multiselect.css')}}">

  <style>
.loader-wrapper {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: #242f3f;
  display:flex;
  justify-content: center;
  align-items: center;
  z-index:9999999;
}
.loader {
  display: inline-block;
  position: relative;
  top: 5%;                      
  border: 4px solid #Fff;
  animation: loader 2s infinite ease;
}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-bottom: 16px solid blue;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>

<body class="antialiased">
<div class="loader-wrapper" id="loader-overlay" style="display: none;">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
  <div id="app"></div>
<script src="{{asset('js/app.js')}}" ></script>
<script src="{{asset('js/scripts.js')}}" ></script>
<script>
    $(window).on("load",function(){
     $(".loader-wrapper").fadeOut("slow");
});
</script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/bootstrap-multiselect.js')}}"></script>
<script src="{{asset('assets/demo/datatables-demo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>