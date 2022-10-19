<?php

    $Connect = pg_connect("postgres://bkywifrawnzrpp:cef1a35531f257bf3f30b8cda0051bc7f9a9702d0f1860f904513cde7a35c8fc@ec2-3-219-19-205.compute-1.amazonaws.com:5432/ddqh3pdv9gqdeh");
    if (!$Connect) {
        die("Connection failed");
    }
?>