<div class="span4">
    <?php
	if(!empty($userData->photo))
	{
	?>
            <img src="<?php echo SITE_UPLOADS; ?>images/users_profile/thumb/<?php echo $userData->photo; ?>" alt="User Image" width="150" />
	<?php
	}
	else
	{
	?>
		<img src="<?php echo SITE_UPLOADS; ?>images/noimage.jpg" alt="User Image" />
	<?php
		
	}
	?>
        
</div>
<div class="span8" >
    <table class="table table-bordered">
        <tr>
                <td width="30%">Name</td>
            <td width="70%" id="name"><?php echo $userData->firstName;?> <?php echo $userData->lastName;?></td>
        </tr>
        <tr>
                <td width="30%">PIN</td>
            <td width="70%" id="name"><?php echo $userData->userPin;?></td>
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
            <td width="70%" id="address"><?php echo $userData->address;?></td>
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
                <td width="30%">Zip</td>
            <td width="70%" id="zip"><?php echo $userData->zip;?></td>
        </tr>
    </table>
</div>