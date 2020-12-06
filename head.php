    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title;?></title>
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
    <link rel=icon href='img/favicon.ico' sizes="32x32" type="image/png">
  
      <!-- reference your copy Font Awesome here (from our CDN or by hosting yourself) -->
   <link href="css/fontawesome.css" rel="stylesheet">
   <link href="css/brands.css" rel="stylesheet">
   <link href="css/solid.css" rel="stylesheet">
   <link href="css/custom.css" rel="stylesheet">
   <style>
      *{
        font-family: 'Roboto', sans-serif;
      }

      body{
        background:#f2f2f2;
      }
      @media(max-width:770px){
        .modal {padding:0px!important;}
        .modal .modal-dialog{
          margin:10px!important;
        }
        
      }

      @media(max-width:1000px){
        .modal .col-md-10{
          width:100%!important;
        }
      }

      @media(max-width:990px){
        .activarse .row{
          margin-top:10px!important;
        }
        .activarse .cambiarposicion{
          justify-content:center!important;
          margin:auto;
        }
        .total_datos td:nth-child(1) {
          text-align:center;
          padding-left:10px;
        }
        .total_datos td:nth-child(2) {
          text-align:left;
        }
      }
      @media(max-width:580px){
        .activarse .alterarposicion .row{
          margin-top:10px!important;
        }
        .activarse .alterarposicion{
          flex-wrap:wrap;
          flex:0 1 100%!important;
          justify-content:center!important;
        }
        .col{
          width:100%!important;

        }
        .btn-dark{
          width:60%!important;
        }
        .activarse .cambiarposicion{
          flex: 0 1 100%!important
        }
      }



      @media(max-width:1000px){
        .modal .modal-body{
          flex-wrap:wrap;

        }
        .modal .seccion1, .modal .seccion2{
          flex:0 1 100%!important;
          height:100%;
        
        }
        .modal #marca_general {
          display:flex!important;
          justify-content:space-between;
          flex-wrap:wrap;
        }
        .modal #marca_general .principal-nav {
          display:flex;
          
          flex-direction:column;
          flex:0 1 30%;
        
        }
      
      }
      @media(max-width:500px){
        .modal .modal-body{
          flex-wrap:wrap;

        }
        .modal .seccion1, .modal .seccion2{
          flex:0 1 100%!important;
        }
        .modal #marca_general {
          display:flex!important;
          justify-content:space-between;
          flex-wrap:wrap;
        }
        .modal #marca_general .principal-nav {
          display:flex;
          
          flex-direction:column;
          flex:0 1 100%;
        
        }
        .modal .col-md-10{
          width:100%!important;
        }
      }
      #resultados,#resultadosmodificar{
        margin-bottom:30px;
      }
      input{
        border:none!important;
        border-bottom:1px solid #b3b3b3!important;
        background:#fFf!important;
      }
      input:focus{
        border:none!important;

      }
      .alert{
        display:flex;
        justify-content:center;
        margin:auto;
        margin-top:10px;
        margin-bottom:20px;
      }
      .modal .modal-title{
        font-size:15px;
        margin:auto;
      }

      th{
        background:#495560!important;
        color:#fff;
        font-weight:500!important;
        text-align:center;
        border-right:1px solid #c8c8c8;
        padding:10px 20px!important;
        font-size:14px!important;

      }
      td{
        font-family:'Roboto',sans-serif;
        color:#495560;
        font-weight:normal;
        text-align:center;
        padding:10px 10px!important;
        font-size:14px!important;
      }

      /*paginacion*/
      .paginacion{
        font-family:'Roboto',sans-serif;
        display:flex;
        justify-content:center;
        margin:auto;
        width:100%;
        background:#c8c8c8;
        margin-bottom:10px;
      }
      .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
          z-index: 3;
          color: #fff;
          cursor: default;
          background-color: #495560;
          border-color: #fff;
      }
      .panel-info>.panel-heading {
          color: #666666!important;
          background-color: #f2f2f2!important;
          border-color: #666666!important;
          border:none!important;
      }
      .panel-info {
          border-color: #fff!important;
      }
      .panel-body{
        background-color: #f2f2f2!important;
        border: 1px solid #f2f2f2!important;
      }
      .pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {
          z-index: 2;
          color: #fff;
          background-color: #495560;
          border-color: #ddd;
      }
      a:focus, a:hover {
          color: #fff;
          text-decoration: underline;
      }
      a {
          color: #495560;
          text-decoration: none;
      }
      .pagination>li>a, .pagination>li>span {
          position: relative;
          float: left;
          padding: 6px 12px;
          margin-left: -1px;
          line-height: 1.42857143;
          color: #495560;
          text-decoration: none;
          background-color: #fff;
          border: 1px solid #ddd;
      }

      /*navbar*/
      .navbar-default{
        
      }
      .nav li {
        padding-left:10px;
      
      }
      .nav li a{
        color:#495560!important;
        padding:10px 15px;

      }
      .nav .activarbarra{ 
        position:relative;
        font-family:'Roboto',sans-serif;
        font-size:14px;
        font-weight:normal;
        width:150px;
        text-align:center;
        color:#495560!important;
        font-weight:500;
        transition:all 300ms ease-in-out;
        overflow:hidden;

      }
      .activarnav{ 
          border-bottom:1px solid #495560;
          margin-bottom:7px;
      }
      .nav .activarbarra:hover:before{ 
        left:0;
        width:100%;
      }

      .nav .activarbarra:before{
        content:'';
        position:absolute;
        width:0%;
        height:100%;
        border-bottom:1px solid #495560;
        top:0%;
        left:-5%;
        transition:all 300ms ease-in;
        overflow:hidden;
      }
      /*acciones*/
      .botones-accion{
        
        margin:auto;
      }
      .acciones{
        padding:5px 5px;
        margin:auto;
        width:100%;
        font-size:18px!important;
        transition:all 300ms ease-in-out;
        top:0;
        left:0;
      }
      .acciones:hover{
        color:#323232;
      }
      .eliminar{
        color:#d9534f!important;
        cursor:pointer;
      }

      .nav .active a:hover{
        transition:all 300ms ease-in-out;
      }
      h4{
        color:#495560;
        font-weight:600;
        text-align:start;
        font-size:18px;
      }
      .panel-info{
        border:none!important;
      }
      /*navbar*/
      .navbar-collapse .navbar-nav{
        padding:10px!important;
        margin:auto!important;
      }
      /*buscadores*/
      .buscar{
        padding:20px 20px!important;
        display:flex!important;
        justify-content:center!important;
        margin:auto!important;
        width:100%!important;
        margin-top:20px!important;
      }
      .buscar .panel-heading{
        text-align:center;
        flex:0 1 20%;
        width:100%;
      }


      /*busqueda*/
      .titulo{
        font-size:15px;
        font-weight:600;
        color:#495560;
        text-align:center;
        margin:auto;
      }
      .seccion1{
        padding:10px;
        padding-top:0px;
      }
      .seccion2{
        padding:10px;
      }

      .seccion1,.seccion2{
        overflow:hidden;
        position:relative;

        height:auto;
      }

      /*tabla*/
      .table-responsive>.table>tbody>tr>td, .table-responsive>.table>tbody>tr>th, .table-responsive>.table>tfoot>tr>td, .table-responsive>.table>tfoot>tr>th, .table-responsive>.table>thead>tr>td, .table-responsive>.table>thead>tr>th {
          white-space: initial;
      }

      tbody tr td, tbody tr th, tfoot tr td, tfoot tr th, thead  tr td, thead tr th {
        white-space: initial;
      }


      .barra{
        display:flex;
        justify-content:center;
        margin:auto ;
        border:1px solid #495560;
        width:25%;
        margin-bottom:20px;
      }
      .seccion1{
        max-height:100%;
        overflow-y:auto;
        height:100%;
        min-height:100%;
      }
      .seccion1 a{
        padding:10px;
      }
      .seccion1 .noactivar{
        padding-left:0!important;
        border-bottom:1.5px solid #495560!important;
        font-weight:normal;
        font-size:15px;
      }
      .contenedor-titulo{
        border:1px solid #495560!important;
        padding:15px;
        margin-bottom:20px;
        margin-top:10px;
      }
      .selecteds,.selected2,.selected3{
        /*background:#cfd8dc;*/
        background-color: #e6e7e8!important;
        border-color: #c3e6cb!important;
        
      }

      .limpiar{
        position:relative;
        color:#323232!important;
        text-decoration:none!important;
        display: flex;
        justify-content:center;
        margin:auto;
          background: #f3f3f3;
          border: 1px solid #323232;
          padding: 10px!important;
          border-radius: 20px!important;
          height: 100%!important;
          max-height: 40px!important;
          min-width: 40px!important;
          font-weight:normal;
          width:150px;
          margin-top:-15px;
        

      }
      .limpiar .titulo{
        font-weight:normal!important;
      }
      .limpiar:hover .titulo{
        color:#fff!important;
      }



      .seleccionar{
          color:#fd3c3d!important;
      }

      #sidebar ul li {
        list-style:none;
      }
      #sidebar ul li a {
          padding: 5px;
          padding-left:15px;
          font-size: 1.1em;
          display: block;
          list-style:none;
          transition:all 300ms ease-in;
          text-decoration:none;
      }

      .principal-nav ul li{
        border-bottom:1px solid #c8c8c8;
          padding-left:15px;
          padding: 2px;
          font-size: 1.1em;
          display: block;
          list-style:none;
          transition:all 300ms ease-in;
          text-decoration:none;
      }
      .principal-nav li:hover,.principal-nav ul li:focus {
        color:#323232!important;
        border-bottom:1px solid #495560!important;
      }

      .principal-nav li a:hover,.principal-nav ul li a:focus {
        color:#323232!important;
      }

      .principal-nav li a:hover,.principal-nav ul li a:focus {
        color:#323232!important;
      }

      #sidebar .noactivar:hover, #sidebar .noactivar:focus{
        padding-left:0!important;
        border-bottom:1.5px solid #495560!important;
        color:#495560;
      }




      .flecha{
        float:right;
        margin:auto;
        font-size:12px;
      }


      .collapse.in {
          display: block!important;
          animation-delay:.3ms;
          animation-time:.3ms;
      }
      .collapse{
        display: none!important;
      }
      .subtitulo{
        color:#323232;
        font-weight:bold;
        font-size:15px;
        border-bottom:1px solid #495560;
      }
      .subtitulo:hover, .subtitulo:focus,.subtitulo:active{
        color:#323232;
        font-weight:bold;
        font-size:15px;
        border-bottom:1px solid #495560!important;
      }
      .subtitulo::after {
          float: right;
      }
      .subtitulo::after {
          display: inline-block;
          margin-left: .255em;
          vertical-align: .255em;
          content: "";
          border-top: .3em solid;
          border-right: .3em solid transparent;
          border-bottom: 0;
          border-left: .3em solid transparent;
      }


      #sidebar ul.components {
          padding: 10px 0;
      }
      .list-unstyled {
          padding-left: 0;
          list-style: none;
      }
      #sidebar {
          color: #343c38;
          transition: all 0.3s;
          text-align: left;
      }

      #sidebar .estilos li{
        padding-left:0px!important;
      }
      .estilos a{
        font-size:13px!important;
      }
      nav{
        display:block;
      }


      /*navegacion*/
      #marca_general .principal-nav{
        margin-top:20px!important;
        margin-bottom:20px!important;
      }

      .noactivar{
        background:#c3c3c3!important;
        text-align:center;
        font-weight:bold!important;
        border:none!important;
      }
      /*fin filtro*/
      .buscar label{
        margin:auto;
        text-align:end;
        color:#ACABAB!important;
        font-weight:normal!important;
      }
      .buscar input{
        width:100%!important;
      }

      .buscar button{
        display:flex;
        justify-content:center;
        padding:10px 10px!important;
        background:#495560!important;
        width:60%!important;
        margin:auto;
        float:left;
      }
      .buscar span{
      margin-right:5px;
      }
      /*imagenes*/
      .hover{
        transition:all 300ms ease-in;
      }
      .hover:hover{
        transform:scale(1.05);
        transform: translateY(-3px);
        box-shadow: 0 6px 6px 0 rgba(0, 0, 0, 0.1);
      }

      /*tabla*/

      /*toast color accion*/
      .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
      
          vertical-align: middle!important;
        
      }


      .toast{
        font-family:'Roboto', sans-serif;
        top:35px;
        margin-top:10px;
        position:relative;
        max-width:400px;
        min-width:200px;
        height:auto;
        min-height:48px;
        line-height:1.5em;
        background:#495560;
        padding:10px 25px;
        font-size:1.1rem;
        font-weight:400;
        color:#fff!important;
        align-items:center;
        justify-content:space-between;
        cursor:default;
        display:flex;
        border-radius:none;
        font-size:13px!important;
      }
      .toast{
        -webkit-box-shadow:0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.12),0 1px 5px 0 rgba(0,0,0,0.2);box-shadow:0 2px 2px 0 rgba(0,0,0,0.14),0 3px 1px -2px rgba(0,0,0,0.12),0 1px 5px 0 rgba(0,0,0,0.2)
        }
        #toast-container{display:block;position:fixed;z-index:10000;left:35px; max-width:400px!important;
        min-width:200px!important;width:400px!important;}@media only screen and (max-width: 600px){#toast-container{min-width:100%;bottom:0%}}@media only screen and (min-width: 601px) and (max-width: 992px){#toast-container{left:5%;bottom:7%;max-width:90%}}@media only screen and (min-width: 993px){#toast-container{top:10%;right:7%;max-width:86%}}.toast{border-radius:2px;top:35px;width:auto;margin-top:10px;position:relative;max-width:100%;height:auto;min-height:48px;line-height:1.5em;background-color:#323232;padding:10px 25px;font-size:1.1rem;font-weight:300;color:#fff;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;cursor:default}.toast .toast-action{color:#eeff41;font-weight:500;margin-right:-25px;margin-left:3rem}.toast.rounded{border-radius:24px}@media only screen and (max-width: 600px){.toast{width:100%;border-radius:0}}
        .correcto{
          color: #155724!important;
          background-color: #d4edda!important;
          border-color: #c3e6cb!important;
      }
      .error{
          color: #721c24!important;
          background-color: #f8d7da!important;
          border-color: #f5c6cb!important;
      }
      .espera{
        color: #856404!important;
          background-color: #fff3cd!important;
          border-color: #ffeeba!important;
      }
      .fixed_header tbody {
        display:block;
        overflow-y:scroll;
        height:100%;
        max-height:700px;
        min-height:auto;

      }

      /*contenedor principal*/
      #resultados,#resultadosmodificar{
        padding:0!important;

      }
      .listalinea{
        font-size:12px;
        font-weight:600;
        margin:0!important;
        margin-top:5px!important;
      }

      thead th{
        font-size:14px;
        font-weight:600;
      }
      .total_datos .pintar{
        font-size:14px;
        font-weight:600;
      }

      /*.total_datos td:nth-child(1) {
        width:10%;
      }
      .total_datos td:nth-child(2) {
        width:20%;
      }
      .total_datos td:nth-child(3) {
        width:10%;
      }
      .total_datos td:nth-child(4) {
        width:10%;
      }
      .total_datos td:nth-child(5) {
        width:10%;
      }
      .total_datos td:nth-child(6) {
        width:10%;
      }
      .total_datos td:nth-child(7) {
        width:17%;
      }
      .total_datos td:nth-child(8) {
        width:15%;
      }*/

      .total_datos td:nth-child(1) {
        width:17%;
      }
      .total_datos td:nth-child(2) {
        width:27.5%;
      }
      .total_datos td:nth-child(3) {
        width:1%;
      }
      .total_datos td:nth-child(4) {
        width:4%;
      }
      .total_datos td:nth-child(5) {
        width:4%;
      }
      .total_datos td:nth-child(6) {
        width:11%;
      }
      .total_datos td:nth-child(7) {
        width:14%;
      }
      .total_datos td:nth-child(8) {
        width:15%;
      }

      .fixed_header thead tr{
        display:block;
      }


      .autocomplete-items {
        position: absolute;
        border: 1px solid #d4d4d4;
        border-bottom: none;
        border-top: none;
        z-index: 99;
        /*position the autocomplete items to be the same width as the container:*/
        top: 100%;
        left: 0;
        right: 0;
        max-height:400px;
        min-height:auto;
        height:auto;
        overflow-y:scroll;
      }

      .filtro{
        border: 1px solid #b3b3b3;
        padding-top:10px!important;
        margin-bottom:20px!important;
      }
      .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
      }
      .autocomplete-items div:hover {
        /*when hovering an item:*/
        background-color: #e9e9e9;
      }
      .autocomplete-active {
        /*when navigating through the items using the arrow keys:*/
        background-color: DodgerBlue !important;
        color: #ffffff;
      }
      .modal-title,td,th,tr,thead,tbody{
        font-family: 'Roboto', sans-serif;

        
      }


       /* custom styling for all icons */
        i.fas,
        i.fab {
          border: 1px solid #e11f28;
        }

        i.sin.fab {
          border: none !important;
        }
        .activar{
          padding:10px 5px;
        }
        .activar2:hover{
          padding:5px 5px;
          background:#232323;
          color:#fff;
        }
        .activar:hover{
          padding:10px 5px;
          background:#000;
          color:#fff;
        }
        .cancelar{
          background:#dc3545!important;
          color:#fff!important;
          border:none!important;
          transition:all 300ms ease-in-out;
        }
        .cancelar:hover{
          background:#fd3c3d!important;
          color:#fff!important;
          border:none!important;
        }

        /*botones de accion*/
        #accion_nuevo{
          padding:10px;
        }
        #accion_nuevo:hover{
          color:#323232;
        }
        .borrar{
          color:#fd3c3d;
        }
        .agregar{
          padding:10px 15px;
          background:#7CD690;
          border-radius:4px;
          
        }
        .agregar:hover{
          color:#323232;
          
        }
        .glyphicon{
          top:2px!important;
        }
      
        .btn{
          display:block;
          background:#f3f3f3;
          color:#323232;
          border: 1px solid #323232;
          padding:10px!important;
          border-radius:20px!important;
          height:100%!important;
          max-height:40px;
          min-width:150px;
        }
        .btn span{
          font-size:14px;
        }

        .btn:focus{
          outline:none!important;
          outline-offset:0px!important;
          border: 1px solid #323232!important;
        }

        .btn:hover{
          padding:10px;
        }
        .btn-warning:hover{
            background:#f0ad4e;
            border:1px solid #eea236;
          }
          .btn-danger:hover{
            background:#dc3545;
            border:1px solid #dc3545;
          }
          .btn-success:hover{
            background:#5cb85c;
            border:1px solid #4cae4c;
          }
          .btn-info:hover{
            background:#5bc0de;
            border:1px solid #46b8da;
          }
          .btn-dark:hover{
            background:#343a40;
            border:1px solid #343a40;
            color:white;
          }
        /* custom styling for specific icons */
        .fa-fish {
          color: salmon;
        }

        .fa-frog {
          color: green;
        }

        .fa-user-ninja.vanished {
          opacity: 0.0;
        }

        .fa-facebook, .fa-twitter, .fa-google-plus-g, .fa-instagram {
          color: #e11f28;
        }
          .btn{
            background-color:none!important;
          }
          .navbar-default{

          width:100%;
          z-index:1;
          transition:all 300ms ease-in-out;
        }
        .fixed{
          
          animation-name:crear;
        
          animation-duration:300ms;
          position:fixed;
          
        }
        #resultados,#resultadosmodificar{
          overflow:auto;
        }
      @media(max-width:450px){
        .activarse{
          justify-content:center!important;
        }
      }
      @media(max-width:1000px){
        .buscador{
          flex:0 1 60%!important;
          
        }
        .buscador .buscarmodificar{
          flex:0 1 80%!important;
        }
        .panel-heading{
          flex:0 1 40%!important;
        }
      }
      @media(max-width:700px){
        .buscar{
          flex-wrap:wrap;
        }
        .buscador{
          flex:0 1 100%!important;
          justify-content:center!important;
        }
        .panel-heading{
          flex:0 1 100%!important;
          
        }
      }
      @media(max-width:770px){
        .navbar-header img{
          width:250px!important;
        }
        .navbar-default .navbar-toggle {
          margin: 20px auto!important;
        }
      }
      input,select,button{
      padding:10px 15px!important;
      height:40px!important;
      border-radius:1px!important;
      font-weight:500!important;
      margin:auto!important;
      transition:all 300ms ease-in-out!important;

      }
      input{
        border:none!important;
        border-bottom:1px solid #c8c8c8!important;
        box-shadow:none!important;
      }
      select{
        border:none!important;
        border-bottom:1px solid #c8c8c8!important;
        box-shadow:none!important;
        outline:none!important;
      }
      select:focus{
        border:none!important;
        box-shadow:none!important;
        border-bottom:1px solid #c8c8c8!important;
      }
      input:focus,select:focus,button:focus{
        border:none!important;
        box-shadow:none!important;
        border-bottom:1px solid #c8c8c8!important;
      }
      a:focus, i:focus{
        border:none!important;
        box-shadow:none!important;
        color:#495560!important;
      }
      input:hover{
        border-bottom:1px solid #495560!important;
      }
      input:focus{
        border-bottom:1px solid #495560!important;
      }

      /*navegacion*/
      .navbar-default .navbar-collapse {
          border-color: #e11f28;
          margin: 7px auto 0 !important;
      }
      .fixed{position:fixed; top:-0.6px}
      .alejar{
        margin-right:20px;
      
      }

      /*preloader*/
      .preloader{
                      display:flex;
                      flex: 0 1 10;
                      z-index:10px;
                      width:40px;
                      height:40px;
                      border: 5px solid #eee;
                      border-top: 5px solid #666;
                      border-radius:50%;
                      animation-name: girar;
                      animation-duration: 2s;
                      animation-iteration-count: infinite;
                      animation-timing-function: linear;

                    }
                    @keyframes girar{
                      from{
                        transform: rotate(0deg);
                      }
                      to{
                        transform: rotate(360deg);
                      }
                    }
          @media(max-width:550px){
      
          .busqueda,.buscar{
            flex-direction:column;

          }
          .buscador{
            flex-wrap:wrap;
          }
          
          .busqueda .col-md-10, .buscar .col-md-5{
            margin-bottom:20px;
          }
          .buscador col{
            flex:0 1 100%!important;
          }
          .buscar .col{
            flex:0 1 100%!important;
            display:flex;
            justify-content:center;
          }

      }
      @media(max-width:770px){
      
        .desaparecer{
          display:none!important;
        }

      }

      @media(max-width:400px){
      
      .btn-dark, .buscador .btn-default{
        width:100%!important;
      
      }
      

      }
      .navbar-default {
          background-color: none!important;
          /* border-color: #fff; */
          border:none!important;
          border-radius:0px!important;
          margin-top:0px!important;
          box-shadow:1px 1px 1px #c2c2c2;
      }
      .linea{

        margin:auto;
      }
      /*configuracion de las tablas*/
      tbody::-webkit-scrollbar {

          width: 8px;     /* Tamaño del scroll en vertical */
          height: 8px; 

            /* Tamaño del scroll en horizontal */
            /*display:none;
            /* Ocultar scroll */
      }
      tbody::-webkit-scrollbar-thumb {
          background: #ccc;
          border-radius: 0px;
      }

      /* Cambiamos el fondo y agregamos una sombra cuando esté en hover */
      tbody::-webkit-scrollbar-thumb:hover {
          background: #b3b3b3;
          box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
      }

      /* Cambiamos el fondo cuando esté en active */
      tbody::-webkit-scrollbar-thumb:active {
          background-color: #999999;
      }
      /* Ponemos un color de fondo y redondeamos las esquinas del track */
      tbody::-webkit-scrollbar-track {
          background: #e1e1e1;
          border-radius: 4px;
      }

      /* Cambiamos el fondo cuando esté en active o hover */
      tbody::-webkit-scrollbar-track:hover,
      tbody::-webkit-scrollbar-track:active {
        background: #d4d4d4;
      }

      /*filtro*/
      .subtitulo{
        text-transform:uppercase!important;
      }
      .estilos a{
        padding-left:25px!important;
        /*text-transform:lowercase;*/
      }
      .estilos a:first-letter{
        text-transform:uppercase!important;
      }

      .fas.fa-spinner {
          -webkit-animation: glyphicon-spin-r 2s infinite linear;
          animation: glyphicon-spin-r 2s infinite linear;
      }
      @-webkit-keyframes glyphicon-spin-r {
          0% {
              -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
          }

          100% {
              -webkit-transform: rotate(359deg);
              transform: rotate(359deg);
          }
      }
      .agregar{
        border:none!important;
      }
      .agregar:focus{
        border:none!important;
        outline:none!important;
      }

      .cerrarseleccionado{
        float:right;cursor:pointer;margin:auto;padding:5px;color:#495560;
        border-radius:100%;
        font-size:12px;
      }
      #marca_general .principal-nav{
        border:none!important;
      }

      #sidebar ul li:hover .principal-nav{
        border:none!important;
      }
      .des_promocion{
          display: block;
          float:right;
          background: #f3f3f3;
          color: #323232;
          border: 1px solid #323232;
          padding: 10px!important;
          border-radius: 20px!important;
          height: 100%!important;
          max-height: 100%;
          text-align:center;
          width:100%;
          max-width:220px;
      }
      .promo2{
        padding-left:20px;
        padding-right:5px;
      }

      .mensajepromo{
        display:flex;
        justify-content:center!important;
        color:#323232;
        font-weight:bold;
        background-color:#F4B415;
        text-align:center;
      } 
  </style>

  <script>
     function activarfacturacion(){
      $('#historico').removeClass('activarnav');
      $('#nuevo').removeClass('activarnav');
      $('#cliente').removeClass('activarnav');
      $('#facturacion').addClass('activarnav');
    }

  </script>
 