<table width="100%">
    <tr class="userInfoTr">
        <td class="userInfoTd1"><i class="fas fa-user profileInfoIcon"></i> Handle</td>
        <td class="userInfoTd2"><?php echo $userInfo['userHandle']; ?></td>
    </tr>
    <tr class="userInfoTr">
        <td class="userInfoTd1"><i class="fas fa-user-tie profileInfoIcon"></i> Full Name</td>
        <td class="userInfoTd2"><?php echo $userInfo['userFullName']; ?></td>
    </tr>
    <tr class="userInfoTr">
        <td class="userInfoTd1"><i class="fas fa-envelope profileInfoIcon"></i> Email</td>
        <td class="userInfoTd2"><?php echo $userInfo['userEmail']; ?></td>
    </tr>
    <tr class="userInfoTr">
        <td class="userInfoTd1"><i class="fa fa-university profileInfoIcon"></i> Institute Name</td>
        <td class="userInfoTd2"><?php echo $userInfo['instituteName']; ?></td>
    </tr>
    <tr class="userInfoTr">
        <td class="userInfoTd1"><i class="fas fa-eye profileInfoIcon"></i> Last Login</td>
        <td class="userInfoTd2"><?php echo $lastLoginTime; ?></td>
    </tr>
    <tr class="userInfoTr">
        <td class="userInfoTd1"><i class="fas fa-user-plus profileInfoIcon"></i> Join</td>
        <td class="userInfoTd2"><?php echo $DB->dateToString($userInfo['userRegistrationDate']); ?></td>
    </tr>
</table>
<div class="box_body" style="margin-top: 15px;">
    <?php include "views/profile/user_graph.php"; ?>
</div>
