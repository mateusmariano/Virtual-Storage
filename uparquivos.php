<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title> UPLOAD FILES</title>

    <style>
        .bg{
            background-color: rgba(20,50,70);
        }
        .h1{
          background-image: linear-gradient(rgba(200,50,20,0.5),rgba(100,50,20,0.4));
          font-family: stencil;
          font-size: 80%;
          color: black;
          position: absolute;
          border-radius: 5%;
          border-style: double;
          box-shadow: 5px 10px;
          right: 40%;
          height: 55%;
          padding: 1%;
        }
        .box{
          background-image: linear-gradient(rgba(250,150,60,0.5),rgba(200,50,20,0.4));
          border-style:inset;
          border-color: black;
          border-radius: 5%;
          height: 80%;
        }
        .myButton {
        	box-shadow: 0px 0px 0px 0px #0d0f0c;
        	background-color:#855230;
        	border-radius:28px;
        	border:1px solid #121412;
        	display:inline-block;
        	cursor:pointer;
        	color:#ffffff;
        	font-family:Arial;
        	font-size:12px;
        	padding:14px 31px;
        	text-decoration:none;
        	text-shadow:0px -1px 4px #232423;
        }
        .myButton:hover {
        	background-color:#bd822a;
        }
        .myButton:active {
        	position:relative;
        	top:1px;
        }
        .console{
          color: rgba(200,200,200);
          font-size: 10px;
          font-family: verdana;
          -webkit-text-stroke-width: 1px;
          -webkit-text-stroke-color: black;
          text-shadow: 0 0 10px #000;
        }
        .list {
        	box-shadow: 0px 0px 0px 0px #0d0f0c;
        	background-color:#855230;
        	border-radius:28px;
        	border:1px solid #121412;
        	display:inline-block;
        	cursor:pointer;
        	color:#ffffff;
        	font-family:Arial;
        	font-size:12px;
        	padding:4px 3px;
        	text-decoration:none;
        	text-shadow:0px -1px 4px #232423;
        }

    </style>
  </head>
  <?php
    $output = "";

    if(isset($_POST['Enviar'])){
      $formats = array("png","jpeg","tiff","gif");
      $extensions = pathinfo($_FILES['arquivo']['name'],PATHINFO_EXTENSION);
      if(in_array($extensions,$formats)){
        $filename = $_FILES['arquivo']['name'];
        if(isset($_POST['subfolders'])){
          $subfolder = $_POST['subfolders'];
          echo $subfolder;
        }
        $folder = "arquivos/$subfolder/";
        $temp = $_FILES['arquivo']['tmp_name'];
        if(move_uploaded_file($temp,$folder.$filename)){
          $output = "Upload concluído";
        }else {
          $output = "Upload falhou";
        }
      }else {
        $output = "Sem arquivos ou extensão inválida";
      }
    }

   ?>

  <body class="bg">
    <div class="h1">
      <h1><center>Virtual Storage</center></h1>
      <div class="box"><center>
        <!--START-->
        <div id = "options"><br>
        <button class="myButton"type="button" name="upload" onclick="Uploadscreen()">Upload</button>
        <button class="myButton"type="button" name="download" onclick="Downloadscreen()" >Download</button><br>
        </div>
        <!--UPLOAD-->
        <div id = "upform" style = "display:none">
          <label>Tipo de Arquivo:  </label>
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <select id="folders" class="list" name="subfolders">
              <option value="Imagens">Imagens</option>
              <option value="Audios">Audios</option>
            </select><hr>
            <input class="myButton" type="file" name= "arquivo"><br><br>
            <input class="myButton" type="submit" name="Enviar" /><br>
          </form>
      </div>
      <!--DOWNLOAD-->
        <form id="downform" style="display:none">
          <input class="myButton" type="submit" name="Mandar" /><br>
        </form>


        <br><button style="display:none"id = "back" class="myButton" name = "back" onclick="Back()">Voltar</button>
      </center>
      <div class = "console">
        <h2 id="console"><center><?php echo $output?></center></h2>
      </div>
      </div>
    </div>


</form>

  </body>

  <script>
    var downboard = document.getElementById("downform");
    var uploadboard = document.getElementById("upform");
    var options = document.getElementById("options");
    var back = document.getElementById("back");

    function Uploadscreen(){
      uploadboard.style = "display:block";
      downboard.style = "display:none";
      options.style = "display:none";
      back.style = "display:block";
    }
    function Downloadscreen(){
      downboard.style = "display:block";
      uploadboard.style = "display:none";
      options.style = "display:none";
      back.style = "display:block";
    }
    function Back(){
      uploadboard.style = "display:none";
      downboard.style = "display:none";
      options.style = "display:block";
      back.style = "display:none";
    }
  </script>

</html>
