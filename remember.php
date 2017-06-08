<?php
if(!empty($_POST) && !empty($_POST['email'])){
    require_once 'inc/db.php';
    require_once 'inc/functions.php';
    $req = $pdo->prepare("SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL");
    $req->execute([$_POST['email']]);
    $user = $req->fetch();
    if($user){
        session_start();
        $reset_token = str_random(60);
        $req = $pdo->prepare("UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?");
        $req->execute([$reset_token, $user->id]);
        $_SESSION['flash']['success'] = "Les instructions du rappel de mot de passe vous on été envoyées par emails";
        mail($_POST['email'], "Réinitialisation de votre mot de passe", "Afin réinitialiser votre mot de passe veuillez cliquer sur ce lien \n\nhttp://portfolio.dev/admin/reset.php?id={$user->id}&token=$reset_token");
        header('Location: login.php');
        die();
    }else{
        $_SESSION['flash']['danger'] = "Aucun compte ne correspond a cet email";
    }
}
?>

<?php require 'inc/header.php'; ?>

    <h1>Mot de passe oublié</h1>

    <form action="" method="POST">
        <div class="form-group">
            <label for="">Votre adresse email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Renvoie du mot de passe </button>
    </form>

<?php require 'inc/footer.php'; ?>