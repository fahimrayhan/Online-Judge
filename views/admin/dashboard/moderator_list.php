<style type="text/css">
	.userPhotoImg{
		height: 50px;
		width: 50px;
		border-radius: 100%;
	}
</style>

<?php
	
	$userList = $User->getUserInfo();
	$Site->sortBy('userRoles',$userList);
?>

<table width="100%">
	<tr>
		<td class="td1">#</td>
		<td class="td1">Photo</td>
		<td class="td1">Handle</td>
		<td class="td1">Role</td>
		<td class="td1"></td>
	</tr>
	<?php foreach ($userList as $key => $value) { 
		$userRole=$value['userRoles'];
		$userId=$value['userId'];
		$label="";
		$btn="";
		
		switch ($userRole) {
  			case 20:
  				$userRoleString="Admin";
  				$label="success";
    			break;
  			case 30:
    			$btn='<button onclick="userRoleChange('.$userId.',40)" class="btn-sm btn-danger">Delete Moderator</button>';
    			$label="primary";
    			$userRoleString="Moderator";
    			break;
  			case 35:
  				$btn='<button onclick="userRoleChange('.$userId.',30)" class="btn-sm btn-success">Approved Request</button>';
  				$userRoleString="Pending Moderator";
  				$label="info";
    			break;
  			default:
  				$label="default";
    			$btn='<button onclick="userRoleChange('.$userId.',30)" class="btn-sm">Make Moderator</button>';
    			$userRoleString="Normal";
		}
		$userRoleString="<span class='label label-$label'>$userRoleString</span>";
	?>
	<tr>
		<td class="td2"><?php echo $value['userId']; ?></td>
		<td class="td2"><img class="userPhotoImg" src="<?php echo $value['userPhoto']; ?>"></td>
		<td class="td2"><a href="profile.php?id=<?php echo $userId; ?>"><?php echo $value['userHandle']; ?></a></td>
		<td class="td2"><?php echo $userRoleString; ?></td>
		<td class="td2"><?php echo $btn; ?></td>
	</tr>
	<?php } ?>
</table>