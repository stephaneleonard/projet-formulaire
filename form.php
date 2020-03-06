<?php
define("ERROR_MSG",     "Input missing or incorrect");
define("FIRSTNAME",     "firstname");
define("LASTNAME",     "lastname");
define("EMAIL",     "email");
define("COUNTRY",     "country");
define("DESCRIPTION",     "description");
define("SEX",     "sex");
define("SUBJECT",     "subject");
// table of all the errors message
$errors = [
    FIRSTNAME => '',
    LASTNAME => '',
    EMAIL => '',
    COUNTRY => '',
    DESCRIPTION => '',
    SEX => '',
    SUBJECT => ''
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
        return in_array(ERROR_MSG, $r, true);
    } else {
        return false;
    }
}


if (isset($_POST["submit"])) {
    if (honeypot_validade($_POST)) {

        //table of all the sanitize method needed for each input
        $options = [
            FIRSTNAME => FILTER_SANITIZE_STRING,
            LASTNAME => FILTER_SANITIZE_STRING,
            EMAIL => FILTER_VALIDATE_EMAIL,
            COUNTRY => FILTER_SANITIZE_STRING,
            DESCRIPTION => FILTER_SANITIZE_STRING,
            SEX => FILTER_SANITIZE_STRING,
            SUBJECT => FILTER_SANITIZE_STRING,
        ];
        // sanatization
        $result = filter_input_array(INPUT_POST, $options);
        $result = array_map('trim', $result);
        print_r($result);
        // check if the inputs exist and if not put the error message at the right place
        foreach ($result as $key => $value) {
            $result[$key] = trim($result[$key]);
            if (empty($value)) {
                $errors[$key] = ERROR_MSG;
            }
        }
        //make sure that customer to not try to change the input

        $accentedCharacters = "àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ";
        if (!preg_match('/^[a-zA-Z' . $accentedCharacters . '\s]+$/', $result[FIRSTNAME])) {
            $errors[FIRSTNAME] = ERROR_MSG;
        }
        if (!preg_match('/^[a-zA-Z' . $accentedCharacters . '\s]+$/', $result[LASTNAME])) {
            $errors[LASTNAME] = ERROR_MSG;
        }

        if ($result[SEX] != "M" && $result[SEX] != "F") {
            $errors[SEX] = ERROR_MSG;
        }

        if ($result[SUBJECT] != "payement" && $result[SUBJECT] != "technical" && $result[SUBJECT] != "delivery" && $result[SUBJECT] != "autre") {
            $errors[SUBJECT] = ERROR_MSG;
        }

        print_r($errors);


        //sent the mail to webmaster only if no errors
        if (!in_array(ERROR_MSG, $errors, true)) {
            $mailTo = "pierrelorand1406@gmail.com";
            $person = $result[FIRSTNAME] . " " . $result[LASTNAME];
            $mailFrom = "Contact request from " . $person . "(" . $result[COUNTRY] . ")";
            $body = "<h2> contact request </h2>
            <h4>name</h4><p>" . $person . "</p>
            <h4>email</h4><p>" . $result[EMAIL] . "</p>
            <h4>subject</h4><p>" . $result[SUBJECT] . "</p>
            <h4>message</h4><p>" . $result[DESCRIPTION] . "</p>";

            //email headers
            $headers = "MIME-Version: 1.0:" . "\r\n";
            $headers .= "Content-Type: text/html;charset=UTF-8" . "\r\n";

            //additionnal headers
            $headers .= "From: " . $person . "<" . $result[EMAIL] . ">" . "\r\n";

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
                <?php if (isset($_POST["name"])) {
                    echo $send ? '<div class = "col-12 text-center">your mail has been sent</div>' :  '<div class= "col-12 text-center">your mail has not been sent</div>';
                } ?>
                <hr>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="firstname">First name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" required value="<?php echo keepOrNotKeep(FIRSTNAME, $errors) ? $_POST[FIRSTNAME] : ''; ?>">
                <div class="alert-danger">
                    <?php
                    if ($errors[FIRSTNAME] != '') {
                        echo $errors[FIRSTNAME];
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="lastname">Last name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name" required value="<?php echo keepOrNotKeep(LASTNAME, $errors) ? $_POST[LASTNAME] : ''; ?>">
                <div class="alert-danger">
                    <?php
                    if ($errors[LASTNAME] != '') {
                        echo $errors[LASTNAME];
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="email">email</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                    </div>
                    <input type="email" class="form-control" name="email" id="email" placeholder="email@gmail.com" required aria-describedby="validationTooltipUsernamePrepend" value="<?php echo keepOrNotKeep(EMAIL, $errors) ? $_POST[EMAIL] : ''; ?>">
                </div>
                <div class="alert-danger">
                    <?php
                    if ($errors[EMAIL] != '') {
                        echo $errors[EMAIL];
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="country">Country</label>
                <input type="text" class="form-control" name="country" id="country" required placeholder="Country" value="<?php echo keepOrNotKeep(COUNTRY, $errors) ? $_POST[COUNTRY] : ''; ?>">
                <div class="alert-danger">
                    <?php
                    if ($errors[COUNTRY] != '') {
                        echo $errors[COUNTRY];
                    }
                    ?>
                </div>
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
                <div class="alert-danger">
                    <?php
                    if ($errors[SEX] != '') {
                        echo $errors[SEX];
                    }
                    ?>
                </div>
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
            if ($errors[SUBJECT] != '') {
                echo '<div class="alert-danger">' . $errors[SUBJECT] . '</div>';
            }
            ?>
        </div>
        <div class="form-row">
            <div class="col-12 ">
                <label class="mt-2" for="description">description</label>
                <textarea class="form-control" name="description" id="description" rows="10" placeholder="describe the problem" required><?php echo keepOrNotKeep(DESCRIPTION, $errors) ? $_POST[DESCRIPTION] : ''; ?></textarea>
                <?php
                if ($errors[DESCRIPTION] != '') {
                    echo '<div class="alert-danger">' . $errors[DESCRIPTION] . '</div>';
                }
                ?>
            </div>
        </div>
        <label class="ohnohoney" for="name"></label>
        <input class="ohnohoney" aria-hidden='true' autocomplete="off" type="text" id="name" name="name" placeholder="Your name here" value=''>
        <button id="run" class="btn btn-primary mt-3" type="submit" name="submit">Submit form</button>
    </form>
</main>