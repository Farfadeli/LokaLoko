<?php
    session_start();
    $id_ent = $_SESSION['ent'];
    echo $id_ent;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LokaLoko</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
</head>
<body>

    <header>
        <!--<h2 class="logo">Logo</h2>-->
        <img src="../images/logo_workshop.png" width="150" height="150">
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#services">Services</a>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>
            

        </nav>
    </header>
    
    <div class="cent">
        <p><h1 class="bProd"><span class="colored-letter">Bienvenue</span> Cher Producteur(<a href="listedeproduitsProd.html" class="lien">Voir mes produits</a>) </h1></p>

        <section class="telImage">

            <button class="btn" onclick="document.getElementById('fileInput').click();">Télécharger une image</button>
            <input type="file" id="fileInput" style="display: none;" accept="image/*" onchange="afficherImage(this)" />
            <label for="fileInput" class="image-label">:</label>
            <br>
            <img class="image-preview" id="imagePreview" src="" alt="Aucune image sélectionnée" style="max-width: 100%; display: none;">

            <script>
                function afficherImage(input) {
                    const file = input.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imagePreview = document.getElementById('imagePreview');
                            imagePreview.src = e.target.result;
                            imagePreview.style.display = 'block'; // Affiche l'image
                        }
                        reader.readAsDataURL(file);
                    }
                }
            </script>

        </section>

        <form method="post" action="../php/addProdcut.php" class="fomImage">
            <div class="txt_fiield">
                <input type="text" name="nom" placeholder="Nom du produit" required>
               
            </div>
            <div class="txt_fiield">
                <input type="text" name="quantite" placeholder="quantite" required>
               
            </div>
            <div class="txt_fiield">
                <input type="text" name="prix" placeholder="prix" required>
               
            </div>
        
            <div>
                <input type="submit" value="Ajouter" class="bouton" required>
            </div>
           
        </form>
    </div>

    <div>

        

    </div>

    <section id="services" class="service">
        <h1 class="ser"><span class="colored-letter">Nos</span> Services</h1>
       <!---<ul class="round-list">
            <li>Élément 1</li>
            <li>Élément 2</li>
            <li>Élément 3</li>
        </ul>-->
        <br><br><br>
        <p> <b><span class="colored-letter">Achats Groupés</span></b> <br>   Organisez des achats groupés, permettant aux clients d'acheter des produits en gros à des prix réduits. Cette approche encourage la collaboration entre les clients pour obtenir des remises avantageuses.
        </p>
        <br>
        <p> <b><span class="colored-letter">Réductions et Coupons </span></b> <br>   Proposez des réductions spéciales et des coupons de réduction pour les produits et les services de différents fournisseurs. Cela attire l'attention des clients et les incite à acheter.
        </p>
        <br>
        <p> <b><span class="colored-letter">Ventes Flash </span></b> <br>   Organisez des ventes flash temporaires avec des remises importantes sur certains produits ou services. Ces ventes éphémères créent un sentiment d'urgence chez les clients.
        </p><br>
        <p> <b><span class="colored-letter">Comparaison de Prix </span> </b> <br>  Fournissez des outils de comparaison de prix pour aider les clients à trouver les meilleures offres parmi différents fournisseurs. Cela simplifie le processus de prise de décision.
        </p>
        </section>

    <section id="contact" class="contact">
        <h1><span class="colored-letter">Contactez</span>-nous</h1>
        <img src="images/hommePoint-removebg-preview.png" width="800px" height="600px" class="image">
        <form action="#" method="post" class="contForm">
            <form method="post">
                <div class="txt_fiield">
                   
                    <label for="message" class="label">Message :</label>
                    <textarea id="message" name="message" class="message" required></textarea>
                    
                    <input type="submit" class="send" value="Envoyer">
                
                    
                </div>     
           
        </form>
    </section>

    <section id="about" class="about">
        <h1> <span class="colored-letter" >À</span> Propos de Nous</h1>
        <p class="propos">Chez LokaLoko, notre mission est de rendre le shopping en ligne plus accessible, plus abordable et plus enrichissant pour tous. Nous croyons en la puissance de la collaboration et en la promotion des petites entreprises. Nous nous engageons à fournir une plateforme où les clients peuvent trouver des produits uniques et de qualité tout en soutenant les artisans et les producteurs locaux.</p>
    </section>

   

   
        <footer class="footer">
            <div class="content-footer">
              <div class="bloc footer-services">
                <h3>Services</h3><br>
                <ul class="services-list">
                    <li><a >Achats Groupés</a></li>
                    <li><a >Réductions et Coupons</a></li>
                    <li><a >Ventes Flash</a></li>
                    <li><a >Comparaison de Prix</a></li>
          
                  </ul>
              </div>
      
              <div class="bloc footer-contact">
                <h3>Stay in touch</h3><br>
                <p>55-55-55-55-55</p>
                <p>supportclient@contact.com</p>
                <p>11 rue de la tuillerie</p>
              </div>

              <div>
                <div class="allertime">
                    <h3>TimeSheet</h3><br>
                    <ul class="schedule-list">
                      <li>✔️ Mon 10-19</li>
                      <li>✔️ Tue 10-19</li>
                      <li>✔️ Wen 10-19</li>
                      <li>✔️ Thu 10-19</li>
                      <li>✔️ Fri 10-19</li>
                      <li>❌ Sat closed</li>
                      <li>❌ Sun closed</li>
                    </ul>
                  </div>
          
                  
              </div>
              <div class="footer-medias">
                <h3>Our Networks</h3><br>
                <ul class="media-list">
                  <li>Facebook</li>
                     <li>Instagram</li> 
                     <li>Linkedin</li>
                     <li>Youtube</li>
                     <li>Whatsapp</li>
                </ul>
              </div>


            <div class="svg">
            
                <img src="images/OIP-removebg-preview.png">
            </div>

          </footer>


        
    </footer>

</body>
</html>