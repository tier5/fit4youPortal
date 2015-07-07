<div class="span3">
        <img src="<?php echo SITE_UPLOADS; ?>images/users_profile/thumb/<?php echo $userData->photo; ?>" alt="User Image" />
</div>
<div class="span9" >
    <table class="table table-bordered">
        <tr>
                <td width="30%">Name</td>
            <td width="70%" id="name"><?php echo $userData->firstName;?> <?php echo $userData->lastName;?></td>
        </tr>
        <tr>
                <td width="30%">E-mail</td>
            <td width="70%" id="email"><?php echo $userData->email;?></td>
        </tr>
        <tr>
                <td width="30%">Phone No</td>
            <td width="70%" id="phone"><?php echo $userData->phone;?></td>
        </tr>
        <tr>
                <td width="30%">Address</td>
            <td width="70%" id="address"><?php echo $userData->address;?><br />
    28036</td>
        </tr>
        <tr>
                <td width="30%">City</td>
            <td width="70%" id="city"><?php echo $userData->city;?></td>
        </tr>
        <tr>
                <td width="30%">State</td>
            <td width="70%" id="state"><?php echo $userData->state;?></td>
        </tr>
        <tr>
                <td width="30%">Contry</td>
            <td width="70%" id="country"><?php echo $userData->country;?></td>
        </tr>
        <tr>
                <td width="30%">Zip</td>
            <td width="70%" id="zip"><?php echo $userData->zip;?></td>
        </tr>
    </table>
</div>