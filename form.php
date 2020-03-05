<?php
// table of all the errors message
$errors = [
  "firstname" => '',
  "lastname" => '',
  "email" => '',
  "country" => '',
  "description" => '',
  "sex" =>''
];
$mailform = '';
if (isset($_POST["submit"])) {

    //table of all the sanitize method needed for each input
    $options = [
        "firstname" => FILTER_SANITIZE_STRING,
        "lastname" => FILTER_SANITIZE_STRING,
        "email" => FILTER_VALIDATE_EMAIL,
        "country" => FILTER_SANITIZE_STRING,
        "description" => FILTER_SANITIZE_STRING,
        "sex" => FILTER_SANITIZE_STRING,
    ];
    // sanatization
    $result = filter_input_array(INPUT_POST, $options);

    // check if the inputs exist and if not put the error message at the right place
    foreach ($result as $key => $value) {
        if (empty($value)) $errors[$key] = 'Input missing or incorrect';
    }
    if($result["sex"]!="M" && $result["sex"]!="F" ){
      $errors[$key] = 'Input missing or incorrect';
    }
    foreach ($result as $key => $value){
        $mailform .= "$value, ";
    }
    mail("pierrelorand1406@gmail.com","testMail",$mailform);
}
?>
<main>
    <form class="needs-validation m-5 p-5" method="post" action="/index.php?page=Form">
        <div class="row">
            <div class="col-12 text-left">
                <h2>CONTACT US</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <h4>All problems can be fixed</h4>
                <hr>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="firstname">First name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" value=<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>>
                <?php
                  if ($errors['firstname'] != '') echo '<div class="alert-danger">' . $errors['firstname'] . '</div>'
                ?>
            </div>
            <div class="col-md-4 mb-3">
                <label for="lastname">Last name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" value=<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>>
                <?php
                if ($errors['lastname'] != '') echo '<div class="alert-danger">' . $errors['lastname'] . '</div>'
                ?>
            </div>
            <div class="col-md-4 mb-3">
                <label for="email">email</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                    </div>
                    <input type="text" class="form-control" name="email" id="email" placeholder="email@gmail.com" aria-describedby="validationTooltipUsernamePrepend" value=<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>>
                </div>
                <?php
                if ($errors['email'] != '') echo '<div class="alert-danger">' . $errors['email'] . '</div>'
                ?>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="country">Country</label>
                <input type="text" class="form-control" name="country" id="country" placeholder="Country" value=<?php echo isset($_POST['country']) ? $_POST['country'] : ''; ?>>
                <?php
                if ($errors['country'] != '') echo '<div class="alert-danger">' . $errors['country'] . '</div>'
                ?>
            </div>
            <div class="col-md-3 mb-3 divSexType">
                <label> Sex</label><br>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="sex" value="M" checked>M
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="sex" value="F">F
                    </label>
                </div>
                <?php
                if ($errors['sex'] != '') echo '<div class="alert-danger">' . $errors['sex'] . '</div>'
                ?>
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
                <textarea class="form-control" name="description" id="description" rows="10" placeholder="describe the problem"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea>
                <?php
                if ($errors['description'] != '') echo '<div class="alert-danger">' . $errors['description'] . '</div>'
                ?>
            </div>
        </div>
        <button id="run" class="btn btn-primary mt-3" type="submit" name="submit">Submit form</button>
    </form>

    <script src="./assets/js/script.js"></script>
</main>