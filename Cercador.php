<!DOCTYPE html>
<html>
<head>
<script src="jquery-3.4.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>
<body>
  <h1>Cercador</h1>
<form action="test.php" method="post">
  <input list="browsers" name="palabra" id="barra_cercador">
  <datalist id="browsers">
    <option value="Edge">
    <option value="Firefox">
    <option value="Chrome">
    <option value="Opera">
    <option value="Safari">
  </datalist>
  <input id="submit" name="submit" type="button" value="submit">
  <div id="resultat" style='margin-top: 200px;'></div>
</form>
<script src="gestioBusqueda.js"> </script>

</body>
</html>
