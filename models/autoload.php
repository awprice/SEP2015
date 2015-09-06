<?php

    foreach (glob("models/*.php") as $filename)
    {
        include_once $filename;
    }

?>