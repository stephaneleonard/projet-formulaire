<?php
// table of all the errors message
$errors = [
    "firstname" => '',
    "lastname" => '',
    "email" => '',
    "country" => '',
    "description" => '',
    "sex" => '',
    "subject" => ''
];
$result = array();
$mailform = '';
$send = false;
function honeypot_validade($req)
{

    if (!empty($req)) {

        $honeypot_fields = [
            "name",
        ];

        foreach ($honeypot_fields as $field) {
            if (isset($req[$field]) && !empty($req[$field])) {
                return false;
            }
        }
    }

    return true;
}
//method to check wether you have to keep data in there input fields or not
function keepOrNotKeep($name, $r)
{
    if (isset($_POST[$name])) {
        if (in_array('', $r)) {
            return true;
        } else return false;
    } else return false;
}


if (isset($_POST["submit"])) {
    if (honeypot_validade($_POST)) {

        //table of all the sanitize method needed for each input
        $options = [
            "firstname" => FILTER_SANITIZE_STRING,
            "lastname" => FILTER_SANITIZE_STRING,
            "email" => FILTER_VALIDATE_EMAIL,
            "country" => FILTER_SANITIZE_STRING,
            "description" => FILTER_SANITIZE_STRING,
            "sex" => FILTER_SANITIZE_STRING,
            "subject" => FILTER_SANITIZE_STRING,
        ];
        // sanatization
        $result = filter_input_array(INPUT_POST, $options);

        // check if the inputs exist and if not put the error message at the right place
        foreach ($result as $key => $value) {
            if (empty($value)) $errors[$key] = 'Input missing or incorrect';
        }
        //make sure that customer to not try to change the input
        if ($result["sex"] != "M" && $result["sex"] != "F") {
            $errors["sex"] = 'Input missing or incorrect';
        };

        if ($result["subject"] != "payement" && $result["subject"] != "technical" && $result["subject"] != "delivery" && $result["subject"] != "autre") {
            $errors["subject"] = 'Input missing or incorrect';
        }


        //sent the mail to webmaster only if no errors
        if (!in_array('Input missing or incorrect', $errors)) {
            $mailTo = "pierrelorand1406@gmail.com";
            $person = $result["firstname"] . " " . $result["lastname"];
            $mailFrom = "Contact request from " . $person . "(" . $result["country"] . ")";
            $body = "<h2> contact request </h2>
            <h4>name</h4><p>" . $person . "</p>
            <h4>email</h4><p>" . $result["email"] . "</p>
            <h4>subject</h4><p>" . $result["subject"] . "</p>
            <h4>message</h4><p>" . $result["description"] . "</p>";

            //email headers
            $headers = "MIME-Version: 1.0:" . "\r\n";
            $headers .= "Content-Type: text/html;charset=UTF-8" . "\r\n";

            //additionnal headers
            $headers .= "From: " . $person . "<" . $result["email"] . ">" . "\r\n";

            $send = mail($mailTo, $mailFrom, $body, $headers);
        } else {
            echo '<p>mail pas envoyé</p>';
            $send = false;
        }
    } else {
        echo '<p>Coucou Odile</p>';
    }
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
                <?php if(isset($_POST["name"]))echo $send ? '<div class = "col-12 text-center">your mail has been sent</div>':  '<div class= "col-12 text-center">your mail has not been sent</div>'; ?>
                <hr>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="firstname">First name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" required value="<?php echo keepOrNotKeep('firstname', $result) ? $_POST['firstname'] : ''; ?>">
                <?php
                if ($errors['firstname'] != '') echo '<div class="alert-danger">' . $errors['firstname'] . '</div>'
                ?>
            </div>
            <div class="col-md-4 mb-3">
                <label for="lastname">Last name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" required value="<?php echo keepOrNotKeep('lastname', $result) ? $_POST['lastname'] : ''; ?>">
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
                    <input type="email" class="form-control" name="email" id="email" placeholder="email@gmail.com" required aria-describedby="validationTooltipUsernamePrepend" value="<?php echo keepOrNotKeep('email', $result) ? $_POST['email'] : ''; ?>">
                </div>
                <?php
                if ($errors['email'] != '') echo '<div class="alert-danger">' . $errors['email'] . '</div>'
                ?>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="country">Country</label>
                <input type="text" class="form-control" name="country" id="country" required placeholder="Country" value="<?php echo keepOrNotKeep('country', $result) ? $_POST['country'] : ''; ?>">
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
            <div class="col-12 col-lg-6 col-sm-6 mt-4">
                <label for="subject">subject</label>
                <select name="subject" id="subject">
                    <option value="autre" selected>Autre</option>
                    <option value="payement">Payement</option>
                    <option value="delivery">Delivery</option>
                    <option value="technical">Technical</option>
                </select>
            </div>
            <?php
            if ($errors['subject'] != '') echo '<div class="alert-danger">' . $errors['subject'] . '</div>'
            ?>
        </div>
        <div class="form-row">
            <div class="col-12 ">
                <label class="mt-2" for="description">description</label>
                <textarea class="form-control" name="description" id="description" rows="10" placeholder="describe the problem" required><?php echo keepOrNotKeep('description', $result) ? $_POST['description'] : ''; ?></textarea>
                <?php
                if ($errors['description'] != '') echo '<div class="alert-danger">' . $errors['description'] . '</div>'
                ?>
            </div>
        </div>
        <label class="ohnohoney" for="name"></label>
        <input class="ohnohoney" autocomplete="false" autofill='off' type="text" id="name" name="name" placeholder="Your name here" value=''>
        <button id="run" class="btn btn-primary mt-3" type="submit" name="submit">Submit form</button>
    </form>
</main>