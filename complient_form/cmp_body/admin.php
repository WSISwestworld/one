<h3 style="text-align: center; color: #187efa;">Complaint form</h3>

<table class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <tr>
            <td>
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="firstname" value=<?php echo $_SESSION['FName']; ?> disabled>
            </td>
            <td>
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lastname" value=<?php echo $_SESSION['LName']; ?> disabled>
            </td>
        </tr>
        <tr>
            <td>
                <label for="district">District</label>

                <select id="district" name="district">

                    <option value="" selected disabled hidden>- select -</option>
                    <option value="Ampara">Ampara</option>
                    <option value="Anuradhapura">Anuradhapura</option>
                    <option value="Badulla">Badulla</option>
                    <option value="Batticaloa">Batticaloa</option>
                    <option value="Colombo">Colombo</option>
                    <option value="Galle">Galle</option>
                    <option value="Gampaha">Gampaha</option>
                    <option value="Hambantota">Hambantota</option>
                    <option value="Jaffna">Jaffna</option>
                    <option value="Kalutara">Kalutara</option>
                    <option value="Kandy">Kandy</option>
                    <option value="Kegalle">Kegalle</option>
                    <option value="Kilinochchi">Kilinochchi</option>
                    <option value="Kurunegala">Kurunegala</option>
                    <option value="Mannar">Mannar</option>
                    <option value="Matale">Matale</option>
                    <option value="Matara">Matara</option>
                    <option value="Monaragala">Monaragala</option>
                    <option value="Mullaitivu">Mullaitivu</option>
                    <option value="Nuwara eliya">Nuwara Eliya</option>
                    <option value="Polonnaruwa">Polonnaruwa</option>
                    <option value="Puttalam">Puttalam</option>
                    <option value="Ratnapura">Ratnapura</option>
                    <option value="Trincomalee">Trincomalee</option>
                    <option value="Vavuniya">Vavuniya</option>
                </select>
            </td>
            <td>
                <span class="error">* <?php echo $districtErr; ?></span>
            </td>
            <td>
                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="Town / City / Village...">
            </td>
            <td>
                <span class="error">* <?php echo $locationErr; ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <label for="probtype">Problem Type</label>
                <select id="probtype" name="probtype">
                    <option value="" selected disabled hidden>- select -</option>
                    <option value="typ1">Type1</option>
                    <option value="typ2">Type2</option>
                </select>
            </td>
            <td>
                <span class="error">* <?php echo $probtypeErr; ?></span>
            </td>
            <td>
                <label for="duration">How long did you facing the problem?<br>(In months)</label>
                <input type="number" id="duration" name="duration" min="1" max="240">
            </td>
            <td>
                <span class="error">* <?php echo $durationErr; ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Brief description about your issues.."
                    style="height:200px"></textarea>
            </td>
            <td>
                <span class="error">* <?php echo $descriptionErr; ?></span>
            </td>
            <td>
                
