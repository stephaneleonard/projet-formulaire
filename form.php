<?php
 if(isset($_POST["submit"])){
  $option = [
    "firstname" => FILTER_SANITIZE_STRING,
    "lastname" => FILTER_SANITIZE_STRING,
    "email" => FILTER_VALIDATE_EMAIL,
    "country" => FILTER_SANITIZE_STRING,
    "description" => FILTER_SANITIZE_STRING
  ];
  // sanatization
  
  echo "<pre>";
  print_r($result);
  echo "</pre>";

  //tableau qui reprend les messages d'erreurs
  // tableau avec filtre de validation
  
 }
?>
<main>
<form class="needs-validation m-5 p-5" method="post" action="/index.php?page=Form">
<div class="row">
    <div class="col-12 text-left">
         <h2>CONTACT US</h2><hr>
    </div>
</div>
<div class="row">
    <div class="col-12 text-right">
          <h4>All problems can be fixed</h4><hr>
    </div>
</div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="firstname">First name</label>
      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name">
    </div>
    <div class="col-md-4 mb-3">
      <label for="lastname">Last name</label>
      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name">
    </div>
    <div class="col-md-4 mb-3">
      <label for="email">email</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
        </div>
        <input type="text" class="form-control" name="email" id="email" placeholder="email@gmail.com" aria-describedby="validationTooltipUsernamePrepend">
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="country">Country</label>
      <input type="text" class="form-control" name="country" id="country" placeholder="Country">
    </div>
    <div class="col-md-3 mb-3 text-right">
    <label class="mr-5"> Sex</label><br>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sex" checked>M
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="sex">F
        </label>
    </div>
    </div>
  </div>
  <div class="form-row">
      <div class="col-12 col-lg-6 col-sm-6">
        <label for="subject">subject</label>
        <select name="subject" id="subject">
          <option value="autre" selected>Autre</option>
          <option value="payement">Payement</option>
          <option value="delivery">Delivery</option>
          <option value="technical">Technical</option>
        </select>
      </div>
      <div class="col-12 col-lg-6 col-sm-6">
        <label for="option">option</label>
        <select name="option" id="option">
          <option value="option" selected>Select option</option>
        </select>
      </div>
  </div>
  <div class="form-row">
      <div class="col-12 ">
      <label class="mt-2" for="description">description</label>
          <textarea class="form-control" name="description" id="description" rows="10" placeholder="describe the problem"></textarea>
      </div>
  </div>
  <button id="run" class="btn btn-primary mt-3" type="submit" name="submit">Submit form</button>
</form>

<script src="./assets/js/script.js"></script>
</main>