<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "" ?></title>
</head>

<body>
    <h1>Ajouter un utilisateur</h1>
    <form action="" method="POST">
        <input type="text" name="firstname" placeholder="entrez un prénom">
        <input type="text" name="lastname" placeholder="entrez un nom">
        <input type="email" name="email" placeholder="entrez un email">
        <input type="password" name="password" placeholder="entrez un mot de passe">
        <input type="submit" value="ajouter" name="ajouter">
    </form>
</body>

</html>