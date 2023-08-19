<?php

session_start();
$_SESSION["token"] = bin2hex(random_bytes(32));
$_SESSION["token-expire"] = time() + 3600;
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="src/style.css">

<body>

  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
    <div class="container">
      <div class="form-group">
        <label class="col-form-label pt-0"><span style="color:red;">*</span>
          First Name</label>
        <input class="form-control" id="first_name" name="first_name" type="text" required>
      </div>
      <div class="form-group" style="margin-top: 15px;">
        <label class="col-form-label pt-0"><span style="color:red;">*</span>
          Last Name</label>
        <input class="form-control" id="last_name" name="last_name" type="text" required>
      </div>
      <div class="form-group" style="margin-top: 15px;">
        <input type="file" id="fileToUpload" name="fileToUpload" accept="image/*" hidden required>
        <a class="select-image">
          <div class="img-area" data-img="">
            <i class='bx bxs-cloud-upload icon'></i>
            <h3>Upload avatar</h3>
            <p>Image size must be less than <span>2MB</span></p>
          </div>
        </a>
      </div>
      <input class="upload-form" type="submit" value="Submit" name="submit">
    </div>
  </form>

  <script src="src/scripts.js"></script>
</body>

</html>