<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
        include_once 'bootstrap.inc.php';

        $produit = new Produit();
        $produit->setLibelle("IPhone 8");
        $produit->setDescription("Un téléphone...");
        $produit->setPrix(20);

        var_dump($produit); 
        ?>
        <table border="1" width="80%" align="center">
            <?php
            include_once 'bootstrap.inc.php';
            $produits = Produit::fetchAll();
            foreach ($produits as $unProduit):
            ?>
                <tr>
                    <td>
                        <?php echo $unProduit->getIdProduit(); ?>
                    </td>
                    <td>
                        <?php echo $unProduit->getLibelle(); ?>
                    </td>
                    <td>
                        <?php echo $unProduit->getDescription(); ?>
                    </td>
                    <td>
                        <?php echo $unProduit->getPrix(); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php
            include_once 'bootstrap.inc.php';
            
            $produit = new Produit();   //Initialisation d'une instance de produit
            $produit->setDescription("Imprimante Laser Couleur");   //valorisation de l'objet
            $produit->setLibelle("Imprimante Canon X25");
            $produit->setImage("/chemin/accès");
            $produit->setPrix(500);
            $produit->save();   //sauvegarde de l'objet (insert)
            $produit->setPrix(585);  //modification de l'objet
            $produit->save();   //sauvegarde de l'objet (update)
            
            $autreProduit = new Produit();//Initialisation d'une instance de produit
            $autreProduit->setLibelle("produit à courte durée de vie");
            $autreProduit->setDescription("xxx");//valorisation de l'objet
            $autreProduit->setImage("xxx");
            $autreProduit->setPrix(1);
            $autreProduit->save();
            $encoreUnAutreProduit = Produit ::fetch(12) ;
            $encoreUnAutreProduit ->delete();   //suppression de l'objet en base (et dans l'application...)
            ?>
    </body>
</html>