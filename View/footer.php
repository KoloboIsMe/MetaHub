<?php
function end_page($title): void
{
?>
    <link href="_assets/styles/footer.css" rel="stylesheet" type="text/css" />
    <footer>
        <div class="footerImages">
            <img src="/_assets/images/instagram.png" id="footerImg">
            <img src="/_assets/images/snapchat.png" id="footerImg">
            <img src="/_assets/images/twitter.png" id="footerImg">
            <img src="/_assets/images/facebook.png" id="footerImg">
        </div>
        <div class="footerContact">
            <p>Contactez-nous :</p><br>
            <p>Email : contact@exemple.com</p><br>
            <p>Téléphone : +33 123 456 789</p><br>
        </div>
        <div class="footerCopyright">
            © 2023 MetaHub. Tous droits réservés.
        </div>
    </footer>
<?php
}
?>
</body>
</html>
