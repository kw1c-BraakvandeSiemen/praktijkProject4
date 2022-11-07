
<footer>
    <p>
        <?php
        //tonen username als er ingelogd is
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
        {
            //voor en achternaam uit elkaar halen werkt op 2e hoofdletter
            echo "U bent ingelogd als: " . preg_replace('/(?<! )(?<!^)[A-Z]/', ' $0', $_SESSION['naam']);
        }
        else
        {
            echo "U bent niet ingelogd";
        }
        ?>
    <br>
        <?php
        //tonen datum
        echo date('d-m-y');
        ?>
    </p>
</footer>
