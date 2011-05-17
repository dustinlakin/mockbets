<?php
$title = "Login";

require_once 'view/heading.php';
?>

<form action="<?=link_to(array("controller"=>"user","action"=>"login"))?>" method="POST">
    <label>
        User:
        <input type="text" name="user"/>
    </label>
    <label>
        Password:
        <input type="password" name="password"/>
    </label>
    <input type="submit" value="Login"/>
</form>

<?require_once 'view/footer.php';?>