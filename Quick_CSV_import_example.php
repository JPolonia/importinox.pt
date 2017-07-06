<?php
include "Quick_CSV_import.php"; // Have you class seperate from your working code.
 
//connect to database
mysql_connect("localhost", "importin_admin", "T%@7C7Xzqisv");
mysql_select_db("importin_produtos"); //your database
 
$csv = new Quick_CSV_import();
 
$arr_encodings = $csv->get_encodings(); //take possible encodings list
$arr_encodings["default"] = "[default database encoding]"; //set a default (when the default database encoding should be used)
 
if(!isset($_POST["encoding"]))
  $_POST["encoding"] = "default"; //set default encoding for the first page show (no POST vars)
 
if(isset($_POST["Go"]) && ""!=$_POST["Go"]) //form was submitted
{
  $csv->file_name = $_POST["file_source"];
  //optional parameters
  $csv->use_csv_header = isset($_POST["use_csv_header"]);
  $csv->field_separate_char = $_POST["field_separate_char"][0];
  $csv->field_enclose_char = $_POST["field_enclose_char"][0];
  $csv->field_escape_char = $_POST["field_escape_char"][0];
  $csv->encoding = $_POST["encoding"];
 
  //start import now
  $csv->import();
}
else
  //$_POST["use_csv_header"] = 1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
 
<html>
<head>
    <title>Importar CSV</title>
    <meta charset="utf-8">
  <style>
  .edt
  {
    background:#ffffff; 
    border:3px double #aaaaaa; 
    -moz-border-left-colors:  #aaaaaa #ffffff #aaaaaa; 
    -moz-border-right-colors: #aaaaaa #ffffff #aaaaaa; 
    -moz-border-top-colors:   #aaaaaa #ffffff #aaaaaa; 
    -moz-border-bottom-colors:#aaaaaa #ffffff #aaaaaa; 
    width: 350px;
  }
  .edt_30
  {
    background:#ffffff; 
    border:3px double #aaaaaa; 
    font-family: Courier;
    -moz-border-left-colors:  #aaaaaa #ffffff #aaaaaa; 
    -moz-border-right-colors: #aaaaaa #ffffff #aaaaaa; 
    -moz-border-top-colors:   #aaaaaa #ffffff #aaaaaa; 
    -moz-border-bottom-colors:#aaaaaa #ffffff #aaaaaa; 
    width: 30px;
  }
  </style>
</head>
 
<body bgcolor="#f2f2f2">
  <h2 align="center">Actualizar Base de Dados</h2>
  <form method="post" enctype="multipart/form-data">
    <table border="0" align="center">
      <tr><
          <td>Base de dados (.csv):</td>
          <td rowspan="30" width="10px">&nbsp;</td>
          <td><input type="text" name="file_source" id="file_source" class="edt"  value="/home/importin/public_html/joao/artigos3.csv"></td>
      </tr>
      <tr>
          <td>CSV header:</td>
          <td><input type="checkbox" name="use_csv_header" id="use_csv_header" <?php echo(isset($_POST["use_csv_header"])?"checked":"");?>/></td>
      </tr>
      <tr>
          <td>Separate char:</td>
          <td><input type="text" name="field_separate_char" id="field_separate_char" class="edt_30"  maxlength="1" value="<?php echo(""!=$_POST["field_separate_char"] ? htmlspecialchars($_POST["field_separate_char"]) : ",");?>"/></td>
      </tr>
      <tr>
          <td>Enclose char:</td>
          <td><input type="text" name="field_enclose_char" id="field_enclose_char" class="edt_30"  maxlength="1" value="<?php echo(""!=$_POST["field_enclose_char"] ? htmlspecialchars($_POST["field_enclose_char"]) : htmlspecialchars("\""));?>"/></td>
      </tr>
      <tr>
          <td>Escape char:</td>
          <td><input type="text" name="field_escape_char" id="field_escape_char" class="edt_30"  maxlength="1" value="<?php echo(""!=$_POST["field_escape_char"] ? htmlspecialchars($_POST["field_escape_char"]) : "\\");?>"/></td>
      </tr>
      <tr>
          <td>Codificação:</td>
          <td>
          <select name="encoding" id="encoding" class="edt">
          <?php
            if(!empty($arr_encodings))
              foreach($arr_encodings as $charset=>$description):
          ?>
            <option value="<?php echo $charset;?>"<?php echo ($charset == $_POST["encoding"] ? "selected=\"selected\"" : "");?>><?php echo$description;?></option>
          <?php endforeach;?>
          </select>
        </td>
      </tr>
      <tr>
          <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
          <td colspan="3" align="center"><input type="Submit" name="Go" value="Importar" onclick=" var s = document.getElementById('file_source'); if(null != s && '' == s.value) {alert('Define file name'); s.focus(); return false;}"></td>
      </tr>
    </table>
  </form>
<?php echo(!empty($csv->error) ? "<hr/>Errors: ".$csv->error : "");?>
</body>
</html>
